<section class="content-header">
  <h1>
    <?php echo ucwords(str_replace('_', ' ', $plural)); ?> <a class="btn btn-success" href="{{URL::to('<?php echo $nested_path.$plural; ?>')}}"><?php echo ucwords(str_replace('_', ' ', $plural)); ?></a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('<?php echo $nested_path.$plural; ?>')}}"><?php echo str_replace('_', ' ', $plural_class); ?></a></li>
    <li class="active">Editing <?php echo str_replace('_', ' ', $singular_class); ?></li>
<?php if( ! empty($belongs_to)): ?>
    <!--<li><a href="{{URL::to('<?php echo $url[$belongs_to[0]]; ?>')}}"><i class="fa fa-dashboard"></i> <?php echo ucwords(str_replace('_', ' ', Str::plural($belongs_to[0]))); ?></a></li>-->
<?php endif; ?>    
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
  	<div class="box-body">
<?php foreach($fields as $field => $type): ?>
			<div class="form-group">
				<strong><?php echo ucfirst(str_replace('_', ' ', $field)); ?>:</strong>
<?php if($type != 'boolean'): ?>
					{{$<?php echo $singular; ?>-><?php echo $field; ?>}}
<?php else: ?>
					{{($<?php echo $singular; ?>-><?php echo $field; ?>) ? 'True' : 'False'}}
<?php endif; ?>
			</div>
<?php endforeach; ?>
  	</div>
  	<div class="box-footer">
  		<a href="{{URL::to('<?php echo $nested_path.$plural; ?>/edit/'.$<?php echo $singular; ?>->id)}}" class="btn btn-primary">Edit</a>
  		<a href="{{URL::to('<?php echo $nested_path.$plural; ?>/delete/'.$<?php echo $singular; ?>->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>  		
  	</div>
  </div>



<?php foreach($plural_relationships as $relationship => $models): ?>
<?php foreach($models as $model): ?>
<h2><?php echo ucwords(str_replace('_', ' ', Str::plural($model))); ?></h2>


@if(count($<?php echo $singular; ?>-><?php echo Str::plural($model); ?>) == 0)
	<p>No <?php echo str_replace('_', ' ', Str::plural($model)); ?>.</p>
@else
<div class="box box-primary">
    <div class="box-body table-responsive">
	<table class="table table-hover table-bordered">
		<thead>
<?php foreach(Scaffold\Table::fields(Str::plural($model)) as $field): ?>
<?php if($field != 'id' && $field != $singular.'_id'): ?>
			<th><?php echo ucwords(str_replace('_', ' ', $field)); ?></th>
<?php endif; ?>
<?php endforeach; ?>
			<th style="width: 101px;"></th>
		</thead>

		<tbody>
			@foreach($<?php echo $singular; ?>-><?php echo Str::plural($model); ?> as $<?php echo $model; ?>)
				<tr>
<?php foreach(Scaffold\Table::fields(Str::plural($model)) as $field): ?>
<?php if($field != 'id' && $field != $singular.'_id'): ?>
					<td>{{$<?php echo $model; ?>-><?php echo $field; ?>}}</td>
<?php endif; ?>
<?php endforeach; ?>
					<td>
						<a href="{{URL::to('<?php echo $url[$model]; ?>/view/'.$<?php echo $model; ?>->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
						<a href="{{URL::to('<?php echo $url[$model]; ?>/edit/'.$<?php echo $model; ?>->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
						<a href="{{URL::to('<?php echo $url[$model]; ?>/delete/'.$<?php echo $model; ?>->id)}}"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif
		<div class="box-footer">
			<a class="btn btn-success" href="{{URL::to('<?php echo $url[$model]; ?>/create/'.$<?php echo $singular; ?>->id)}}">Create new <?php echo str_replace('_', ' ', $model); ?></a>
		</div>
  </div>
</div>
<?php endforeach; ?>
<?php endforeach; ?>

</section>