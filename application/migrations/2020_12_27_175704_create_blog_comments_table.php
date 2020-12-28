<?php

class Create_Blog_Comments_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('blog_comments', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->integer('blog_post_id');
			$table->text('content');

			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blog_comments');
	}

}