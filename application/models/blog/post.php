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

	/**
	 * Indicates if the model uses soft deletes.
	 *
	 * @var bool
	 */
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

	public function get_created_at()
	{
	    return date('d/m/Y H:i:s', strtotime($this->get_attribute('created_at')));
	}

	public function get()
	{
	    return $this->where_null('deleted_at')->get();
	}

	// public function trashed()
	// {
	//     return $this->where_not_null('deleted_at')->get();
	// }
	
	public function withtrashed()
	{
	    return $this->get();
	}

	// public function delete()
	// {
	//     $this->deleted_at = date('Y-m-d H:i:s');
	//     $this->save();
	// }
}