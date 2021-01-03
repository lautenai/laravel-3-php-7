<?php

class Create_Tests_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('tests', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->string('name');
			$table->string('surname');
			$table->boolean('active');
			$table->date('data');

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
		Schema::drop('tests');
	}

}