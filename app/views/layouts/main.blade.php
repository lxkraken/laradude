<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Distribution Dude</title>

    <!-- Bootstrap core CSS -->
    <!-- link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" -->
    {{ HTML::style('bootstrap/dist/css/bootstrap.min.css') }} 
    <!-- Bootstrap theme -->
    <!-- link href="../bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" -->
	{{ HTML::style('bootstrap/dist/css/bootstrap-theme.min.css') }} 
    <!-- Custom styles for this template -->
    {{ HTML::style('theme.css') }}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://distributiondude.ca/js/jquery-1.11.2.min.js"></script>
	<script src="http://distributiondude.ca/bootstrap-touchspin-master/bootstrap-touchspin/bootstrap.touchspin.js"></script>   
  </head>
  

  <body role="document">

	@include('navbars.top')

	<div class="container-fluid">
	
	
        {{ $content }}
        
              
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
        
    </div>
    
    @if(isset($nav['bottom']))
    {{ $nav['bottom']}}
		@include('navbars.bottom')
	@endif
        
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://distributiondude.ca/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="http://distributiondude.ca/bootstrap/assets/js/docs.min.js"></script>
  </body>
</html>


