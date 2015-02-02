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
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    {{ HTML::style('theme.css') }} 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <!-- small large and extra-large -->


    <nav role="navigation" class="navbar navbar-default navbar-fixed-top navbar-inverse hidden-sm hidden-md">

        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="/">{{ HTML::image('img/dude_logo.png', 'Dude', array('height' => '50', 'width' => '65', 'style' => 'position:relative;top:-14px;float:left;')) }}</a>

            </div>

            <!-- Collection of nav links and other content for toggling -->

            <div id="navbarCollapse" class="collapse navbar-collapse">

                <ul class="nav navbar-nav">
					
					<li> 
						<form role="search" class="navbar-form navbar-left">
						  <div class="form-group" style="text-align:center;">
							 <input type="text" class="form-control" placeholder="Recherche Rapide"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
						  </div>
						</form>
					</li>

			<li class="active"><a href="/">Accueil</a></li>
            <li><a href="#new">Tout neuf</a></li>

            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogue <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li>{{ HTML::link('/fcat', 'Jeux en fran&ccedil;ais') }}</li>
				<li>{{ HTML::link('/ecat', 'Jeux en anglais') }}</li>
				<li>{{ HTML::link('/dcat', 'D&eacute;s et accessoires') }}</li>
				<li>{{ HTML::link('/bcat', 'Les B&eacute;belles') }}</li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            
             <li><a href="#contact">D&eacute;taillants</a></li>
            <li><a href="#contact">Nous contacter</a></li> 

                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="#">Panier <span class="badge">$42.00</span></a></li>
				<li><a href="#">R&eacute;serve <span class="badge">42</span></a></li>
        <li><a href="/accounts/login">Connexion</a></li>

                </ul>

            </div>

        </div>

    </nav>

  <!-- Fixed navbar -->
  <!-- Medium -->

    <nav role="navigation" class="navbar navbar-default navbar-fixed-top navbar-inverse visible-md">

        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="/">{{ HTML::image('img/dude_logo.png', 'Dude', array('height' => '50', 'width' => '65', 'style' => 'position:relative;top:-14px;float:left;')) }}</a>

            </div>

            <!-- Collection of nav links and other content for toggling -->

            <div id="navbarCollapse" class="collapse navbar-collapse">
				
				<form role="search" class="navbar-form navbar-left">
				  <div class="form-group" style="text-align:center;">
					 <input type="text" class="form-control" placeholder="Recherche Rapide"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				  </div>
				</form>

            <ul class="nav navbar-nav">
				
			  <li class="active"><a href="/">Accueil</a></li>
				
              <li class="dropdown">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogue <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
			      <li><a href="new">Tout neuf</a></li>
			      <li class="divider"></li>
				  <li><a href="fcat">Jeux en fran&ccedil;ais</a></li>
				  <li><a href="ecat">Jeux en anglais</a></li>
				  <li><a href="dcat">D&eacute;s et accessoires</a></li>
				  <li><a href="bcat">Les B&eacute;belles</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

			  <li class="dropdown">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Liens <span class="caret" style="font-size:20px;"></span></a>
                <ul class="dropdown-menu" role="menu">
				  <li><a href="#contact">D&eacute;taillants</a></li>
				  <li><a href="contact">Nous contacter</a></li>
                </ul>
              </li>
              
            </ul>

            <ul class="nav navbar-nav navbar-right">
               <li><a href="#">Panier <span class="badge">$42.00</span></a></li>
               <li><a href="#">R&eacute;serve <span class="badge">42</span></a></li>
               <li><a href="/accounts/login">Connexion</a></li>
            </ul>
          </div>

        </div>

    </nav>

  <!-- Fixed navbar -->
  <!-- Small -->

    <nav role="navigation" class="navbar navbar-default navbar-fixed-top navbar-inverse visible-sm">

        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="/">{{ HTML::image('img/dude_logo.png', 'Dude', array('height' => '50', 'width' => '65', 'style' => 'position:relative;top:-14px;left:-5px;float:left;')) }}</a>

            </div>

            <!-- Collection of nav links and other content for toggling -->

            <div id="navbarCollapse" class="collapse navbar-collapse">
				
				<form role="search" class="navbar-form navbar-left"  style="margin-left:-25px;">
				  <div class="form-group" style="text-align:center;">
					 <input type="text" class="form-control" placeholder="Recherche Rapide"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				  </div>
				</form>

            <ul class="nav navbar-nav">
				
			  
				
              <li class="dropdown">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-th"></span></a>
                <ul class="dropdown-menu" role="menu">
				  <li><a href="/">Accueil</a></li>
				  <li><a href="new">Tout neuf</a></li>
				  <li><a href="#contact">D&eacute;taillants</a></li>
				  <li><a href="contact">Nous contacter</a></li>
				   <li class="divider"></li>
                  <li class="dropdown-header">Catalogue</li>
			      
				  <li><a href="fcat">Jeux en fran&ccedil;ais</a></li>
				  <li><a href="ecat">Jeux en anglais</a></li>
				  <li><a href="dcat">D&eacute;s et accessoires</a></li>
				  <li><a href="bcat">Les B&eacute;belles</a></li>
                </ul>
              </li>
              
            </ul>

            <ul class="nav navbar-nav navbar-right">
               <li><a href="#">Panier <span class="badge">$42.00</span></a></li>
               <li><a href="#">R&eacute;serve <span class="badge">42</span></a></li>
               <li><a href="/accounts/login">Connexion</a></li>
            </ul>
          </div>

        </div>

    </nav>

<div class="container-fluid">
        {{ $content }}
        
              
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    </div>
        
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap/assets/js/docs.min.js"></script>
  </body>
</html>


<!-- The fixed navbar we had before trying to make everything responsive -->
    <!--nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
			
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="/">{{ HTML::image('img/dude_logo.png', 'Dude', array('height' => '50', 'width' => '65', 'style' => 'position:relative;top:-14px;float:left;')) }}</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
			
		<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Recherche Rapide">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>			
			
			
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Accueil</a></li>
            <li><a href="#about">Tout neuf</a></li>
            
            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogue <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li><a href="fcat">Jeux en fran&ccedil;ais</a></li>
				<li><a href="ecat">Jeux en anglais</a></li>
				<li><a href="dcat">D&eacute;s et accessoires</a></li>
				<li><a href="bcat">Les B&eacute;belles</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>

             <li><a href="#contact">D&eacute;taillants</a></li>
            <li><a href="#contact">Nous contacter</a></li>           
          </ul>
                  
            <ul class="nav navbar-nav navbar-right">
				<li><a href="#">Panier <span class="badge">42</span></a></li>
				<li><a href="#">R&eacute;serve <span class="badge">42</span></a></li>
        <li><a href="#">Se connecter</a></li>
      </ul> 
        </div--><!--/.nav-collapse -->
     
      <!--/div>
    </nav-->
