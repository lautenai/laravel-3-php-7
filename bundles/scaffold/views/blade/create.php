<section class="content-header">
  <h1>
    <?php echo ucwords(str_replace('_', ' ', $plural)); ?> <a class="btn btn-success" href="{{URL::to('<?php echo $nested_path.$plural; ?>')}}"><?php echo ucwords(str_replace('_', ' ', $plural)); ?></a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('<?php echo $nested_path.$plural; ?>')}}"><?php echo str_replace('_', ' ', $plural_class); ?></a></li>
    <li class="active">New <?php echo str_replace('_', ' ', $singular_class); ?></li>
<?php if( ! empty($belongs_to)): ?>
    <!--<li><a href="{{URL::to('<?php echo $url[$belongs_to[0]]; ?>')}}"><i class="fa fa-dashboard"></i> <?php echo ucwords(str_replace('_', ' ', Str::plural($belongs_to[0]))); ?></a></li>-->
<?php endif; ?>    
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
		{{Form::open(null, 'post', array('role' => 'form'))}}
		{{ Form::hidden('csrf_token', Session::token())}}
<?php foreach($fields as $field => $type): ?>
			<div class="form-group">
				{{Form::label('<?php echo $field; ?>', '<?php echo ucwords(str_replace('_', ' ', $field)); ?>')}}
<?php if(strpos($field, '_id') !== false && in_array(substr($field, 0, -3), $belongs_to)): ?>
				{{ Form::select('<?php echo $field; ?>', $<?php echo substr($field, 0, -3); ?>, '', array('class' => 'form-control', 'placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'id' => '<?php echo $field; ?>', 'required' => 'required')) }}
<?php else: ?>
<?php if(in_array($type, array('string', 'integer', 'float', 'date', 'timestamp'))): ?>
				{{Form::text('<?php echo $field; ?>', Input::old('<?php echo $field; ?>'), array('class' => 'form-control', 'placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'required' => 'required'))}}
<?php elseif($type == 'boolean'): ?>
				{{Form::checkbox('<?php echo $field; ?>', '1', Input::old('<?php echo $field; ?>'))}}
<?php elseif($type == 'text' || $type == 'blob'): ?>
				{{Form::textarea('<?php echo $field; ?>', Input::old('<?php echo $field; ?>'), array('class' => 'form-control', 'placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'required' => 'required'))}}
<?php endif; ?>
<?php endif; ?>
			</div>
<?php endforeach; ?>
    </div>
		<div class="box-footer">
			{{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
			ou <a href="{{URL::to(Request::referrer())}}">Cancelar</a>
		</div>
		{{Form::close()}}
  </div>
</section>