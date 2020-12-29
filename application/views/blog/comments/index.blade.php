<section class="content-header">
  <h1>Comments <a class="btn btn-success" href="{{URL::to('blog/comments/create')}}">Create new Blog Comment</a></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Comments</a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-body table-responsive">
		@if(count($comments) == 0)
			No comments.
		@else
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>User Id</th>
						<th>Blog Post Id</th>
						<th>Content</th>
						<th style="width: 101px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($comments as $comment)
						<tr>
							<td><a href="{{URL::to('users/view/'.$comment->id)}}">User #{{$comment->user_id}}</a></td>
							<td><a href="{{URL::to('blog/posts/view/'.$comment->id)}}">Blog Post #{{$comment->blog_post_id}}</a></td>
							<td>{{$comment->content}}</td>
							<td>
								<a href="{{URL::to('blog/comments/view/'.$comment->id)}}"><span class="label label-success"><i class="fa fa-fw fa-eye"></i></span></a>
								<a href="{{URL::to('blog/comments/edit/'.$comment->id)}}"><span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span></a>
								<a href="{{URL::to('blog/comments/delete/'.$comment->id)}}" onclick="return confirm('Are you sure?')"><span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
    </div>
  </div>
</section>