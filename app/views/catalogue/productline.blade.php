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
			  <a href="/product/{{ $header_product['code'] }}">
			@endif
			
			@if(File::exists('img/covers/'.strtolower($header_product['code']).'c.png'))
			  {{ HTML::image('img/covers/'.strtolower($header_product['code']).'c.png', $header_product['name'], array('class' => 'img-responsive pull-right')) }}
			@elseif(File::exists('img/covers/'.strtolower($header_product['code']).'c.jpg'))
			  {{ HTML::image('img/covers/'.strtolower($header_product['code']).'c.jpg', $header_product['name'], array('class' => 'img-responsive pull-right')) }}				
			@elseif(File::exists('img/covers/'.strtolower($header_product['code']).'c.jpeg'))
			  {{ HTML::image('img/covers/'.strtolower($header_product['code']).'c.jpeg', $header_product['name'], array('class' => 'img-responsive pull-right')) }}
		    @elseif(File::exists('img/covers/'.strtolower($header_product['code']).'c.gif'))
			  {{ HTML::image('img/covers/'.strtolower($header_product['code']).'c.gif', $header_product['name'], array('class' => 'img-responsive pull-right')) }}
		    @endif
						
			@if(strlen($header_product['description']) > 3)
			  </a>
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
			    &nbsp;-&nbsp;&Eacute;dition fran&ccedil;aise<br/>
			  @elseif($header_product['prod_lang'] == 'e')
			    &nbsp;-&nbsp;&Eacute;dition anglaise<br/>
			  @elseif($header_product['prod_lang'] == 'm')
			    &nbsp;-&nbsp;&Eacute;dition multilingue<br/>
			  @endif
						  
			  Prix sugg&eacute;r&eacute;: ${{ $header_product['msrp'] }}
			</p>
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
			{{ Form::open(array('url' => 'foo/bar')) }}

				<input id="buy-{{ $header_product['code'] }}" type="text" class="form-control" name="buy-{{ $header_product['code'] }}" value="1" style="width:40px;">
				<button type="submit" class="btn btn-success btn-sm" style="margin-top:10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
				<script>
					$("input[name='buy-{{ $header_product['code'] }}']").TouchSpin({
						min: 1
					});
				</script>

			{{ Form::close() }}
			</div>

		  </div>

		<!-- End header description -->
		</div>
				    
		<!-- xs header image -->
		<div class="row visible-xs-block">
		  <div class="col-xs-12 text-center">
		    @if(strlen($header_product['description']) > 3)
			  <a href="/product/{{ $header_product['code'] }}">
			@endif
			
			@if(File::exists('img/thumbs/'.strtolower($header_product['code']).'t.png'))
			  {{ HTML::image('img/thumbs/'.strtolower($header_product['code']).'t.png', $header_product['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
			@elseif(File::exists('img/thumbs/'.strtolower($header_product['code']).'t.jpg'))
			  {{ HTML::image('img/thumbs/'.strtolower($header_product['code']).'t.jpg', $header_product['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}				
			@elseif(File::exists('img/thumbs/'.strtolower($header_product['code']).'t.jpeg'))
			  {{ HTML::image('img/thumbs/'.strtolower($header_product['code']).'t.jpeg', $header_product['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
			@elseif(File::exists('img/thumbs/'.strtolower($header_product['code']).'t.gif'))
			  {{ HTML::image('img/thumbs/'.strtolower($header_product['code']).'t.gif', $header_product['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
			@endif
						
			@if(strlen($header_product['description']) > 3)
			  </a>
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
			<div class="input-group text-center">
			{{ Form::open(array('url' => 'foo/bar')) }}

				<input id="buy-{{ $header_product['code'] }}" type="text" class="form-control" name="buy-{{ $header_product['code'] }}" value="1" style="width:40px;">
				<button type="submit" class="btn btn-success btn-sm" style="margin-top:10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
				<script>
					$("input[name='buy-{{ $header_product['code'] }}']").TouchSpin({
						min: 1
					});
				</script>

			{{ Form::close() }}
			</div>
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
	  <a href="/product/{{ $h['code'] }}">
	@endif
		
	@if(File::exists('img/covers/'.strtolower($h['code']).'c.png'))
	  {{ HTML::image('img/covers/'.strtolower($h['code']).'c.png', $h['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
	@elseif(File::exists('img/covers/'.strtolower($h['code']).'c.jpg'))
	  {{ HTML::image('img/covers/'.strtolower($h['code']).'c.jpg', $h['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}				
	@elseif(File::exists('img/covers/'.strtolower($h['code']).'c.jpeg'))
	  {{ HTML::image('img/covers/'.strtolower($h['code']).'c.jpeg', $h['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
    @elseif(File::exists('img/covers/'.strtolower($h['code']).'c.gif'))
	  {{ HTML::image('img/covers/'.strtolower($h['code']).'c.gif', $h['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
    @endif
						
	@if(strlen($h['description']) > 3)
	  </a>
	@endif
			
	@if(strlen($h['description']) > 3)
	  <a href="/product/{{ $h['code'] }}">
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
			<div class="input-group text-center">
			{{ Form::open(array('url' => 'foo/bar')) }}

				<input id="buy-{{ $h['code'] }}" type="text" class="form-control" name="buy-{{ $h['code'] }}" value="1" style="width:40px;">
				<button type="submit" class="btn btn-success btn-sm" style="margin-top:10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
				<script>
					$("input[name='buy-{{ $h['code'] }}']").TouchSpin({
						min: 1
					});
				</script>

			{{ Form::close() }}
			</div>
	
	<div class="visible-xs-block" style="height:30px;width:100%">&nbsp;</div>
	
	</div>

	@if($x == 3 || $x == $hCount)
		</div><div class="row" style="margin-top:30px;">
	@endif  
  
  @endforeach

	</div>

@endif

		
		
		
		<h4 style="margin-top:40px;"><a data-toggle="collapse" href="#collapseExtensions" aria-expanded="true" aria-controls="collapseExtensions">Extensions</a></h4>

        @if(strlen($productline['fg_color']) > 2)
          <hr style="border-color: #{{ $productline['fg_color'] }};" />
        @else
          <hr style="border-color: #cccccc;" />
        @endif
				
		<div class="collapse in" id="collapseExtensions">
		
				
		  <div class="row">
			  
		<?php
			$prodCount = count($products);
			
			$x = 1;
		?>

		    @foreach($products as $p)
					
			  <div class="col-sm-4 text-center" style="padding:10px 8px;">
			    @if(strlen($p['description']) > 3)
				  <a href="/product/{{ $p['code'] }}">
				@endif
							
				@if(File::exists('img/thumbs/'.strtolower($p['code']).'t.png'))
				  {{ HTML::image('img/thumbs/'.strtolower($p['code']).'t.png', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
				@elseif(File::exists('img/thumbs/'.strtolower($p['code']).'t.jpg'))
				  {{ HTML::image('img/thumbs/'.strtolower($p['code']).'t.jpg', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}				
				@elseif(File::exists('img/thumbs/'.strtolower($p['code']).'t.jpeg'))
				  {{ HTML::image('img/thumbs/'.strtolower($p['code']).'t.jpeg', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
				@elseif(File::exists('img/thumbs/'.strtolower($p['code']).'t.gif'))
				  {{ HTML::image('img/thumbs/'.strtolower($p['code']).'t.gif', $p['name'], array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
				@endif
							
				@if(strlen($p['description']) > 3)
				  </a>
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
			<div class="input-group" style="margin-left:auto;margin-right:auto;margin-top:5px;margin-bottom:10px;">
			{{ Form::open(array('url' => 'foo/bar')) }}

				<input id="buy-{{ $p['code'] }}" type="text" class="form-control" name="buy-{{ $p['code'] }}" value="1" style="width:40px;">
				<button type="submit" class="btn btn-danger btn-sm" style="margin-top:10px;">R&eacute;server</button>
				<script>
					$("input[name='buy-{{ $p['code'] }}']").TouchSpin({
						min: 1
					});
				</script>

			{{ Form::close() }}
			</div>
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
			<div class="input-group text-center">
			{{ Form::open(array('url' => 'foo/bar')) }}

				<input id="buy-{{ $p['code'] }}" type="text" class="form-control" name="buy-{{ $p['code'] }}" value="1" style="width:40px;">
				<button type="submit" class="btn btn-danger btn-sm" style="margin-top:10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
				<script>
					$("input[name='buy-{{ $p['code'] }}']").TouchSpin({
						min: 1
					});
				</script>

			{{ Form::close() }}
			</div>					
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
  </div>
		
  <div class="col-sm-3">
	<div class="img-rounded" style="background-color:#ff0;height:200px;">Extra Info</div>
  </div>
  <div class="col-sm-3" style="margin-top:20px;">
	<div class="img-rounded" style="background-color:#ff0;height:200px;">Extra Info</div>
  </div>
</div>

</div>


<?php

var_dump($header_product);

echo '<br /><br />';

var_dump($products); ?>
