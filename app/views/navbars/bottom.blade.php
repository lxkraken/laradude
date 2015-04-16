<nav class="navbar navbar-default navbar-inverse navbar-fixed-bottom">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->



            <!-- Collection of nav links and other content for toggling -->

            <div id="navbarCollapse" class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-right">
				<li><a href="#">{{ Lang::get('navigation.accounts') }}</a></li>
				
				<li class="dropdown">
					<a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogue <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li class="dropdown-header">Catalogue</li>
					<li class="divider"></li>
					<li>{{ HTML::link('/product/create', Lang::get('navigation.createp')) }}</li>
					<li>{{ HTML::link('/productline/create', Lang::get('navigation.createpl')) }}</li>
					<li>{{ HTML::link('/subproductline/create', Lang::get('navigation.createsubpl')) }}</li>
				  </ul>
				</li>
				
				<li><a href="#">{{ Lang::get('navigation.manufacturers') }}</a></li>
				<li><a href="#">{{ Lang::get('navigation.suppliers') }}</a></li>
				
				
				
				<li class="active"><a>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                 <li><a href="#">{{ Lang::get('navigation.neworders') }} <span class="badge">36</span></a></li>
                 <li><a href="#">{{ Lang::get('navigation.openorders') }} <span class="badge">67</span></a></li>
                 <li><a href="#">{{ Lang::get('navigation.sentorders') }} <span class="badge">4500</span></a></li>
		

                </ul>

            </div>

        </div>

    </nav>
