<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}} Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    
    <div class="container">
        @include('partials.header')
        @include('partials.sidebar')
        @if (Session::has('message'))
          <div class="alert-message success">
            <p>{{Session::get('message')}}</p>
          </div>
        @endif
        @if($errors->has())
          <div class="alert-message error">
            @foreach($errors->all('<p>:message</p>') as $error)
              {{$error}}
            @endforeach
          </div>
        @endif  
        {{$content}}
        @include('partials.footer')
    </div>
    
  </body>
</html>
