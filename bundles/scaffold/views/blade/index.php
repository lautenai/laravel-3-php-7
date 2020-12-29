<section class="content-header">
  <h1><?php echo ucwords(str_replace('_', ' ', $plural)); ?> <a class="btn btn-success" href="{{URL::to('<?php echo $nested_path.$plural; ?>/create')}}">Create new <?php echo str_replace('_', ' ', $singular_class); ?></a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#"><?php echo ucwords(str_replace('_', ' ', $plural)); ?></a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive">
		@if(count($<?php echo $plural; ?>) == 0)
			No <?php echo str_replace('_', ' ', $plural); ?>.
		@else
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
<?php foreach($fields as $field => $type): ?>
						<th><?php echo ucwords(str_replace('_', ' ', $field)); ?></th>
<?php endforeach; ?>
<?php foreach($plural_relationships as $type => $models): ?>
<?php foreach($models as $model): ?>
						<th><?php echo ucwords(str_replace('_', ' ', Str::plural($model))); ?></th>
<?php endforeach; ?>
<?php endforeach; ?>
						<th style="width: 101px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($<?php echo $plural; ?> as $<?php echo $singular; ?>)
						<tr>
<?php foreach($fields as $field => $type): ?>
<?php if($type != 'boolean'): ?>
<?php if(strpos($field, '_id') !== false && in_array($model = substr($field, 0, -3), $belongs_to)): ?>
							<td><a href="{{URL::to('<?php echo $url[$model]; ?>/view/'.$<?php echo $singular; ?>->id)}}"><?php echo ucwords(str_replace('_', ' ', $model)); ?> #{{$<?php echo $singular; ?>-><?php echo $field; ?>}}</a></td>
<?php else: ?>
							<td>{{$<?php echo $singular; ?>-><?php echo $field; ?>}}</td>
<?php endif; ?>
<?php else: ?>
							<td>{{($<?php echo $singular; ?>-><?php echo $field; ?>) ? 'True' : 'False'}}</td>
<?php endif; ?>
<?php endforeach; ?>
<?php foreach($plural_relationships as $type => $models): ?>
<?php foreach($models as $model): ?>
							<td>{{count($<?php echo $singular; ?>-><?php echo Str::plural($model); ?>)}}</td>
<?php endforeach; ?>
<?php endforeach; ?>
							<td>
								<a href="{{URL::to('<?php echo $nested_path.$plural; ?>/view/'.$<?php echo $singular; ?>->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
								<a href="{{URL::to('<?php echo $nested_path.$plural; ?>/edit/'.$<?php echo $singular; ?>->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
								<a href="{{URL::to('<?php echo $nested_path.$plural; ?>/delete/'.$<?php echo $singular; ?>->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
    </div>
  </div>
</section>