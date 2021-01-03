<?php echo '<?php'.PHP_EOL; ?>

class <?php echo $singular_class; ?> extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = '<?php echo $nested_prefix.$plural; ?>';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = <?php echo ($timestamps) ? 'true' : 'false'; ?>;
	
	public static $soft_deletes = true;

<?php foreach($relationships as $relationship => $models): ?>
<?php foreach($models as $model): ?>

<?php if(strpos($relationship, 'has_many') === 0): ?>
	/**
	 * Establish the relationship between a <?php echo $singular; ?> and <?php echo str_replace('_', ' ', Str::plural($model)); ?>.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\<?php echo Str::classify($relationship).PHP_EOL; ?>
	 */
	public function <?php echo Str::plural($model); ?>()
<?php else: ?>
	/**
	 * Establish the relationship between a <?php echo $singular; ?> and a <?php echo str_replace('_', ' ', $model); ?>.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\<?php echo Str::classify($relationship).PHP_EOL; ?>
	 */
	public function <?php echo $model; ?>()
<?php endif; ?>
	{
		return $this-><?php echo $relationship; ?>('<?php echo Str::classify($model); ?>');
	}
<?php endforeach; ?>
<?php endforeach; ?>

<?php foreach($fields as $field => $type): ?>
<?php if($type == 'date'): ?>
	public function get_<?php echo $field?>()
	{
	    return $this->get_attribute('<?php echo $field?>') ? date('d/m/Y', strtotime($this->get_attribute('<?php echo $field?>'))) : null;
	}
<?php endif; ?>
<?php endforeach; ?>

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
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_index', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_index' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_create', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_create' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_create', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_create' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_view', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_view' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_edit', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_edit' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'post_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_edit', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'post_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_edit' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
		DB::query("INSERT INTO permissions (permissions.name, permissions.group) SELECT * FROM (SELECT 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_delete', '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') AS tmp WHERE NOT EXISTS (SELECT name FROM permissions WHERE permissions.name = 'get_<?php echo str_replace('.', '_', $nested_view.$plural); ?>_delete' AND permissions.group = '<?php echo str_replace('.', '_', $nested_view.$plural); ?>') LIMIT 1;");
	}
}