<?php echo '<?php'.PHP_EOL; ?>

class <?php echo $plural_class; ?>_Controller extends <?php echo $controller; ?> {
	
	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(array('login'));
		$this->filter('before', 'csrf')->on('post');

		//insert permissions to database
		<?php echo $singular_class; ?>::permissoes();
	}

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.adminlte';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * View all of the <?php echo $plural; ?>.
	 *
	 * @return void
	 */
	public function get_index()
	{
		Acl::can('get_<?php echo $plural; ?>_index');

<?php if($has_relationships): ?>
		$<?php echo $plural; ?> = Cache::remember(Config::get('cache.key').'<?php echo $plural; ?>', function() { return <?php echo $singular_class; ?>::with(array(<?php echo $with; ?>))->active(); }, 60*24);
<?php else: ?>
		$<?php echo $plural; ?> = Cache::remember(Config::get('cache.key').'<?php echo $plural; ?>', function() { return <?php echo $singular_class; ?>::active(); }, 60*24);
<?php endif; ?>

		$this->layout->title   = '<?php echo ucwords(str_replace('_', ' ', $plural_class)); ?>';
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.index')->with('<?php echo $plural; ?>', $<?php echo $plural; ?>);
	}

	/**
	 * Show the form to create a new <?php echo $singular; ?>.
	 *
	 * @return void
	 */
	public function get_create(<?php echo $belongs_to_params; ?>)
	{
		Acl::can('get_<?php echo $plural; ?>_create');

<?php foreach($belongs_to as $model): ?>				
		$<?php echo $model; ?> = array('' => 'SELECIONE') + <?php echo ucfirst($model); ?>::order_by('id', 'asc')->take(999999)->lists('id', 'id');
<?php endforeach; ?>

		$this->layout->title   = 'New <?php echo str_replace('_', ' ', $singular_class); ?>';
<?php if(count($belongs_to) == 0): ?>
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.create');
<?php else: ?>
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.create', array(
<?php foreach($belongs_to as $model): ?>
									'<?php echo $model; ?>' => $<?php echo $model; ?>,
<?php endforeach; ?>
								));
<?php endif; ?>
	}

	/**
	 * Create a new <?php echo $singular; ?>.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		Acl::can('post_<?php echo $plural; ?>_create');

		$validation = Validator::make(Input::all(), array(
<?php foreach($fields as $field => $type): ?>
			'<?php echo $field; ?>' => array(<?php if($type == 'boolean'): ?>
'in:0,1'<?php elseif($type == 'string'): ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'integer'): ?>
'required', 'integer'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'float'): ?>
'required', 'numeric'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php else: ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php endif; ?>),
<?php endforeach; ?>
		));

		if($validation->valid())
		{
			$<?php echo $singular; ?> = new <?php echo $singular_class; ?>;

<?php foreach($fields as $field => $type): ?>
<?php if($type != 'boolean'): ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = Input::get('<?php echo $field; ?>');
<?php else: ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = Input::get('<?php echo $field; ?>', '0');
<?php endif; ?>
<?php endforeach; ?>

			$<?php echo $singular; ?>->save();

			Cache::forget(Config::get('cache.key').'<?php echo $plural; ?>');

			Session::flash('message', 'Added <?php echo str_replace('_', ' ', $singular); ?> #'.$<?php echo $singular; ?>->id);

			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}

		else
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific <?php echo $singular; ?>.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		Acl::can('get_<?php echo $plural; ?>_view');

<?php if($has_relationships): ?>
		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::with(array(<?php echo $with; ?>))->find($id);
<?php else: ?>
		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);
<?php endif; ?>

		if(is_null($<?php echo $singular; ?>))
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}

		$this->layout->title   = 'Viewing <?php echo str_replace('_', ' ', $singular_class); ?> #'.$id;
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.view')->with('<?php echo $singular; ?>', $<?php echo $singular; ?>);
	}

	/**
	 * Show the form to edit a specific <?php echo $singular; ?>.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		Acl::can('get_<?php echo $plural; ?>_edit');

		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);

		if(is_null($<?php echo $singular; ?>))
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}
		
<?php foreach($belongs_to as $model): ?>				
		$<?php echo $model; ?> = array('' => 'SELECIONE') + <?php echo ucfirst($model); ?>::order_by('id', 'asc')->take(999999)->lists('id', 'id');
<?php endforeach; ?>

		$this->layout->title   = 'Editing <?php echo str_replace('_', ' ', $singular_class); ?>';
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.edit')->with('<?php echo $singular; ?>', $<?php echo $singular; ?>)<?php foreach($belongs_to as $model): ?>->with('<?php echo $model; ?>', $<?php echo $model; ?>)<?php endforeach; ?>;
	}

	/**
	 * Edit a specific <?php echo $singular; ?>.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		Acl::can('post_<?php echo $plural; ?>_edit');

		$validation = Validator::make(Input::all(), array(
<?php foreach($fields as $field => $type): ?>
			'<?php echo $field; ?>' => array(<?php if($type == 'boolean'): ?>
'in:0,1'<?php elseif($type == 'string'): ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'integer'): ?>
'required', 'integer'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'float'): ?>
'required', 'numeric'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php else: ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php endif; ?>),
<?php endforeach; ?>
		));

		if($validation->valid())
		{
			$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);

			if(is_null($<?php echo $singular; ?>))
			{
				return Redirect::to('<?php echo $nested_path.$plural; ?>');
			}

<?php foreach($fields as $field => $type): ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = Input::get('<?php echo $field; ?>');
<?php endforeach; ?>

			$<?php echo $singular; ?>->save();

			Cache::forget(Config::get('cache.key').'<?php echo $plural; ?>');

			Session::flash('message', 'Updated <?php echo str_replace('_', ' ', $singular); ?> #'.$<?php echo $singular; ?>->id);

			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}

		else
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific <?php echo $singular; ?>.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		Acl::can('get_<?php echo $plural; ?>_delete');

		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);

		if( ! is_null($<?php echo $singular; ?>))
		{
			Cache::forget(Config::get('cache.key').'<?php echo $plural; ?>');

			$<?php echo $singular; ?>->delete();

			Session::flash('message', 'Deleted <?php echo str_replace('_', ' ', $singular); ?> #'.$<?php echo $singular; ?>->id);
		}

		return Redirect::to('<?php echo $nested_path.$plural; ?>');
	}
}