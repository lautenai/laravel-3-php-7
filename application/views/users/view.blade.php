<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing User</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Username:</strong>
	{{$user->username}}
</p>
<p>
	<strong>Password:</strong>
	{{$user->password}}
</p>
<p>
	<strong>Email:</strong>
	{{$user->email}}
</p>
<p>
	<strong>Verified:</strong>
	{{($user->verified) ? 'True' : 'False'}}
</p>
<p>
	<strong>Disabled:</strong>
	{{($user->disabled) ? 'True' : 'False'}}
</p>
<p>
	<strong>Deleted:</strong>
	{{($user->deleted) ? 'True' : 'False'}}
</p>
<hr>
<h2>Roles</h2>
@foreach ($roles as $role)
	{{ $role->name }} <input type="checkbox" name="" id="" {{ $user->is($role->name) ? 'checked' : '' }}> <br>
@endforeach
<hr>
<p><a href="{{URL::to('users/edit/'.$user->id)}}" class="btn">Edit</a> <a href="{{URL::to('users/delete/'.$user->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>