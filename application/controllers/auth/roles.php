<?php

class Auth_Roles_Controller extends Base_Controller {

	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(array('login'));
		$this->filter('before', 'csrf')->on('post');

		//insert permissions to database
		// Role::permissoes();
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
	 * View all of the roles.
	 *
	 * @return void
	 */
	public function get_index()
	{
		Acl::can('get_roles_index');

		// $roles = \Verify\Models\Role::with(array('permissions', 'roles.permissions'))->order_by('name')->get();

		$roles = Cache::remember(Config::get('cache.key').'roles', function() { return \Verify\Models\Role::with(array('permissions', 'roles.permissions'))->where('name', '!=', 'Super Admin')->order_by('name')->get(); }, 60*24);

		$this->layout->title   = 'Roles';
		$this->layout->content = View::make('auth.roles.index')->with('roles', $roles);
	}

	/**
	 * Show the form to create a new user.
	 *
	 * @return void
	 */
	public function get_create()
	{
		Acl::can('get_roles_create');

		$roles = \Verify\Models\Role::all();

		$this->layout->title   = 'New Role';
		$this->layout->content = View::make('auth.roles.create', compact('roles'));
	}

	/**
	 * Create a new user.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		Acl::can('post_roles_create');

		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'level' => array('required'),
		));

		if($validation->valid())
		{
			$role = new \Verify\Models\Role;

			$role->name = Input::get('name');
			$role->description = Input::get('description');
			$role->level = Input::get('level');
			
			$role->save();

			Cache::forget(Config::get('cache.key').'roles');

			$permissions = Input::get('permissions');
			
			$role->permissions()->sync($permissions);

			Session::flash('message', 'Added user #'.$role->id);

			return Redirect::to('auth/roles');
		}

		else
		{
			return Redirect::to('auth/roles/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific user.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		Acl::can('get_roles_view');

		$role = \Verify\Models\Role::with('roles')->find($id);

		$roles = \Verify\Models\Role::all();

		if(is_null($role))
		{
			return Redirect::to('auth/roles');
		}

		$this->layout->title   = 'Viewing Role #'.$id;
		$this->layout->content = View::make('auth.roles.view', compact('user', 'roles'));
	}

	/**
	 * Show the form to edit a specific user.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		Acl::can('get_roles_edit');

		$role = \Verify\Models\Role::find($id);

		if(is_null($role))
		{
			return Redirect::to('auth/roles');
		}

		// $permissions = \Verify\Models\Permission::group_by('group')->get();
		$permissions_groups = DB::table('permissions')->group_by('group')->get();
		$permissions = \Verify\Models\Permission::all();

		$checked_permissions = [];
			foreach ($role->permissions as $rp) {
			array_push($checked_permissions, $rp->name);
		}

		// dd($permissions);

		$this->layout->title   = 'Editing Role';
		$this->layout->content = View::make('auth.roles.edit', compact('role', 'permissions_groups', 'permissions', 'checked_permissions'));
	}

	/**
	 * Edit a specific user.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		Acl::can('post_roles_edit');

		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'level' => array('required'),
		));

		if($validation->valid())
		{
			$role = \Verify\Models\Role::find($id);

			if(is_null($role))
			{
				return Redirect::to('auth/roles');
			}

			$role->name = Input::get('name');			
			$role->description = Input::get('description');
			$role->level = Input::get('level');

			$role->save();

			Cache::forget(Config::get('cache.key').'roles');

			$permissions = Input::get('permissions');
			
			$role->permissions()->sync($permissions);
			
			Session::flash('message', 'Updated user #'.$role->id);

			return Redirect::to('auth/roles');
		}

		else
		{
			return Redirect::to('auth/roles/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific user.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		Acl::can('get_roles_delete');
		
		$role = Role::find($id);

		if( ! is_null($role))
		{
			// $role->delete();

			Session::flash('message', 'Deleted user #'.$role->id);
		}

		return Redirect::to('auth/roles');
	}

}