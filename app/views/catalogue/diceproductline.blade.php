<div class="container center-block" style="margin-bottom:100px;">
	
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
    <div class="col-sm-9
		
		@if($productline['nav_link_style'] == 0)
			 darkLink
		@else
			lightLink
		@endif
		
		
	">
	<div class="img-rounded" style="padding-bottom:10px;
	
	@if(strlen($productline['bg_url']) > 2)
		padding-top:40px;background-image:url({{ asset('../img/backgrounds/'.$productline['bg_url']) }});background-repeat:no-repeat;background-size:contain;
	@endif
	
	@if(strlen($productline['fg_color']) > 2)
		color:#{{ $productline['fg_color'] }};
	@endif
	
	@if(strlen($productline['bg_color']) > 2)
		background-color:#{{ $productline['bg_color'] }};
	@endif
	">
	
	  <div class="img-rounded center-block" style="
	  
	  @if($productline['transp_bg'] == 'true')
		background-image:url({{ asset ('../img/transpDot.png') }});background-repeat: repeat;
	  @endif
	  
	  padding:10px;width:97%;">
        			
		<!-- lg -->
		<!-- md -->
		<h1 class="visible-md-block visible-lg-block" style="font-size:4vmin;">{{ $productline['name'] }}</h1>
					
		<!-- sm -->
		<h1 class="visible-sm-block" style="font-size:3vw;">{{ $productline['name'] }}</h1>
				
		<!-- xs -->
		<h1 class="visible-xs-block" style="font-size:6vmin;">{{ $productline['name'] }}</h1>

        
        
        @if(strlen($productline['fg_color']) > 2)
          <hr style="border-color: #{{ $productline['fg_color'] }};" />
        @else
          <hr style="border-color: #cccccc;" />
        @endif

@foreach($subproductlines as $subpl)
		
		<div class="media">
			<div class="media-left media-top">
				<a data-toggle="collapse" href="#collapse{{ $subpl['subpl_id'] }}" aria-expanded="false" aria-controls="collapse{{ $subpl['subpl_id'] }}">
					<img src="{{ asset('img/logos/'.$subpl['logo']) }}" />
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading" style="margin-top:40px;"><a data-toggle="collapse" href="#collapse{{ $subpl['subpl_id'] }}" aria-expanded="false" aria-controls="collapse{{ $subpl['subpl_id'] }}">{{ $subpl['name'] }}</a></h4>
				Beautiful, beautiful dice...
			</div>

			<div class="collapse well well-sm" id="collapse{{ $subpl['subpl_id']}}" style="margin-top:20px;">
				
			<?php
				
				$prodCount = count($subpl['products']);
 
				switch($prodCount % 4)
				{
					case 0:
						$grid = 3;
						break;
									
					case 1:
						$grid = 12;
						break;
									
					case 2:
						$grid = 6;
						break;
							
					case 3:
						$grid = 4;
						break;
									
				}
							
				$x = 1;
			?>
				<div class="row">
				@foreach($subpl['products'] as $p)
					
					<div class="col-sm-3 text-center" style="margin-top:30px;">

					
					@if(File::exists('img/covers/'.strtolower($p['code']).'c.png'))
					  {{ HTML::image('img/covers/'.strtolower($p['code']).'c.png', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
					@elseif(File::exists('img/covers/'.strtolower($p['code']).'c.jpg'))
					  {{ HTML::image('img/covers/'.strtolower($p['code']).'c.jpg', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}				
					@elseif(File::exists('img/covers/'.strtolower($p['code']).'c.jpeg'))
					  {{ HTML::image('img/covers/'.strtolower($p['code']).'c.jpeg', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
					@elseif(File::exists('img/covers/'.strtolower($p['code']).'c.gif'))
					  {{ HTML::image('img/covers/'.strtolower($p['code']).'c.gif', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
					@endif
					
					  <div>
						  <p><span style="font-weight:bold;">{{ $p['name'] }}</span><br />
						  @if(strlen($p['subtitle']) > 2)
						    {{ $p['subtitle'] }}<br />
						  @endif
						  {{ $p['code'] }}<br />
						  Prix sugg&eacute;r&eacute;: ${{ $p['msrp'] }}<br />
						  	<div class="input-group" style="margin-left:auto;margin-right:auto;">
							  {{ Form::open(array('url' => 'foo/bar')) }}
							  <input id="buy-{{ $p['code'] }}" type="text" class="form-control" name="buy-{{ $p['code'] }}" value="1" style="width:40px;">
							  <button type="submit" class="btn btn-success btn-sm" style="margin-top:10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
							  <script>
									$("input[name='buy-{{ $p['code'] }}']").TouchSpin({
										min: 1
									});
								</script>
							  {{ Form::close() }}
							</div>
					  </div>
					</div>
					

					
					@if(($x % 4) == 0)
						</div><div class="row">
					@endif 
					
					<?php
						$x++;
					?>			
				
				@endforeach
				</div>
				

			</div>
						@if(strlen($productline['fg_color']) > 2)
			  <hr style="border-color: #{{ $productline['fg_color'] }};" />
			@else
			  <hr style="border-color: #cccccc;" />
			@endif
		</div>
@endforeach
	  </div>		
	</div>		
  </div>
		
  <div class="col-sm-3">
	<div class="img-rounded" style="background-color:#ff0;height:200px;">Extra Info</div>
  </div>
  <div class="col-sm-3" style="margin-top:20px;">
	<div class="img-rounded" style="background-color:#ff0;height:200px;">Extra Info</div>
  </div>
</div>

</div>

