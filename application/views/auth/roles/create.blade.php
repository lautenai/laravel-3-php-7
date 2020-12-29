<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users <a class="btn btn-success" href="{{URL::to('auth/users')}}">Users</a>
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
  <div class="box box-primary">
    <div class="box-body no-padding">
      {{Form::open(null, 'post', array('role' => 'form'))}}
				{{ Form::hidden('csrf_token', Session::token())}}
        <div class="box-body">
          <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name', 'required'))}}
          </div>
          <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', Input::old('description'), array('class' => 'form-control', 'placeholder' => 'Description'))}}
          </div>
          <div class="form-group">
            {{Form::label('level', 'Level')}}
            {{Form::number('level', Input::old('level'), array('class' => 'form-control', 'placeholder' => 'Level', 'required'))}}
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
          or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
        </div>
      {{Form::close()}}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->