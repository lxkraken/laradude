
    <div class="container" role="main">
		
	<ol class="breadcrumb hidden-xs">
		@foreach($breadcrumbs as $crumb)
			@if($crumb['link'] == 'active')
				<li class="active">{{ $crumb['text'] }}</li>
			@else
				<li><a href="{{ $crumb['link'] }}">{{ $crumb['text'] }}</a></li>
			@endif
		@endforeach		
	</ol>	
		
      <div class="row">
		
		<?php
		
			$numM = count($manufacturers);
			
			switch($numM % 3)
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
			
		@foreach($manufacturers as $m)
				
				@if(($numM - $x) > 1)

					<div class="col-sm-4" style="text-align:center;"><a href="/manufacturer/dice/{{ $m['id'] }}">{{ HTML::image('/img/logos/dice/'.$m['logo']) }}<h3>{{ $m['name'] }}</h3></a></div>


				@else
				
					<div class="col-sm-{{ $grid  }}" style="text-align:center;"><a href="/manufacturer/dice/{{ $m['id'] }}">{{ HTML::image('/img/logos/dice/'.$m['logo']) }}<h3>{{ $m['name'] }}</h3></a></div>
					
				@endif
				
				@if(($x % 3) == 0)
					</div><div class="row" style="margin-top:30px;">
				@endif
				
				<?php $x++; ?>
				
		@endforeach
		

      </div>

    </div> <!-- /container -->

