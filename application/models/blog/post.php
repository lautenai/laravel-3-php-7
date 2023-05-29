<?php

class Blog_Post extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'blog_posts';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;
	
	public static $soft_deletes = true;


	/**
	 * Establish the relationship between a post and a user.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function user()
	{
		return $this->belongs_to('User');
	}

	/**
	 * Establish the relationship between a post and blog comments.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function blog_comments()
	{
		return $this->has_many('Blog_Comment');
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
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_posts_index', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_posts_index' AND permissions.group = 'blog_posts') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_posts_create', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_posts_create' AND permissions.group = 'blog_posts') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_blog_posts_create', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_blog_posts_create' AND permissions.group = 'blog_posts') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_posts_view', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_posts_view' AND permissions.group = 'blog_posts') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_posts_edit', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_posts_edit' AND permissions.group = 'blog_posts') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_blog_posts_edit', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_blog_posts_edit' AND permissions.group = 'blog_posts') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_blog_posts_delete', 'blog_posts') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_blog_posts_delete' AND permissions.group = 'blog_posts') LIMIT 1;");
	}
}