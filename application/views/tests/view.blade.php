<section class="content-header">
  <h1>
    Tests <a class="btn btn-success" href="{{URL::to('tests')}}">Tests</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('tests')}}">Tests</a></li>
    <li class="active">Editing Test</li>
    <!--<li><a href="{{URL::to('users')}}"><i class="fa fa-dashboard"></i> Users</a></li>-->
    
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
  	<div class="box-body">
			<div class="form-group">
				<strong>User id:</strong>
					{{$test->user_id}}
			</div>
			<div class="form-group">
				<strong>Name:</strong>
					{{$test->name}}
			</div>
			<div class="form-group">
				<strong>Surname:</strong>
					{{$test->surname}}
			</div>
			<div class="form-group">
				<strong>Active:</strong>
					{{($test->active) ? 'True' : 'False'}}
			</div>
			<div class="form-group">
				<strong>Data:</strong>
					{{$test->data}}
			</div>
  	</div>
  	<div class="box-footer">
  		<a href="{{URL::to('tests/edit/'.$test->id)}}" class="btn btn-primary">Edit</a>
  		<a href="{{URL::to('tests/delete/'.$test->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>  		
  	</div>
  </div>




</section>