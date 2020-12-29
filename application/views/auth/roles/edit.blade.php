<section class="content-header">
  <h1>
    Roles <a class="btn btn-success" href="{{URL::to('auth/roles')}}">Roles</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Roles</a></li>
    <li class="active">Editing</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      {{Form::open(null, 'post', array('role' => 'form'))}}
				{{ Form::hidden('csrf_token', Session::token())}}
        
        <div class="form-group">
          {{Form::label('name', 'Name')}}
          {{Form::text('name', Input::old('name', $role->name), array('class' => 'form-control', 'placeholder' => 'Name'))}}
        </div>

        <div class="form-group">
          {{Form::label('description', 'description')}}
          {{Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'description'))}}
        </div>

        <div class="form-group">
          {{Form::label('level', 'Level')}}
          {{Form::number('level', Input::old('level', $role->level), array('class' => 'form-control', 'placeholder' => 'Level'))}}
        </div>

        {{Form::label('permissoes', 'Permissões')}}
        <br>
        @foreach ($permissions_groups as $permissions_group)
        <strong>{{ strtoupper(str_replace('_', ' ', $permissions_group->group)) }}</strong>
          @foreach ($permissions as $permission)
          @if ($permissions_group->group === $permission->group)
          <div class="checkbox">
            <label>
              {{Form::checkbox('permissions[]', $permission->id, Input::old('', in_array($permission->name, $checked_permissions) ? true : false))}} {{$permission->id}} {{ strtoupper($permission->name) }}
            </label>
          </div>
          @endif
          @endforeach
        @endforeach

        <div class="box-footer">
          {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
					or <a href="{{URL::to(Request::referrer())}}">Cancelar</a>
        </div>
      {{Form::close()}}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->