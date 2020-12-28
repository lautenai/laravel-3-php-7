<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing User</li>
	</ul>
</div>

<div class="span16">

<h2>Roles</h2>
@foreach ($roles as $role)
    {{ $role->name }} <br>
    @foreach ($role->permissions as $rp)
    {{ $rp->name }}
    @endforeach
    <hr>
@endforeach
<hr>