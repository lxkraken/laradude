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
    <div class="col-sm-9">
		
<!-- Main Window -->
		
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
			
				<!-- xs -->
				<h1 class="visible-xs-block" style="font-size:24px;">{{ $productline['name'] }}</h1>
						
				<!-- sm -->
				<h1 class="visible-sm-block" style="font-size:30px;">{{ $productline['name'] }}</h1>

				<h1 class="visible-lg-block visible-md-block" style="font-size:36px;">{{ $productline['name'] }}</h1>
						
        @if(strlen($productline['fg_color']) > 2)
          <hr style="border-color: #{{ $productline['fg_color'] }};" />
        @else
          <hr style="border-color: #cccccc;" />
        @endif
			
			<div class="row hidden-xs">
			  <div class="col-sm-6">
				@if(File::exists('img/covers/'.strtolower($product['code']).'c.png'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.png', $product['name'], array('class' => 'img-responsive pull-right')) }}
				@elseif(File::exists('img/covers/'.strtolower($product['code']).'c.jpg'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.jpg', $product['name'], array('class' => 'img-responsive pull-right')) }}				
				@elseif(File::exists('img/covers/'.strtolower($product['code']).'c.jpeg'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.jpeg', $product['name'], array('class' => 'img-responsive pull-right')) }}
				@elseif(File::exists('img/covers/'.strtolower($product['code']).'c.gif'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.gif', $product['name'], array('class' => 'img-responsive pull-right')) }}
				@endif
			  </div>
			  <div class="col-sm-6">
			    <h4>{{ $product['name'] }}</h4>
			    
				<p>{{ strtoupper($product['code']) }}
				
				 @if($product['prod_lang'] == 'f')
				   &nbsp;-&nbsp;&Eacute;dition fran&ccedil;aise<br/>
				 @elseif($product['prod_lang'] == 'e')
				    &nbsp;-&nbsp;&Eacute;dition anglaise<br/>
				 @elseif($product['prod_lang'] == 'm')
				    &nbsp;-&nbsp;&Eacute;dition multilingue<br/>
				 @endif
						  
				 Prix sugg&eacute;r&eacute;: ${{ $product['msrp'] }}
				</p>
				<p>
			    @if(strlen($product['players']) > 0)
				  Nombre de joueurs: {{ $product['players'] }}<br/>
				@endif
						  
				@if(strlen($product['age']) > 0)
				  &Agrave;ges: {{ $product['age'] }}<br/>
				@endif
						  
				@if(strlen($product['case_qty']) > 0 && $product['case_qty'] > 0)
				  Caisse compl&egrave;te: {{ $product['case_qty'] }}<br/>
				@endif
						  
				@if(strlen($product['upc']) > 0)
				  UPC: {{ $product['upc'] }}<br/>
				@endif
				
				@if($product['prod_type'] == 1)
					Mat&eacute;riel de base<br/>
				@elseif($product['prod_type'] == 2)
					Accessoire / Suppl&eacute;ment<br/>
				@endif
				
				</p>
				<div class="input-group text-center">
				  
				  {{ Form::open(array('url' => 'foo/bar')) }}

						<input id="buy-{{ $product['code'] }}" type="text" class="form-control" name="buy-{{ $product['code'] }}" value="1" style="width:40px;">
						<!-- input name="buy" src="{{ asset('../img/goButton.png') }}" class="goButton" style="position:relative;top:6px;" type="image" -->
						    <button type="submit" class="btn btn-success btn-sm" style="margin-top:20px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
					<script>
						$("input[name='buy-{{ $product['code'] }}']").TouchSpin({
							min: 1
							});
					</script>

					{{ Form::close() }}
				</div>
	  
			  </div>
			</div>
			
			<div class="row visible-xs-block">
			  <div class="col-xs-12">
				@if(File::exists('img/covers/'.strtolower($product['code']).'c.png'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.png', $product['name'], array('class' => 'img-responsive pull-right')) }}
				@elseif(File::exists('img/covers/'.strtolower($product['code']).'c.jpg'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.jpg', $product['name'], array('class' => 'img-responsive pull-right')) }}				
				@elseif(File::exists('img/covers/'.strtolower($product['code']).'c.jpeg'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.jpeg', $product['name'], array('class' => 'img-responsive pull-right')) }}
				@elseif(File::exists('img/covers/'.strtolower($product['code']).'c.gif'))
				  {{ HTML::image('img/covers/'.strtolower($product['code']).'c.gif', $product['name'], array('class' => 'img-responsive pull-right')) }}
				@endif
			  </div>
			  <div class="col-xs-12 text-center">
			    <h4>{{ $product['name'] }}</h4>
			    
				<p>{{ strtoupper($product['code']) }}
				
				 @if($product['prod_lang'] == 'f')
				   &nbsp;-&nbsp;&Eacute;dition fran&ccedil;aise<br/>
				 @elseif($product['prod_lang'] == 'e')
				    &nbsp;-&nbsp;&Eacute;dition anglaise<br/>
				 @elseif($product['prod_lang'] == 'm')
				    &nbsp;-&nbsp;&Eacute;dition multilingue<br/>
				 @endif
						  
				 Prix sugg&eacute;r&eacute;: ${{ $product['msrp'] }}<br />

			    @if(strlen($product['players']) > 0)
				  Nombre de joueurs: {{ $product['players'] }}<br/>
				@endif
						  
				@if(strlen($product['age']) > 0)
				  &Agrave;ges: {{ $product['age'] }}<br/>
				@endif
						  
				@if(strlen($product['case_qty']) > 0 && $product['case_qty'] > 0)
				  Caisse compl&egrave;te: {{ $product['case_qty'] }}<br/>
				@endif
						  
				@if(strlen($product['upc']) > 0)
				  UPC: {{ $product['upc'] }}<br/>
				@endif
				
				@if($product['prod_type'] == 1)
					Mat&eacute;riel de base<br/>
				@elseif($product['prod_type'] == 2)
					Accessoire / Suppl&eacute;ment<br/>
				@endif
				
				</p>
				<div class="input-group" style="margin-left:auto;margin-right:auto;">
				  
				  {{ Form::open(array('url' => 'foo/bar')) }}
				  {{ Form::label('qty', 'J\'en veux:') }}
				  {{ Form::number('qty', 1, array('style' => 'color:#000;width:40px;padding-left:5px;', 'class' => 'img-rounded')) }}
				  <input name="buy" src="{{ asset('../img/goButton.png') }}" class="goButton" style="position:relative;top:4px;" type="image">
					{{ Form::close() }}
				</div>
	  
			  </div>
			</div>
			
			
			<p style="margin-top:40px;">{{ $product['description'] }}</p>

		</div>
	  </div>
	
<!-- End Main Window -->

      </div>
	  <div class="col-sm-3">
	  <div>
		<div class="img-rounded" style="background-color:#ff0;height:200px;">Extra Info</div>
	  </div>
	  <div>
	    <div class="img-rounded" style="background-color:#ff0;height:200px;">Extra Info</div>
	  </div>		  
      </div>
  </div>
  <div class="row">

	  
  </div>	  

</div>

