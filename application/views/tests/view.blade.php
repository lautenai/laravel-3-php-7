<section class="content-header">
  <h1>
    Tests <a class="btn btn-success" href="{{URL::to('tests')}}">Tests</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{URL::to('tests')}}">Tests</a></li>
    <li class="active">Editing Test</li>
    <!--<li><a href="{{URL::to('users')}}"><i class="fa fa-dashboard"></i> Users</a></li>-->
    
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
  	<div class="box-body">
			<div class="form-group">
				<strong>User id:</strong>
					{{$test->user_id}}
			</div>
			<div class="form-group">
				<strong>Name:</strong>
					{{$test->name}}
			</div>
			<div class="form-group">
				<strong>Surname:</strong>
					{{$test->surname}}
			</div>
			<div class="form-group">
				<strong>Active:</strong>
					{{($test->active) ? 'True' : 'False'}}
			</div>
			<div class="form-group">
				<strong>Data:</strong>
					{{$test->data}}
			</div>
  	</div>
  	<div class="box-footer">
  		<a href="{{URL::to('tests/edit/'.$test->id)}}" class="btn btn-primary">Edit</a>
  		<a href="{{URL::to('tests/delete/'.$test->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>  		
  	</div>
  </div>



<h2>Blog Comments</h2>


@if(count($test->blog_comments) == 0)
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
			@foreach($test->blog_comments as $blog_comment)
				<tr>
					<td>{{$blog_comment->user_id}}</td>
					<td>{{$blog_comment->blog_post_id}}</td>
					<td>{{$blog_comment->content}}</td>
					<td>{{$blog_comment->created}}</td>
					<td>{{$blog_comment->updated}}</td>
					<td>{{$blog_comment->deleted}}</td>
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
			<a class="btn btn-success" href="{{URL::to('blog/comments/create/'.$test->id)}}">Create new blog comment</a>
		</div>
  </div>
</div>

</section>