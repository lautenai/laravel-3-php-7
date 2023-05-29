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
			<div class="form-group">
				<strong>User id:</strong>
					{{$post->user_id}}
			</div>
			<div class="form-group">
				<strong>Title:</strong>
					{{$post->title}}
			</div>
			<div class="form-group">
				<strong>Content:</strong>
					{{$post->content}}
			</div>
  	</div>
  	<div class="box-footer">
  		<a href="{{URL::to('blog/posts/edit/'.$post->id)}}" class="btn btn-primary">Edit</a>
  		<a href="{{URL::to('blog/posts/delete/'.$post->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>  		
  	</div>
  </div>



<h2>Blog Comments</h2>


@if(count($post->blog_comments) == 0)
	<p>No blog comments.</p>
@else
<div class="box box-primary">
    <div class="box-body table-responsive">
	<table class="table table-hover table-bordered">
		<thead>
			<th>User Id</th>
			<th>Blog Post Id</th>
			<th>Content</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Deleted At</th>
			<th style="width: 101px;"></th>
		</thead>

		<tbody>
			@foreach($post->blog_comments as $blog_comment)
				<tr>
					<td>{{$blog_comment->user_id}}</td>
					<td>{{$blog_comment->blog_post_id}}</td>
					<td>{{$blog_comment->content}}</td>
					<td>{{$blog_comment->created_at}}</td>
					<td>{{$blog_comment->updated_at}}</td>
					<td>{{$blog_comment->deleted_at}}</td>
					<td>
						<a href="{{URL::to('blog/comments/view/'.$blog_comment->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
						<a href="{{URL::to('blog/comments/edit/'.$blog_comment->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
						<a href="{{URL::to('blog/comments/delete/'.$blog_comment->id)}}"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif
		<div class="box-footer">
			<a class="btn btn-success" href="{{URL::to('blog/comments/create/'.$post->id)}}">Create new blog comment</a>
		</div>
  </div>
</div>

</section>