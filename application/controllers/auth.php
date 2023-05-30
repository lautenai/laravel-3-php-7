<?php

class Auth_Controller extends Base_Controller {
	
	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(['inicio', 'login']);
		$this->filter('before', 'csrf')->on('post');

		//insert permissions to database
		// Test::permissoes();
	}

	public $layout = 'layouts.starter';
	public $restful = true;
    
    public function get_inicio()
	{
		$this->layout->title   = 'Início';
		$this->layout->content = View::make('home.inicio');
	}

	public function get_login()
	{
		return View::make('auth.login');
	}

    public function post_login()
	{
        Auth::login(1);

        return Redirect::to('/auth/inicio');
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('/auth/login');
	}
}