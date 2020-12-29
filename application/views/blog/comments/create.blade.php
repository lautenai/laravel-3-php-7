<section class="content-header">
  <h1>
    Comments <a class="btn btn-success" href="{{URL::to('blog/comments')}}">Comments</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('blog/comments')}}">Blog Comments</a></li>
    <li class="active">New Blog Comment</li>
    <!--<li><a href="{{URL::to('blog/posts')}}"><i class="fa fa-dashboard"></i> Blog Posts</a></li>-->
    
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
				{{Form::label('blog_post_id', 'Blog Post Id')}}
				{{ Form::select('blog_post_id', $blog_post, '', array('class' => 'form-control', 'placeholder' => 'Blog Post Id', 'id' => 'blog_post_id', 'required' => 'required')) }}
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