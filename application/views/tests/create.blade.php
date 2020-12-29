<section class="content-header">
  <h1>
    Tests <a class="btn btn-success" href="{{URL::to('tests')}}">Tests</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('tests')}}">Tests</a></li>
    <li class="active">New Test</li>
    <!--<li><a href="{{URL::to('users')}}"><i class="fa fa-dashboard"></i> Users</a></li>-->
    
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
		{{Form::open(null, 'post', array('role' => 'form'))}}
		{{ Form::hidden('csrf_token', Session::token())}}
			<div class="form-group">
				{{Form::label('user_id', 'User Id')}}
				{{ Form::select('user_id', $user, '', array('class' => 'form-control', 'placeholder' => 'User Id', 'id' => 'user_id', 'required' => 'required')) }}
			</div>
			<div class="form-group">
				{{Form::label('name', 'Name')}}
				{{Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required'))}}
			</div>
			<div class="form-group">
				{{Form::label('surname', 'Surname')}}
				{{Form::text('surname', Input::old('surname'), array('class' => 'form-control', 'placeholder' => 'Surname', 'required' => 'required'))}}
			</div>
			<div class="form-group">
				{{Form::label('active', 'Active')}}
				{{Form::checkbox('active', '1', Input::old('active'))}}
			</div>
			<div class="form-group">
				{{Form::label('data', 'Data')}}
				{{Form::text('data', Input::old('data'), array('class' => 'form-control', 'placeholder' => 'Data', 'required' => 'required'))}}
			</div>
    </div>
		<div class="box-footer">
			{{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
			ou <a href="{{URL::to(Request::referrer())}}">Cancelar</a>
		</div>
		{{Form::close()}}
  </div>
</section>