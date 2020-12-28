<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li class="active">New User</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
{{ Form::hidden('csrf_token', Session::token())}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('username', 'Username')}}

			<div class="input">
				{{Form::text('username', Input::old('username'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('password', 'Password')}}

			<div class="input">
				{{Form::text('password', Input::old('password'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('email', 'Email')}}

			<div class="input">
				{{Form::text('email', Input::old('email'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('verified', 'Verified')}}

			<div class="input">
				{{Form::checkbox('verified', '1', Input::old('verified'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('disabled', 'Disabled')}}

			<div class="input">
				{{Form::checkbox('disabled', '1', Input::old('disabled'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('deleted', 'Deleted')}}

			<div class="input">
				{{Form::checkbox('deleted', '1', Input::old('deleted'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}