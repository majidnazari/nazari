<!DOCTYPE html>
<html>
 <head>
  <title>Simple Login System in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Complete Client Information</h3><br />

  

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif

   <form method="post" action='{{ url("/$client->id/completeInfo") }}'>
   {{ csrf_field() }}
    <div class="form-group">
     <label>user_name</label>
     <input type="text" name="id" class="form-control" value= {{ $client->id }} />
     <input type="text" name="user_name" class="form-control" value= {{ $client->user_name }} />
    </div>
    <div class="form-group">
     <label>Enter email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <label>Enter mobile</label>
     <input type="mobile" name="mobile" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="save" class="btn btn-primary" value="save" />
    </div>
   
   </form>
  </div>
 </body>
</html>