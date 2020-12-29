<?php

class Blog_Post extends Eloquent {

	public static $table = 'blog_posts';
	
	public static $timestamps = true;
	
	public static $soft_deletes = true;

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function blog_comments()
	{
		return $this->has_many('Blog_Comment');
	}

	public function get_created_at()
	{
	    return date('d/m/Y H:i:s', strtotime($this->get_attribute('created_at')));
	}

	public function get_deleted_at()
	{
	    return $this->get_attribute('deleted_at') ? date('d/m/Y H:i:s', strtotime($this->get_attribute('deleted_at'))) : null;
	}
}