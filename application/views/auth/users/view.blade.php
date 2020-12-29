<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users <a class="btn btn-success" href="{{URL::to('auth/users')}}">Users</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">Viewing</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box box-primary">
    <div class="box-body no-padding">
      {{Form::open(null, 'post', array('role' => 'form'))}}
				{{ Form::hidden('csrf_token', Session::token())}}
        <div class="box-body">
          <div class="form-group">
            {{Form::label('username', 'Username')}}
            {{Form::text('username', Input::old('username', $user->username), array('class' => 'form-control', 'placeholder' => 'Username', 'disabled'))}}
          </div>

          <div class="form-group">
            {{Form::label('email', 'E-mail')}}
            {{Form::text('email', Input::old('email', $user->email), array('class' => 'form-control', 'placeholder' => 'E-mail', 'disabled'))}}
          </div>
          <div class=	"checkbox">
            <label>
              {{Form::checkbox('verified', '1', Input::old('verified', $user->verified))}} Verificado
            </label>
          </div>
          <div class=	"checkbox">
            <label>
              {{Form::checkbox('disabled', '1', Input::old('disabled', $user->disabled))}} Desabilitado
            </label>
          </div>
          <div class=	"checkbox">
            <label>
              {{Form::checkbox('deleted', '1', Input::old('deleted', $user->deleted))}} Inativo
            </label>
          </div>
          <hr>
          	{{Form::label('roles', 'Roles')}}
						@foreach ($roles as $role)
						<div class="checkbox">
							<label>
								{{Form::checkbox('roles[]', $role->id, Input::old('', $user->is($role->name)))}} {{ ucfirst($role->name) }}
							</label>
						</div>
						@endforeach
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <a href="{{URL::to('auth/users/edit/'.$user->id)}}" class="btn btn-primary">Edit</a>
        <a href="{{URL::to('auth/users/delete/'.$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        <a href="{{URL::to(Request::referrer())}}" class="btn btn-default">Cancel</a>
        </div>
      {{Form::close()}}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->