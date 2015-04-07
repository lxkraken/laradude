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

				    
@if($productline['header_product'] == 1)

		<!-- lg header image -->
		<!-- md header image -->
		<!-- sm header image -->
		<div class="row hidden-xs">
		  <div class="col-sm-6">
			@if(strlen($header_product['description']) > 3)
				@include('components.productimage', ['code' => $header_product['code'], 'name' => $header_product['name'], 'size' => 'c', 'class' => 'img-responsive pull-right', 'style' => '', 'linked' => 'true'])
			@else
				@include('components.productimage', ['code' => $header_product['code'], 'name' => $header_product['name'], 'size' => 'c', 'class' => 'img-responsive pull-right', 'style' => '', 'linked' => 'false'])
			@endif
		  </div>
		  <!-- End header image -->
			   
		  <!-- lg header description --> 
		  <!-- md header description -->
		  <!-- sm header description -->
		  <div class="col-sm-6">
			<h4><a href="/product/{{ $header_product['code'] }}">{{ $header_product['name'] }}</a></h4>
			<p>
			  {{ strtoupper($header_product['code']) }}
			
			  @if($header_product['prod_lang'] == 'f')
			    -&nbsp;&Eacute;dition fran&ccedil;aise<br/>
			  @elseif($header_product['prod_lang'] == 'e')
			    -&nbsp;&Eacute;dition anglaise<br/>
			  @elseif($header_product['prod_lang'] == 'm')
			    -&nbsp;&Eacute;dition multilingue<br/>
			  @endif
						  
			  Prix sugg&eacute;r&eacute;: ${{ $header_product['msrp'] }}
			</p>
			
			@if(Auth::user()->rank > 1)
				<p>Stock: {{ $header_product['stock'] }}&nbsp;&nbsp;&nbsp;&nbsp;Reserved: {{ $header_product['reserved'] }}</p>
			@endif
			
			<p>
              @if(strlen($header_product['players']) > 0)
			    Nombre de joueurs: {{ $header_product['players'] }}<br/>
			  @endif
						  
			  @if(strlen($header_product['age']) > 0)
			    &Agrave;ges: {{ $header_product['age'] }}<br/>
			  @endif
						  
			  @if(strlen($header_product['case_qty']) > 0 && $header_product['case_qty'] > 0)
			    Caisse compl&egrave;te: {{ $header_product['case_qty'] }}<br/>
			  @endif
						  
			  @if(strlen($header_product['upc']) > 0)
			    UPC: {{ $header_product['upc'] }}<br/>
			  @endif
						  
			  @if($header_product['prod_type'] == 1)
			    Mat&eacute;riel de base<br/>
			  @elseif($header_product['prod_type'] == 2)
			    Accessoire / Suppl&eacute;ment<br/>
			  @endif
			</p>
			
			<div class="input-group text-center">
				@if(Auth::user()->rank > 1)
					@include('components.basket', ['code' => $header_product['code'], 'verb' => 'tt'])
				@else
					@if($header_product['stock'] - $header_product['reserved'] > 0)
						@include('components.basket', ['code' => $header_product['code'], 'verb' => 'buy'])
					@else
						@include('components.basket', ['code' => $header_product['code'], 'verb' => 'reserve'])
					@endif
				@endif
			</div>

		  </div>

		<!-- End header description -->
		</div>
				    
		<!-- xs header image -->
		<div class="row visible-xs-block">
		  <div class="col-xs-12 text-center">
			  
			@if(strlen($header_product['description']) > 3)
				@include('components.productimage', ['code' => $header_product['code'], 'name' => $header_product['name'], 'size' => 't', 'class' => '', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'true'])
			@else
				@include('components.productimage', ['code' => $header_product['code'], 'name' => $header_product['name'], 'size' => 't', 'class' => '', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'false'])
			@endif

		  </div>
		  <!-- End header image -->
				      
		  <!-- xs header description -->
		  <div class="col-xs-12 text-center">
		    <h4>
			  @if(strlen($header_product['description']) > 3)
			    <a href="/product/{{ $header_product['code'] }}">
			  @endif
						  
			  {{ $header_product['name'] }}
						    
			  @if(strlen($header_product['description']) > 3)
			    </a>
			  @endif
			</h4>
			<div style="font-size:12px;">
			  <p>
			    {{ strtoupper($header_product['code']) }}
				
				@if($header_product['prod_lang'] == 'f')
				  &nbsp;-&nbsp;&Eacute;dition fran&ccedil;aise<br/>
				@elseif($header_product['prod_lang'] == 'e')
				  &nbsp;-&nbsp;&Eacute;dition anglaise<br/>
				@elseif($header_product['prod_lang'] == 'm')
				  &nbsp;-&nbsp;&Eacute;dition multilingue<br/>
				@endif
							  
				Prix sugg&eacute;r&eacute;: ${{ $header_product['msrp'] }}<br />

				@if($header_product['prod_type'] == 1)
				  Mat&eacute;riel de base<br/>
				@elseif($header_product['prod_type'] == 2)
				  Accessoire / Suppl&eacute;ment<br/>
				@endif
			  </p>
			@if(Auth::user()->rank > 1)
				<p>Stock: {{ $header_product['stock'] }}&nbsp;&nbsp;&nbsp;&nbsp;Reserved: {{ $header_product['reserved'] }}</p>
			@endif
			@if(Auth::check())
			<div class="input-group text-center">
				@if(Auth::user()->rank > 1)
					@include('components.basket', ['code' => $header_product['code'], 'verb' => 'tt'])
				@else
					@if($header_product['stock'] - $header_product['reserved'] > 0)
						@include('components.basket', ['code' => $header_product['code'], 'verb' => 'buy'])
					@else
						@include('components.basket', ['code' => $header_product['code'], 'verb' => 'reserve'])
					@endif
				@endif
			</div>
			@endif
			</div>
		  </div>

		  <!-- End header description -->
		</div>

