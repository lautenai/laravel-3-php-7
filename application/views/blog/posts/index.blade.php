<section class="content-header">
  <h1>Posts <a class="btn btn-success" href="{{URL::to('blog/posts/create')}}">Create new Blog Post</a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Posts</a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive">
		@if(count($posts) == 0)
			No posts.
		@else
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>User Id</th>
						<th>Title</th>
						<th>Content</th>
						<th>Blog Comments</th>
						<th style="width: 101px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<td><a href="{{URL::to('users/view/'.$post->id)}}">User #{{$post->user_id}}</a></td>
							<td>{{$post->title}}</td>
							<td>{{$post->content}}</td>
							<td>{{count($post->blog_comments)}}</td>
							<td>
								<a href="{{URL::to('blog/posts/view/'.$post->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
								<a href="{{URL::to('blog/posts/edit/'.$post->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
								<a href="{{URL::to('blog/posts/delete/'.$post->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
    </div>
  </div>
</section>