<section class="content-header">
  <h1>Tests <a class="btn btn-success" href="{{URL::to('tests/create')}}">Create new Test</a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Tests</a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive">
		@if(count($tests) == 0)
			No tests.
		@else
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>User Id</th>
						<th>Name</th>
						<th>Surname</th>
						<th>Active</th>
						<th>Data</th>
						<th style="width: 101px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tests as $test)
						<tr>
							<td><a href="{{URL::to('users/view/'.$test->id)}}">User #{{$test->user_id}}</a></td>
							<td>{{$test->name}}</td>
							<td>{{$test->surname}}</td>
							<td>{{($test->active) ? 'True' : 'False'}}</td>
							<td>{{$test->data}}</td>
							<td>
								<a href="{{URL::to('tests/view/'.$test->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
								<a href="{{URL::to('tests/edit/'.$test->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
								<a href="{{URL::to('tests/delete/'.$test->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
    </div>
  </div>
</section>