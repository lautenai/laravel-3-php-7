<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users <a class="btn btn-success" href="{{URL::to('users')}}">Users</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">New</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-body no-padding">
	    <div class="box box-primary">
	      {{Form::open(null, 'post', array('role' => 'form'))}}
					{{ Form::hidden('csrf_token', Session::token())}}
	        <div class="box-body">
	          <div class="form-group">
	            {{Form::label('username', 'Username')}}
	            {{Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Username', 'required'))}}
	          </div>

	          <div class="form-group">
	            {{Form::label('password', 'Password')}}
	            {{Form::text('password', '', array('class' => 'form-control', 'placeholder' => 'Password', 'required'))}}
	          </div>

	          <div class="form-group">
	            {{Form::label('email', 'E-mail')}}
	            {{Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'E-mail', 'required'))}}
	          </div>
	          <div class=	"checkbox">
	            <label>
	              {{Form::checkbox('verified', '1', Input::old('verified'))}} Verificado (e-mail)
	            </label>
	          </div>
	          <div class=	"checkbox">
	            <label>
	              {{Form::checkbox('disabled', '1', Input::old('disabled'))}} Desabilitado (não pode acessar o sistema)
	            </label>
	          </div>
	          <!--
	          <div class=	"checkbox">
	            <label>
	              {{Form::checkbox('deleted', '1', Input::old('deleted'))}} Inativo
	            </label>
	          </div>
	        	-->

          	<hr>
          	{{Form::label('roles', 'Roles')}}
						@foreach ($roles as $role)
						<div class="checkbox">
							<label>
								{{Form::checkbox('roles[]', $role->id, Input::old('roles[]'))}} {{ ucfirst($role->name) }}
							</label>
						</div>
						@endforeach
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	          {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
	          or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
	        </div>
	      {{Form::close()}}
	    </div>
	    <!-- /.box -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->