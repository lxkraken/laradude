
    <div class="container theme-showcase" role="main">


<!-- Start Breadcrumb -->	
	<ol class="breadcrumb hidden-xs">
		@foreach($breadcrumbs as $crumb)
			@if($crumb['link'] == 'active')
				<li class="active">{{ $crumb['text'] }}</li>
			@else
				<li><a href="{{ $crumb['link'] }}">{{ $crumb['text'] }}</a></li>
			@endif
		@endforeach	
    </ol>
    
<!-- End breadcrumb -->

<!-- Popular, Our Picks, etc. special header -->
	<div class="row img-rounded" style="background-color:#000;color:#fff;padding:4px;margin-bottom:10px;">
		<span class="glyphicon glyphicon-star" aria-hidden="true" style="margin-right:10px;"></span>Les meilleurs selon Les Dudes
	</div>
<!-- End section header -->

<?php

$numpl = count($pl);

$x = 1;

?>

    <div class="row">
		  
	@foreach($pl as $productline)
		  
		<div class="col-sm-6 productline_box">
			<div class="media">
				<div class="media-left media-middle">
					<a href="{{ $productline['link'] }}">
						{{ HTML::image('/img/logos/'.$productline['logo'], $productline['name'], array('class' => 'img-responsive', 'style' => 'width: 40vmin;max-width:176px;')) }}
					</a>
				</div>
				<div class="media-body">
					<!-- lg -->
					<!-- md -->
					<h4 class="media-heading visible-md-block visible-lg-block"><a href="{{ $productline['link'] }}">{{ stripslashes($productline['name']) }}</a></h4>
					<div class="visible-md-block visible-lg-block">Libérez la cité d’Arcadia afin de sauver le monde et rallumer la lumière du jour !</div>

					<!-- sm -->
					<h4 class="media-heading visible-sm-block" style="font-size:14px;font-weight:bold;"><a href="{{ $productline['link'] }}">{{ stripslashes($productline['name']) }}</a></h4>
					<div class="visible-sm-block" style="font-size:12px;">Libérez la cité d’Arcadia afin de sauver le monde et rallumer la lumière du jour !</div>
					
					<!-- xs -->
					<h4 class="media-heading visible-xs-block" style="font-size:12px;font-weight:bold;"><a href="{{ $productline['link'] }}">{{ stripslashes($productline['name']) }}</a></h4>
					<div class="visible-xs-block" style="font-size:10px;">Libérez la cité d’Arcadia afin de sauver le monde et rallumer la lumière du jour !</div>

				</div>
			</div>
		</div>
		
		@if($x % 2 == 0 && $x < $numpl)
		
			</div>
			<div class="row">
		@endif
		
		<?php $x++; ?>
		
	@endforeach

      </div>
      
     


    </div> <!-- /container -->
    

