


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
						{{ Form::open(array('url' => 'search', 'method' => 'get', 'role' => 'search', 'class' => 'navbar-form navbar-left')) }}
						  <div class="form-group" style="text-align:center;">
							  
							  {{ Form::text('q', Input::get('q'), array('class'=> 'form-control', 'placeholder' => Lang::get('navigation.search'))) }}
							<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
							  
						  </div>
					    {{ form::close() }}
					</li>

			<li class="active"><a href="/">{{ Lang::get('navigation.home') }}</a></li>
            <li><a href="#new">{{ Lang::get('navigation.newstuff') }}</a></li>

            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogue <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li>{{ HTML::link('/catalogue/f', Lang::get('navigation.gamesinfrench')) }}</li>
				<li>{{ HTML::link('/catalogue/e', Lang::get('navigation.gamesinenglish')) }}</li>
				<li>{{ HTML::link('/catalogue/dice', Lang::get('navigation.diceandacc')) }}</li>
				<li>{{ HTML::link('/catalogue/b', Lang::get('navigation.dustmagnets')) }}</li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            
             <li><a href="#contact">{{ Lang::get('navigation.retailers') }}</a></li>
            <li><a href="#contact">{{ Lang::get('navigation.contactus') }}</a></li> 

                </ul>

                <ul class="nav navbar-nav navbar-right">
			@if(isset($nav['basket']))
                 <li><a href="/basket">{{ Lang::get('navigation.basket') }} <span id="animbuy" class="badge">${{ number_format($nav['basket'], 2) }}</span></a></li>
            @endif
            
            @if(isset($nav['reserve']))
				 <li><a href="/preorder">{{ Lang::get('navigation.preorder') }} <span id="animreserve" class="badge">{{ $nav['reserve'] }}</span></a></li>
			@endif
			
			@if(isset($nav['titetete']))
				<li><a href="#">{{ Lang::get('navigation.inmyhead') }} <span id="animtt" class="badge">{{ $nav['titetete'] }}</span></a></li>
			@endif
			
			<li><a href="{{ $nav['linkUrl'] }}" style="color:#fff;">{{ $nav['linkText'] }}</a></li>
		

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
				
			  <li class="active"><a href="/">{{ Lang::get('navigation.home') }}</a></li>
				
              <li class="dropdown">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogue <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
			      <li><a href="new">{{ Lang::get('navigation.newstuff') }}</a></li>
			      <li class="divider"></li>
				<li>{{ HTML::link('/catalogue/f', Lang::get('navigation.gamesinfrench')) }}</li>
				<li>{{ HTML::link('/catalogue/e', Lang::get('navigation.gamesinenglish')) }}</li>
				<li>{{ HTML::link('/catalogue/dice', Lang::get('navigation.diceandacc')) }}</li>
				<li>{{ HTML::link('/catalogue/b', Lang::get('navigation.dustmagnets')) }}</li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

			  <li class="dropdown">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Liens <span class="caret" style="font-size:20px;"></span></a>
                <ul class="dropdown-menu" role="menu">
				  <li><a href="#contact">{{ Lang::get('navigation.retailers') }}</a></li>
				  <li><a href="contact">{{ Lang::get('navigation.contactus') }}</a></li>
                </ul>
              </li>
              
            </ul>

            <ul class="nav navbar-nav navbar-right">
			@if(isset($nav['basket']))
                 <li><a href="/basket">{{ Lang::get('navigation.basket') }} <span id="animbuy" class="badge">${{ number_format($nav['basket'], 2) }}</span></a></li>
            @endif
            
            @if(isset($nav['reserve']))
				 <li><a href="/preorder">{{ Lang::get('navigation.preorder') }} <span id="animreserve" class="badge">{{ $nav['reserve'] }}</span></a></li>
			@endif
			
			@if(isset($nav['titetete']))
				<li><a href="#">{{ Lang::get('navigation.inmyhead') }} <span id="animtt" class="badge">{{ $nav['titetete'] }}</span></a></li>
			@endif
			
			<li><a href="{{ $nav['linkUrl'] }}" style="color:#fff;">{{ $nav['linkText'] }}</a></li>
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
				  <li><a href="/">{{ Lang::get('navigation.home') }}</a></li>
				  <li><a href="new">{{ Lang::get('navigation.newstuff') }}</a></li>
				  <li><a href="#contact">{{ Lang::get('navigation.retailers') }}</a></li>
				  <li><a href="contact">{{ Lang::get('navigation.contactus') }}</a></li>
				   <li class="divider"></li>
                  <li class="dropdown-header">Catalogue</li>
			      
				<li>{{ HTML::link('/catalogue/f', Lang::get('navigation.gamesinfrench')) }}</li>
				<li>{{ HTML::link('/catalogue/e', Lang::get('navigation.gamesinenglish')) }}</li>
				<li>{{ HTML::link('/catalogue/dice', Lang::get('navigation.diceandacc')) }}</li>
				<li>{{ HTML::link('/catalogue/b', Lang::get('navigation.dustmagnets')) }}</li>
                </ul>
              </li>
              
            </ul>

            <ul class="nav navbar-nav navbar-right">
			@if(isset($nav['basket']))
                 <li><a href="/basket">{{ Lang::get('navigation.basket') }} <span id="animbuy" class="badge">${{ number_format($nav['basket'], 2) }}</span></a></li>
            @endif
            
            @if(isset($nav['reserve']))
				 <li><a href="/preorder">{{ Lang::get('navigation.preorder') }} <span id="animreserve" class="badge">{{ $nav['reserve'] }}</span></a></li>
			@endif
			
			@if(isset($nav['titetete']))
				<li><a href="#">{{ Lang::get('navigation.inmyhead') }} <span id="animtt" class="badge">{{ $nav['titetete'] }}</span></a></li>
			@endif
			
			<li><a href="{{ $nav['linkUrl'] }}" style="color:#fff;">{{ $nav['linkText'] }}</a></li>
            </ul>
          </div>

        </div>

    </nav>
