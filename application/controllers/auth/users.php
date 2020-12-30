<?php

class Auth_Users_Controller extends Base_Controller {

	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(array('login'));
		$this->filter('before', 'csrf')->on('post');

		//insert permissions to database
		// User::permissoes();
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
	 * View all of the users.
	 *
	 * @return void
	 */
	public function get_index()
	{
		Acl::can('get_users_index');

		$users = \Verify\Models\User::with(array('roles', 'roles.permissions'))->order_by('username')->active();

		$this->layout->title   = 'Users';
		$this->layout->content = View::make('auth.users.index')->with('users', $users);
	}

	/**
	 * Show the form to create a new user.
	 *
	 * @return void
	 */
	public function get_create()
	{
		Acl::can('get_users_create');

		$roles = \Verify\Models\Role::all();

		$this->layout->title   = 'New User';
		$this->layout->content = View::make('auth.users.create', compact('roles'));
	}

	/**
	 * Create a new user.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		Acl::can('post_users_create');

		$validation = Validator::make(Input::all(), array(
			'username' => array('required'),
			'password' => array('required'),
			'email' => array('required'),
			'verified' => array('in:0,1'),
			'disabled' => array('in:0,1'),
			'deleted' => array('in:0,1'),
		));

		if($validation->valid())
		{
			$user = new \Verify\Models\User;

			$user->username = Input::get('username');
			$user->password = Input::get('password');
			$user->email = Input::get('email');
			$user->verified = Input::get('verified', '0');
			$user->disabled = Input::get('disabled', '0');
			$user->deleted = Input::get('deleted', '0');

			$user->save();

			$roles = Input::get('roles');
			
			$user->roles()->sync($roles);

			Session::flash('message', 'Added user #'.$user->id);

			return Redirect::to('auth/users');
		}

		else
		{
			return Redirect::to('auth/users/create')
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
		Acl::can('get_users_view');

		$user = \Verify\Models\User::with('roles')->find($id);

		$roles = \Verify\Models\Role::all();

		if(is_null($user))
		{
			return Redirect::to('auth/users');
		}

		$this->layout->title   = 'Viewing User #'.$id;
		$this->layout->content = View::make('auth.users.view', compact('user', 'roles'));
	}

	/**
	 * Show the form to edit a specific user.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		Acl::can('get_users_edit');

		$user = \Verify\Models\User::find($id);

		$roles = \Verify\Models\Role::all();

		if(is_null($user))
		{
			return Redirect::to('auth/users');
		}

		$this->layout->title   = 'Editing User';
		$this->layout->content = View::make('auth.users.edit', compact('user', 'roles'));
	}

	/**
	 * Edit a specific user.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		Acl::can('post_users_edit');

		$validation = Validator::make(Input::all(), array(
			'username' => array('required'),
			// 'password' => array('required'),
			'email' => array('required'),
			'verified' => array('in:0,1'),
			'disabled' => array('in:0,1'),
			'deleted' => array('in:0,1'),
		));

		if($validation->valid())
		{
			$user = \Verify\Models\User::find($id);

			if(is_null($user))
			{
				return Redirect::to('auth/users');
			}

			$user->username = Input::get('username');

			Input::has('password') ? $user->password = Input::get('password') : null;
			
			$user->email = Input::get('email');
			$user->verified = Input::get('verified');
			$user->disabled = Input::get('disabled');
			$user->deleted = Input::get('deleted');

			$user->save();

			$roles = Input::get('roles');
			
			$user->roles()->sync($roles);
			
			Session::flash('message', 'Updated user #'.$user->id);

			return Redirect::to('auth/users');
		}

		else
		{
			return Redirect::to('auth/users/edit/'.$id)
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
		Acl::can('get_users_delete');

		$user = User::find($id);

		if( ! is_null($user))
		{
			$this->deleted($user->id);

			$user->delete();

			Session::flash('message', 'Deleted user #'.$user->id);
		}

		return Redirect::to('auth/users');
	}

	public function verified($id)
	{
		$user = User::find($id);
		$user->disabled = 1;
		$user->save();
		return;
	}

	public function disabled($id)
	{
		$user = User::find($id);
		$user->disabled = 1;
		$user->save();
		return;
	}

	public function deleted($id)
	{
		$user = User::find($id);
		$user->deleted = 1;
		$user->save();
		return;
	}

	public function get_login()
	{
		$this->layout = false;
		return View::make('auth.users.login');
	}

	public function post_login()
	{
		$credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));
 
		if (Auth::attempt($credentials))
		{
		     return Redirect::to('auth/users');
		}
	}

	public function get_logout()
	{
		Cache::forget(Config::get('cache.key').'to_check_user_'.Auth::user()->id);
		Cache::forget(Config::get('cache.key').'user_'.Auth::user()->id);

		Auth::logout();
		
		return Redirect::to('auth/users');
	}

}