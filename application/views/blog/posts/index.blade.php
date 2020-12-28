<a href="{{URL::to('blog/posts')}}">Posts Active</a> | 
<a href="{{URL::to('blog/posts/trashed')}}">Posts Trashed</a> | 
<a href="{{URL::to('blog/posts/withtrashed')}}">Posts with Trashed</a>
<hr>
@if(count($posts) == 0)
	<p>No posts.</p>
@else
	<table border="1" style="border-collapse: collapse;" cellpadding="5">
		<thead>
			<tr>
				<th>User</th>
				<th>Title</th>
				<th>Content</th>
				<th>Deleted</th>
				<th>Blog Comments</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($posts as $post)
				<tr>
					<td><a href="{{URL::to('users/view/'.$post->user->id)}}">{{ucfirst($post->user->username)}}</a></td>
					<td>{{$post->title}}</td>
					<td>{{$post->content}}</td>
					<td>{{$post->deleted_at}}</td>
					<td>{{count($post->blog_comments)}}</td>
					<td>
						<a href="{{URL::to('blog/posts/view/'.$post->id)}}" class="btn">View</a>
						<a href="{{URL::to('blog/posts/edit/'.$post->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('blog/posts/delete/'.$post->id)}}" class="btn danger">Delete</a>
						<a href="{{URL::to('blog/posts/restore/'.$post->id)}}" class="btn danger">Restore</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('blog/posts/create')}}">Create new Blog Post</a></p>