<section class="content-header">
  <h1>Users <a class="btn btn-success" href="{{URL::to('auth/roles/create')}}">Create new User</a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive">
			@if(count($roles) == 0)
				<p>No roles.</p>
			@else
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Permissões</th>
							<th style="width: 101px;"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($roles as $role)
							<tr>
								<td><strong>{{ucfirst($role->name)}}</strong></td>
								<td>
									@foreach ($role->permissions as $permission)
										<span class="badge bg-teal">{{ $permission->name }}</span>
									@endforeach
								</td>
								<td>
									<a href="{{URL::to('auth/roles/view/'.$role->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
									<a href="{{URL::to('auth/roles/edit/'.$role->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
									<a href="{{URL::to('auth/roles/delete/'.$role->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
    </div>
  </div>
</section>