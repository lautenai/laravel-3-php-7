<?php

class Blog_Comment extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'blog_comments';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;
	
	public static $soft_deletes = true;


	/**
	 * Establish the relationship between a comment and a blog post.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function blog_post()
	{
		return $this->belongs_to('Blog_Post');
	}

	/**
	 * Establish the relationship between a comment and a user.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function user()
	{
		return $this->belongs_to('User');
	}


	public function get_created()
	{
	    return date('d/m/Y H:i:s', strtotime($this->get_attribute('created_at')));
	}

	public function get_updated()
	{
	    return $this->get_attribute('updated_at') ? date('d/m/Y H:i:s', strtotime($this->get_attribute('updated_at'))) : null;
	}

	public function get_deleted()
	{
	    return $this->get_attribute('deleted_at') ? date('d/m/Y H:i:s', strtotime($this->get_attribute('deleted_at'))) : null;
	}

	public static function permissoes()
	{
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_comments_index', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_comments_index' AND permissions.group = 'blog_comments') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_comments_create', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_comments_create' AND permissions.group = 'blog_comments') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_blog_comments_create', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_blog_comments_create' AND permissions.group = 'blog_comments') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_comments_view', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_comments_view' AND permissions.group = 'blog_comments') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_comments_edit', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_comments_edit' AND permissions.group = 'blog_comments') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_blog_comments_edit', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_blog_comments_edit' AND permissions.group = 'blog_comments') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_comments_delete', 'blog_comments') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_comments_delete' AND permissions.group = 'blog_comments') LIMIT 1;");
	}
}