@include('components.ajax')

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
		
		@if($pl['nav_link_style'] == 0)
			 darkLink
		@else
			lightLink
		@endif
		
		
	">
	<div class="img-rounded" style="padding-bottom:10px;
	
	@if(strlen($pl['bg_url']) > 2)
		padding-top:40px;background-image:url({{ asset('../img/backgrounds/'.$pl['bg_url']) }});background-repeat:no-repeat;background-size:contain;
	@endif
	
	@if(strlen($pl['fg_color']) > 2)
		color:#{{ $pl['fg_color'] }};
	@endif
	
	@if(strlen($pl['bg_color']) > 2)
		background-color:#{{ $pl['bg_color'] }};
	@endif
	">
	
	  <div class="img-rounded center-block" style="
	  
	  @if($pl['transp_bg'] == 'true')
		background-image:url({{ asset ('../img/transpDot.png') }});background-repeat: repeat;
	  @endif
	  
	  padding:10px;width:97%;">
        			
		<!-- lg -->
		<!-- md -->
		<h1 class="visible-md-block visible-lg-block" style="font-size:4vmin;">{{ $pl['name'] }}</h1>
					
		<!-- sm -->
		<h1 class="visible-sm-block" style="font-size:3vw;">{{ $pl['name'] }}</h1>
				
		<!-- xs -->
		<h1 class="visible-xs-block" style="font-size:6vmin;">{{ $pl['name'] }}</h1>

        
        
        @if(strlen($pl['fg_color']) > 2)
          <hr style="border-color: #{{ $pl['fg_color'] }};" />
        @else
          <hr style="border-color: #cccccc;" />
        @endif

<!-- Subproductlines -->
@foreach($subproductlines as $subpl)
  @if(isset($subpl['products']))
  
  
		
		<div class="media">
			<div class="media-left media-top hidden-xs">
				<a data-toggle="collapse" href="#collapse{{ $subpl['subpl_id'] }}" aria-expanded="false" aria-controls="collapse{{ $subpl['subpl_id'] }}">
					<img src="{{ asset('img/logos/'.$subpl['logo']) }}" class="img-responsive" />
				</a>
			</div>
			<div class="media-top visible-xs">
				<a data-toggle="collapse" href="#collapse{{ $subpl['subpl_id'] }}" aria-expanded="false" aria-controls="collapse{{ $subpl['subpl_id'] }}">
					<img src="{{ asset('img/logos/'.$subpl['logo']) }}" class="img-responsive" />
				</a>
			</div>
			<div class="media-body hidden-xs">
				<h4 class="media-heading" style="margin-top:40px;"><a data-toggle="collapse" href="#collapse{{ $subpl['subpl_id'] }}" aria-expanded="false" aria-controls="collapse{{ $subpl['subpl_id'] }}">{{ $subpl['name'] }}</a></h4>
				Beautiful, beautiful dice...
			</div>
			<div class="media-body visible-xs">
				<h4 class="media-heading" style="margin-top:10px;"><a data-toggle="collapse" href="#collapse{{ $subpl['subpl_id'] }}" aria-expanded="false" aria-controls="collapse{{ $subpl['subpl_id'] }}">{{ $subpl['name'] }}</a></h4>
				Beautiful, beautiful dice...
			</div>
			<a id="{{ $subpl['subpl_id'] }}"></a>
			<div class="collapse well well-sm {{ $subpl['open'] }}" id="collapse{{ $subpl['subpl_id']}}" style="margin-top:20px;">
				
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
						

					@include('components.productimage', ['code' => $p['code'], 'name' => $p['name'], 'size' => 'c', 'class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'false'])

					
					
					  <div>
						  <p><span style="font-weight:bold;">{{ $p['name'] }}</span><br />
						  @if(strlen($p['subtitle']) > 2)
						    {{ $p['subtitle'] }}<br />
						  @endif
						  {{ $p['code'] }}<br />
						  Prix sugg&eacute;r&eacute;: ${{ $p['msrp'] }}
						  
						  @if(Auth::check())
						  <br />
						  <div class="input-group" style="margin-left:auto;margin-right:auto;">
							@if(Auth::user()->rank > 1)
								@include('components.basket', ['product' => $p, 'verb' => 'tt'])
							@else
								@if($p['stock'] - $p['reserved'] > 0)
									@include('components.basket', ['product' => $p, 'verb' => 'buy'])
								@else
									@include('components.basket', ['product' => $p, 'verb' => 'reserve'])
								@endif
							@endif
						  </div>
						  @endif
						  
						  
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
						@if(strlen($pl['fg_color']) > 2)
			  <hr style="border-color: #{{ $pl['fg_color'] }};" />
			@else
			  <hr style="border-color: #cccccc;" />
			@endif
		</div>
  @endif
@endforeach

<!-- End subproductlines -->
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
<?php var_dump($subproductlines); ?>
</div>