@elseif(is_array($header_product))

  <?php
  
	$hCount = count($header_product);
	
	switch($hCount % 3)
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
  
  <div class="row">
  
  @foreach($header_product as $h)
  
	@if($hCount < 4)
		<div class="col-sm-{{ $grid }} text-center">
	@else
	    <div class="col-sm-4 text-center">
	@endif

	@if(strlen($h['description']) > 3)
		@include('components.productimage', ['code' => $h['code'], 'name' => $h['name'], 'size' => 'c', 'class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'true'])
	@else
		@include('components.productimage', ['code' => $h['code'], 'name' => $h['name'], 'size' => 'c', 'class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'false'])
	@endif
			
			
	<strong>{{ $h['name'] }}</strong>
		
	@if(strlen($h['description']) > 3)
	  </a>
	@endif
	
	<br />
	@if($h['prod_lang'] == 'f')
	  &Eacute;dition fran&ccedil;aise<br/>
	@elseif($h['prod_lang'] == 'e')
	  &Eacute;dition anglaise<br/>
	@elseif($h['prod_lang'] == 'm')
	  &Eacute;dition multilingue<br/>
	@endif
							  
	{{ strtoupper($h['code']) }}<br />
	Prix sugg&eacute;r&eacute;: ${{ $h['msrp'] }}
	
	@if(Auth::user()->rank > 1)
		<p>Stock: {{ $header_product['stock'] }}&nbsp;&nbsp;&nbsp;&nbsp;Reserved: {{ $header_product['reserved'] }}</p>
	@endif
	
	
			@if(Auth::check())
			<div class="input-group text-center" style="margin-left:auto;margin-right:auto;">
				@if(Auth::user()->rank > 1)
					@include('components.basket', ['code' => $h['code'], 'verb' => 'tt'])
				@else
					@if($h['stock'] - $h['reserved'] > 0)
						@include('components.basket', ['code' => $h['code'], 'verb' => 'buy'])
					@else
						@include('components.basket', ['code' => $h['code'], 'verb' => 'reserve'])
					@endif
				@endif
			</div>
			@endif
	
	<div class="visible-xs-block" style="height:30px;width:100%">&nbsp;</div>
	
	</div>

	@if($x == 3 || $x == $hCount)
		</div><div class="row" style="margin-top:30px;">
	@endif  
  
  @endforeach

	</div>

@endif

		
		
		
		<h3 style="margin-top:40px;">Extensions</h3>

        @if(strlen($productline['fg_color']) > 2)
          <hr style="border-color: #{{ $productline['fg_color'] }};" />
        @else
          <hr style="border-color: #cccccc;" />
        @endif
				

		  <div class="row">
			  
		<?php
			$prodCount = count($products);
			
			$x = 1;
		?>

		    @foreach($products as $p)
					
			  <div class="col-sm-4 text-center" style="padding:10px 8px;">
				  
			    @if(strlen($p['description']) > 3)
					@include('components.productimage', ['code' => $p['code'], 'name' => $p['name'], 'size' => 't', 'class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'true'])
				@else
					@include('components.productimage', ['code' => $p['code'], 'name' => $p['name'], 'size' => 't', 'class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;', 'linked' => 'false'])
				@endif

				<!-- lg extensions -->
				<!-- md extensions -->
				<div class="hidden-xs hidden-sm">			
					<strong>
					  {{ $p['name'] }}</strong><br />
					  @if($p['prod_lang'] == 'f')
						&Eacute;dition fran&ccedil;aise<br/>
					  @elseif($p['prod_lang'] == 'e')
						&Eacute;dition anglaise<br/>
					  @elseif($p['prod_lang'] == 'm')
						&Eacute;dition multilingue<br/>
					  @endif
							  
					  {{ strtoupper($p['code']) }}<br />
					  Prix sugg&eacute;r&eacute;: ${{ $p['msrp'] }}
					  
			@if(Auth::user()->rank > 1)
				<p>Stock: {{ $p['stock'] }}&nbsp;&nbsp;&nbsp;&nbsp;Reserved: {{ $p['reserved'] }}</p>
			@endif
			
			@if(Auth::check())
			<div class="input-group" style="margin-left:auto;margin-right:auto;margin-top:5px;margin-bottom:10px;">
				@if(Auth::user()->rank > 1)
					@include('components.basket', ['code' => $p['code'], 'verb' => 'tt'])
				@else
					@if($p['stock'] - $p['reserved'] > 0)
						@include('components.basket', ['code' => $p['code'], 'verb' => 'buy'])
					@else
						@include('components.basket', ['code' => $p['code'], 'verb' => 'reserve'])
					@endif
				@endif
			</div>
			@endif
				</div>
				
				<!-- sm extensions -->
				<!-- xs extensions -->
				<div class="visible-xs-block visible-sm-block" style="font-size:12px;">
					<strong>{{ $p['name'] }}</strong><br />
					  @if($p['prod_lang'] == 'f')
						&Eacute;dition fran&ccedil;aise<br/>
					  @elseif($p['prod_lang'] == 'e')
						&Eacute;dition anglaise<br/>
					  @elseif($p['prod_lang'] == 'm')
						&Eacute;dition multilingue<br/>
					  @endif
							  
					  {{ strtoupper($p['code']) }}<br />
					  Prix sugg&eacute;r&eacute;: ${{ $p['msrp'] }}
			
			@if(Auth::user()->rank > 1)
				<p>Stock: {{ $p['stock'] }}&nbsp;&nbsp;&nbsp;&nbsp;Reserved: {{ $p['reserved'] }}</p>
			@endif		  
			
			@if(Auth::check())
			<div class="input-group text-center">
				@if(Auth::user()->rank > 1)
					@include('components.basket', ['code' => $p['code'], 'verb' => 'tt'])
				@else
					@if($p['stock'] - $p['reserved'] > 0)
						@include('components.basket', ['code' => $p['code'], 'verb' => 'buy'])
					@else
						@include('components.basket', ['code' => $p['code'], 'verb' => 'reserve'])
					@endif
				@endif
			</div>
			@endif
		
				</div>
			  </div>
			  <?php
				if($x % 3 == 0) echo '</div><div class="row">';
				$x++;
			  ?>
			@endforeach


		</div>

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

