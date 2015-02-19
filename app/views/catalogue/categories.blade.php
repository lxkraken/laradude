
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
		
      <div class="row">
		
		<?php
		
			$numCat = count($categories);
			
			switch($numCat % 3)
			{
				case 0:
					$grid = 4;
					break;
					
				case 1:
					$grid = 12;
					break;
					
				case 2:
					$grid = 6;
					break;
					
			}
			
			$x = 1;
			
		?>
			
		@foreach($categories as $c)
				
				@if($x < 4)

					<!-- div class="col-sm-4" style="text-align:center;"><a href="productlines/{{ $c['id'] }}">{{ HTML::image('/img/dudes/'.$c['logo']) }}<h3>{{ $c['name'] }}</h3></a></div -->
					
					<div class="col-sm-4 text-center"><a href="/category/{{ $c['id'] }}">{{ HTML::image('/img/dudes/'.$c['logo'], $c['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}<h3>{{ $c['name'] }}</h3></a></div>


				@else
				
					<!-- div class="col-sm-{{ $grid  }}" style="text-align:center;"><a href="productlines/{{ $c['id'] }}">{{ HTML::image('/img/dudes/'.$c['logo']) }}<h3>{{ $c['name'] }}</h3></a></div -->
					
					<div class="col-sm-{{ $grid  }}" style="text-align:center;"><a href="/category/{{ $c['id'] }}">{{ HTML::image('/img/dudes/'.$c['logo'], $c['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}<h3>{{ $c['name'] }}</h3></a></div>
					
				@endif
				
				@if($x == 3)
					</div><div class="row" style="margin-top:30px;">
				@endif
				
				<?php $x++; ?>
				
		@endforeach
		

      </div>
      

    </div> <!-- /container -->
    
    

