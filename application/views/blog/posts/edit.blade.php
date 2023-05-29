<section class="content-header">
  <h1>
    Posts <a class="btn btn-success" href="{{URL::to('blog/posts')}}">Posts</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('blog/posts')}}">Blog Posts</a></li>
    <li class="active">Editing Blog Post</li>
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
				{{ Form::select('user_id', $user, $post->user_id, array('id' => 'user_id', 'class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required')) }}
			</div>
			<div class="form-group">
				{{Form::label('title', 'Title')}}
				
				{{Form::text('title', Input::old('title', $post->title), array('class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required'))}}
			</div>
			<div class="form-group">
				{{Form::label('content', 'Content')}}
				
				{{Form::textarea('content', Input::old('content', $post->content), array('class' => 'form-control', 'placeholder' => 'Content', 'required' => 'required'))}}
			</div>
			</div>
		<div class="box-footer">
			{{Form::submit('Salvar', array('class' => 'btn btn-primary'))}} ou <a href="{{URL::to(Request::referrer())}}">Cancelar</a>
		</div>
{{Form::close()}}
  </div>
</section>