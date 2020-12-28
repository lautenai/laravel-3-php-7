<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users <a class="btn btn-success" href="{{URL::to('users/create')}}">Create new User</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box box-primary">
    <div class="box-body no-padding">
	@if(count($users) == 0)
		<p>No users.</p>
	@else
	<div class="box-body table-responsive no-padding">
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<!--<th>Roles</th>-->
				<th style="width: 10px;">Verified</th>
				<th style="width: 10px;">Disabled</th>
				<th style="width: 10px;">Deleted</th>
				<th style="width: 101px;"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($users as $user)
				<tr>
					<td><strong>{{$user->username}}</strong></td>
					<td>{{$user->email}}</td>
					<!--<td>
						@foreach ($user->roles as $role)
							<strong>{{ $role->name }}</strong> <br>
							@foreach ($role->permissions as $permission)
								{{ $permission->name }}<br>
							@endforeach
							<hr>
						@endforeach
					</td>-->
					<td>{{($user->verified) ? '<span class="label label-success"><i class="fa fa-fw fa-circle"></i></span>' : '<span class="label label-danger"><i class="fa fa-fw fa-circle"></i></span>'}}</td>
					<td>{{($user->disabled) ? '<span class="label label-success"><i class="fa fa-fw fa-circle"></i></span>' : '<span class="label label-danger"><i class="fa fa-fw fa-circle"></i></span>'}}</td>
					<td>{{($user->deleted) ? '<span class="label label-success"><i class="fa fa-fw fa-circle"></i></span>' : '<span class="label label-danger"><i class="fa fa-fw fa-circle"></i></span>'}}</td>
					<td>
						<a href="{{URL::to('users/view/'.$user->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
						<a href="{{URL::to('users/edit/'.$user->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
						<a href="{{URL::to('users/delete/'.$user->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	@endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->