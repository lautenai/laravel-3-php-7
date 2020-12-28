<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$post->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('blog/posts')}}">Blog Posts</a> <span class="divider">/</span>
		</li>
		<li class="active">Editing Blog Post</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('user_id', 'User Id')}}
			<div class="input">
		{{ Form::select('user_id', $user, $post->user_id, array('id' => 'user_id', 'class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required')) }}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('title', 'Title')}}
			<div class="input">
				
				{{Form::text('title', Input::old('title', $post->title), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('content', 'Content')}}
			<div class="input">
				
				{{Form::textarea('content', Input::old('content', $post->content), array('class' => 'span10'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}