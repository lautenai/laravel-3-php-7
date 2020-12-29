<?php

class User extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'users';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = false;
	
	public static $soft_deletes = true;

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
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_users_index', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_users_index' AND permissions.group = 'users') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_users_create', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_users_create' AND permissions.group = 'users') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_users_create', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_users_create' AND permissions.group = 'users') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_users_view', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_users_view' AND permissions.group = 'users') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_users_edit', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_users_edit' AND permissions.group = 'users') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_users_edit', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_users_edit' AND permissions.group = 'users') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_users_delete', 'users') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_users_delete' AND permissions.group = 'users') LIMIT 1;");
	}
}