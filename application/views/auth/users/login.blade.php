<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="http://localhost/AdminLTE-2.4.18/bower_components//bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://localhost/AdminLTE-2.4.18/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://localhost/AdminLTE-2.4.18/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://localhost/AdminLTE-2.4.18/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="http://localhost/AdminLTE-2.4.18/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
.login-background {
	/* The image used */
	background-image: url("https://img.wallpapersafari.com/desktop/1536/864/19/20/7uLOGt.jpg");
	/* Center and scale the image nicely */
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	position: relative;
}	
</style>
</head>
<body class="hold-transition login-page login-background">
	<div class="login-box">
	  <div class="login-logo">
	    <a href="{{URL::to('/')}}"><b>Admin</b>LTE</a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
	    <p class="login-box-msg">Sign in to start your session</p>

	    {{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
		{{ Form::hidden('csrf_token', Session::token())}}
	      <div class="form-group has-feedback">
	        {{Form::text('username', Input::old('username'), array('class' => 'form-control', 'required' => 'required'))}}
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        
	        {{Form::text('password', Input::old('password'), array('class' => 'form-control', 'required' => 'required'))}}
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="row">
	        <div class="col-xs-8">
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
	          {{Form::submit('Entrar', array('class' => 'btn btn-primary btn-block btn-flat'))}}
	        </div>
	        <!-- /.col -->
	      </div>
	    {{Form::close()}}

	    <div class="social-auth-links text-center">
	      <p>- OR -</p>
	      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
	        Facebook</a>
	      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
	        Google+</a>
	    </div>
	    <!-- /.social-auth-links -->

	    <a href="#">I forgot my password</a><br>
	    <a href="register.html" class="text-center">Register a new membership</a>

	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->
</body>
</html>