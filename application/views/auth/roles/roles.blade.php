<section class="content-header">
  <h1>Roles <a class="btn btn-success" href="{{URL::to('auth/users/create')}}">Create new Role</a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Roles</a></li>
    <li class="active">Viewing</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive no-padding">
			@if(count($roles) == 0)
				<p>No roles.</p>
			@else
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th style="width: 100px;">Username</th>
							<th>Roles</th>
							<th style="width: 101px;"></th>
						</tr>
					</thead>

					<tbody>
						@foreach($roles as $role)
							<tr>
								<td><strong>{{ucfirst($role->name)}}</strong></td>
								<td>
									@foreach ($role->permissions as $permission)
									<span class="badge bg-gray">{{ $permission->name }}</span>
									@endforeach
								</td>

								<td>
									<a href="{{URL::to('users/view/'.$role->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
									<a href="{{URL::to('users/edit/'.$role->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
									<a href="{{URL::to('users/delete/'.$role->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
    </div>
  </div>
</section>