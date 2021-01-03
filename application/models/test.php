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

	public function get_data()
	{
	    return $this->get_attribute('data') ? date('d/m/Y', strtotime($this->get_attribute('data'))) : null;
	}

	public function set_data($data)
	{
		return $this->set_attribute('data', date('Y-m-d', strtotime($data)));
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
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_tests_index', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_tests_index' AND permissions.group = 'tests') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_tests_create', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_tests_create' AND permissions.group = 'tests') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_tests_create', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_tests_create' AND permissions.group = 'tests') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_tests_view', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_tests_view' AND permissions.group = 'tests') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_tests_edit', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_tests_edit' AND permissions.group = 'tests') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_tests_edit', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_tests_edit' AND permissions.group = 'tests') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_tests_delete', 'tests') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_tests_delete' AND permissions.group = 'tests') LIMIT 1;");
	}
}