<?php

class Role extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'roles';

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
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_roles_index', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_roles_index' AND permissions.group = 'roles') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_roles_create', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_roles_create' AND permissions.group = 'roles') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_roles_create', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_roles_create' AND permissions.group = 'roles') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_roles_view', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_roles_view' AND permissions.group = 'roles') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_roles_edit', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_roles_edit' AND permissions.group = 'roles') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_roles_edit', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_roles_edit' AND permissions.group = 'roles') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_roles_delete', 'roles') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_roles_delete' AND permissions.group = 'roles') LIMIT 1;");
	}
}