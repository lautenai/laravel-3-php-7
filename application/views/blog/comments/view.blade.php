<section class="content-header">
  <h1>
    Comments <a class="btn btn-success" href="{{URL::to('blog/comments')}}">Comments</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('blog/comments')}}">Blog Comments</a></li>
    <li class="active">Editing Blog Comment</li>
    <!--<li><a href="{{URL::to('blog/posts')}}"><i class="fa fa-dashboard"></i> Blog Posts</a></li>-->
    
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
  	<div class="box-body">
			<div class="form-group">
				<strong>User id:</strong>
					{{$comment->user_id}}
			</div>
			<div class="form-group">
				<strong>Blog post id:</strong>
					{{$comment->blog_post_id}}
			</div>
			<div class="form-group">
				<strong>Content:</strong>
					{{$comment->content}}
			</div>
  	</div>
  	<div class="box-footer">
  		<a href="{{URL::to('blog/comments/edit/'.$comment->id)}}" class="btn btn-primary">Edit</a>
  		<a href="{{URL::to('blog/comments/delete/'.$comment->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>  		
  	</div>
  </div>




</section>