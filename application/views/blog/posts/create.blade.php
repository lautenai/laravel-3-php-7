<section class="content-header">
  <h1>
    Posts <a class="btn btn-dark" href="{{URL::to('blog/posts')}}">Posts</a>
  </h1>
  <nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item"><a href="{{URL::to('blog/posts')}}">Posts</a></li>
		<li class="breadcrumb-item active" aria-current="page">Criar</li>
	</ol>
  </nav>
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
				{{Form::label('title', 'Title')}}
				{{Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required'))}}
			</div>
			<div class="form-group">
				{{Form::label('content', 'Content')}}
				{{Form::textarea('content', Input::old('content'), array('class' => 'form-control', 'placeholder' => 'Content', 'required' => 'required'))}}
			</div>
    </div>
		<div class="box-footer">
			{{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
			ou <a href="{{URL::to(Request::referrer())}}">Cancelar</a>
		</div>
		{{Form::close()}}
  </div>
</section>