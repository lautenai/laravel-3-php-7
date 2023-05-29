<?php

class Blog_Comments_Controller extends Base_Controller {
	
	public function __construct() {
		parent::__construct();
		// $this->filter('before', 'auth')->only(array('create', 'edit', 'delete'));
		$this->filter('before', 'auth')->except(array('login'));
		$this->filter('before', 'csrf')->on('post');

		//insert permissions to database
		Blog_Comment::permissoes();
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
	 * View all of the comments.
	 *
	 * @return void
	 */
	public function get_index()
	{
		Acl::can('get_comments_index');

		$comments = Cache::remember(Config::get('cache.key').'comments', function() { return Blog_Comment::with(array('blog_post', 'user'))->active(); }, 60*24);

		$this->layout->title   = 'Blog Comments';
		$this->layout->content = View::make('blog.comments.index')->with('comments', $comments);
	}

	/**
	 * Show the form to create a new comment.
	 *
	 * @return void
	 */
	public function get_create($blog_post_id = null, $user_id = null)
	{
		Acl::can('get_comments_create');

				
		$blog_post = array('' => 'SELECIONE') + Blog_post::order_by('id', 'asc')->take(999999)->lists('id', 'id');
				
		$user = array('' => 'SELECIONE') + User::order_by('id', 'asc')->take(999999)->lists('id', 'id');

		$this->layout->title   = 'New Blog Comment';
		$this->layout->content = View::make('blog.comments.create', array(
									'blog_post' => $blog_post,
									'user' => $user,
								));
	}

	/**
	 * Create a new comment.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		Acl::can('post_comments_create');

		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'blog_post_id' => array('required', 'integer'),
			'content' => array('required'),
		));

		if($validation->valid())
		{
			$comment = new Blog_Comment;

			$comment->user_id = Input::get('user_id');
			$comment->blog_post_id = Input::get('blog_post_id');
			$comment->content = Input::get('content');

			$comment->save();

			Cache::forget(Config::get('cache.key').'comments');

			Session::flash('message', 'Added comment #'.$comment->id);

			return Redirect::to('blog/comments');
		}

		else
		{
			return Redirect::to('blog/comments/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific comment.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		Acl::can('get_comments_view');

		$comment = Blog_Comment::with(array('blog_post', 'user'))->find($id);

		if(is_null($comment))
		{
			return Redirect::to('blog/comments');
		}

		$this->layout->title   = 'Viewing Blog Comment #'.$id;
		$this->layout->content = View::make('blog.comments.view')->with('comment', $comment);
	}

	/**
	 * Show the form to edit a specific comment.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		Acl::can('get_comments_edit');

		$comment = Blog_Comment::find($id);

		if(is_null($comment))
		{
			return Redirect::to('blog/comments');
		}
		
				
		$blog_post = array('' => 'SELECIONE') + Blog_post::order_by('id', 'asc')->take(999999)->lists('id', 'id');
				
		$user = array('' => 'SELECIONE') + User::order_by('id', 'asc')->take(999999)->lists('id', 'id');

		$this->layout->title   = 'Editing Blog Comment';
		$this->layout->content = View::make('blog.comments.edit')->with('comment', $comment)->with('blog_post', $blog_post)->with('user', $user);
	}

	/**
	 * Edit a specific comment.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		Acl::can('post_comments_edit');

		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'blog_post_id' => array('required', 'integer'),
			'content' => array('required'),
		));

		if($validation->valid())
		{
			$comment = Blog_Comment::find($id);

			if(is_null($comment))
			{
				return Redirect::to('blog/comments');
			}

			$comment->user_id = Input::get('user_id');
			$comment->blog_post_id = Input::get('blog_post_id');
			$comment->content = Input::get('content');

			$comment->save();

			Cache::forget(Config::get('cache.key').'comments');

			Session::flash('message', 'Updated comment #'.$comment->id);

			return Redirect::to('blog/comments');
		}

		else
		{
			return Redirect::to('blog/comments/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific comment.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		Acl::can('get_comments_delete');

		$comment = Blog_Comment::find($id);

		if( ! is_null($comment))
		{
			Cache::forget(Config::get('cache.key').'comments');

			$comment->delete();

			Session::flash('message', 'Deleted comment #'.$comment->id);
		}

		return Redirect::to('blog/comments');
	}
}