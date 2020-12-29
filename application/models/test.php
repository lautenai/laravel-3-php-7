<?php

class Test extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'tests';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;
	
	public static $soft_deletes = true;


	/**
	 * Establish the relationship between a test and a user.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function user()
	{
		return $this->belongs_to('User');
	}

	/**
	 * Establish the relationship between a test and blog comments.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function blog_comments()
	{
		return $this->has_many('Blog_Comment');
	}

	public function get_data()
	{
	    return $this->get_attribute('data') ? date('d/m/Y', strtotime($this->get_attribute('data'))) : null;
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
}