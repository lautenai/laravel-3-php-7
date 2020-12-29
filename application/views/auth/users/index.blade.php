<section class="content-header">
  <h1>Users <a class="btn btn-success" href="{{URL::to('auth/users/create')}}">Create new User</a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive">
			@if(count($users) == 0)
				<p>No users.</p>
			@else
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Roles</th>
							<th style="width: 10px;">Verified</th>
							<th style="width: 10px;">Disabled</th>
							<th style="width: 10px;">Deleted</th>
							<th style="width: 101px;"></th>
						</tr>
					</thead>

					<tbody>
						@foreach($users as $user)
							<tr>
								<td><strong>{{ucfirst($user->username)}}</strong></td>
								<td>{{$user->email}}</td>
								<td>
									@foreach ($user->roles as $role)
										<span class="badge bg-teal">{{ $role->name }}</span>
										<!--
										@foreach ($role->permissions as $permission)
											{{ $permission->name }}
										@endforeach
										-->
									@endforeach
								</td>
								<td>{{($user->verified) ? '<span class="label label-success"><i class="fa fa-fw fa-circle"></i></span>' : '<span class="label label-danger"><i class="fa fa-fw fa-circle"></i></span>'}}</td>
								<td>{{($user->disabled) ? '<span class="label label-success"><i class="fa fa-fw fa-circle"></i></span>' : '<span class="label label-danger"><i class="fa fa-fw fa-circle"></i></span>'}}</td>
								<td>{{($user->deleted) ? '<span class="label label-success"><i class="fa fa-fw fa-circle"></i></span>' : '<span class="label label-danger"><i class="fa fa-fw fa-circle"></i></span>'}}</td>
								<td>
									<a href="{{URL::to('auth/users/view/'.$user->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
									<a href="{{URL::to('auth/users/edit/'.$user->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
									<a href="{{URL::to('auth/users/delete/'.$user->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
    </div>
  </div>
</section>