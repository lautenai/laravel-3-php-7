<?php

class Tests_Controller extends Base_Controller {
	
	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(array('login'));
		$this->filter('before', 'csrf')->on('post');
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
	 * View all of the tests.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$tests = Test::with(array('user', 'blog_comments'))->get();

		$this->layout->title   = 'Tests';
		$this->layout->content = View::make('tests.index')->with('tests', $tests);
	}

	/**
	 * Show the form to create a new test.
	 *
	 * @return void
	 */
	public function get_create($user_id = null)
	{
				
		$user = array('' => 'SELECIONE') + User::order_by('id', 'asc')->take(999999)->lists('id', 'id');

		$this->layout->title   = 'New Test';
		$this->layout->content = View::make('tests.create', array(
									'user' => $user,
								));
	}

	/**
	 * Create a new test.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'name' => array('required'),
			'surname' => array('required'),
			'active' => array('in:0,1'),
			'data' => array('required'),
		));

		if($validation->valid())
		{
			$test = new Test;

			$test->user_id = Input::get('user_id');
			$test->name = Input::get('name');
			$test->surname = Input::get('surname');
			$test->active = Input::get('active', '0');
			$test->data = Input::get('data');

			$test->save();

			Session::flash('message', 'Added test #'.$test->id);

			return Redirect::to('tests');
		}

		else
		{
			return Redirect::to('tests/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific test.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$test = Test::with(array('user', 'blog_comments'))->find($id);

		if(is_null($test))
		{
			return Redirect::to('tests');
		}

		$this->layout->title   = 'Viewing Test #'.$id;
		$this->layout->content = View::make('tests.view')->with('test', $test);
	}

	/**
	 * Show the form to edit a specific test.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$test = Test::find($id);

		if(is_null($test))
		{
			return Redirect::to('tests');
		}
		
				
		$user = array('' => 'SELECIONE') + User::order_by('id', 'asc')->take(999999)->lists('id', 'id');

		$this->layout->title   = 'Editing Test';
		$this->layout->content = View::make('tests.edit')->with('test', $test)->with('user', $user);
	}

	/**
	 * Edit a specific test.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'name' => array('required'),
			'surname' => array('required'),
			'active' => array('in:0,1'),
			'data' => array('required'),
		));

		if($validation->valid())
		{
			$test = Test::find($id);

			if(is_null($test))
			{
				return Redirect::to('tests');
			}

			$test->user_id = Input::get('user_id');
			$test->name = Input::get('name');
			$test->surname = Input::get('surname');
			$test->active = Input::get('active');
			$test->data = Input::get('data');

			$test->save();

			Session::flash('message', 'Updated test #'.$test->id);

			return Redirect::to('tests');
		}

		else
		{
			return Redirect::to('tests/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific test.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$test = Test::find($id);

		if( ! is_null($test))
		{
			$test->delete();

			Session::flash('message', 'Deleted test #'.$test->id);
		}

		return Redirect::to('tests');
	}
}