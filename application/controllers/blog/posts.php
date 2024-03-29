<?php

class Blog_Posts_Controller extends Base_Controller {
	
	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(array('login'));
		$this->filter('before', 'csrf')->on('post');

		//insert permissions to database
		// Blog_Post::permissoes();
	}

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.starter';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * View all of the posts.
	 *
	 * @return void
	 */
	public function get_index()
	{
		Acl::can('get_posts_index');

		$posts = Cache::remember(Config::get('cache.key').'posts', function() { return Blog_Post::with(array('user', 'blog_comments'))->active(); }, 60*24);

		$this->layout->title   = 'Blog Posts';
		$this->layout->content = View::make('blog.posts.index')->with('posts', $posts);
	}

	/**
	 * Show the form to create a new post.
	 *
	 * @return void
	 */
	public function get_create($user_id = null)
	{
		Acl::can('get_posts_create');
						
		$user = array('' => 'SELECIONE') + User::order_by('id', 'asc')->take(999999)->lists('id', 'id');

		$this->layout->title   = 'New Blog Post';
		$this->layout->content = View::make('blog.posts.create', array(
									'user' => $user,
								));
	}

	/**
	 * Create a new post.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		Acl::can('post_posts_create');

		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'title' => array('required'),
			'content' => array('required'),
		));

		if($validation->valid())
		{
			$post = new Blog_Post;

			$post->user_id = Input::get('user_id');
			$post->title = Input::get('title');
			$post->content = Input::get('content');

			$post->save();

			Cache::forget(Config::get('cache.key').'posts');

			Session::flash('message', 'Added post #'.$post->id);

			return Redirect::to('blog/posts');
		}

		else
		{
			return Redirect::to('blog/posts/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific post.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		Acl::can('get_posts_view');

		$post = Blog_Post::with(array('user', 'blog_comments'))->find($id);

		if(is_null($post))
		{
			return Redirect::to('blog/posts');
		}

		$this->layout->title   = 'Viewing Blog Post #'.$id;
		$this->layout->content = View::make('blog.posts.view')->with('post', $post);
	}

	/**
	 * Show the form to edit a specific post.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		Acl::can('get_posts_edit');

		$post = Blog_Post::find($id);

		if(is_null($post))
		{
			return Redirect::to('blog/posts');
		}
		
				
		$user = array('' => 'SELECIONE') + User::order_by('id', 'asc')->take(999999)->lists('id', 'id');

		$this->layout->title   = 'Editing Blog Post';
		$this->layout->content = View::make('blog.posts.edit')->with('post', $post)->with('user', $user);
	}

	/**
	 * Edit a specific post.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		Acl::can('post_posts_edit');

		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'title' => array('required'),
			'content' => array('required'),
		));

		if($validation->valid())
		{
			$post = Blog_Post::find($id);

			if(is_null($post))
			{
				return Redirect::to('blog/posts');
			}

			$post->user_id = Input::get('user_id');
			$post->title = Input::get('title');
			$post->content = Input::get('content');

			$post->save();

			Cache::forget(Config::get('cache.key').'posts');

			Session::flash('message', 'Updated post #'.$post->id);

			return Redirect::to('blog/posts');
		}

		else
		{
			return Redirect::to('blog/posts/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific post.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		Acl::can('get_posts_delete');

		$post = Blog_Post::find($id);

		if( ! is_null($post))
		{
			Cache::forget(Config::get('cache.key').'posts');

			$post->delete();

			Session::flash('message', 'Deleted post #'.$post->id);
		}

		return Redirect::to('blog/posts');
	}
}