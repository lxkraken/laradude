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
    <div class="col-sm-9">
		
<!-- Main Window -->
		
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
			
				<!-- xs -->
				<h1 class="visible-xs-block" style="font-size:24px;">{{ $pl['name'] }}</h1>
						
				<!-- sm -->
				<h1 class="visible-sm-block" style="font-size:30px;">{{ $pl['name'] }}</h1>

				<h1 class="visible-lg-block visible-md-block" style="font-size:36px;">{{ $pl['name'] }}</h1>
						
        @if(strlen($pl['fg_color']) > 2)
          <hr style="border-color: #{{ $pl['fg_color'] }};" />
        @else
          <hr style="border-color: #cccccc;" />
        @endif
			
			<div class="row hidden-xs">
			  <div class="col-sm-6">

			  @include('components.productimage', ['code' => $p['code'], 'name' => $p['name'], 'size' => 'c', 'class' => 'img-responsive pull-right', 'style' => '', 'linked' => 'false'])


			  </div>
			  <div class="col-sm-6">
			    <h4>{{ $p['name'] }}</h4>
			    
				<p>{{ strtoupper($p['code']) }}
				
				 @if($p['prod_lang'] == 'f')
				   -&nbsp;{{ Lang::get('catalogue.frenched') }}<br/>
				 @elseif($p['prod_lang'] == 'e')
				    -&nbsp;{{ Lang::get('catalogue.englished') }}<br/>
				 @elseif($p['prod_lang'] == 'm')
				    -&nbsp;{{ Lang::get('catalogue.multied') }}<br/>
				 @endif
						  
				 {{ Lang::get('catalogue.msrp') }}: ${{ $p['msrp'] }}
				</p>
				<p>
			    @if(strlen($p['players']) > 0)
				  {{ Lang::get('catalogue.numplayers') }}: {{ $p['players'] }}<br/>
				@endif
						  
				@if(strlen($p['age']) > 0)
				  {{ Lang::get('catalogue.ages') }}: {{ $p['age'] }}<br/>
				@endif
						  
				@if(strlen($p['case_qty']) > 0 && $p['case_qty'] > 0)
				  {{ Lang::get('catalogue.caseqty') }}: {{ $p['case_qty'] }}<br/>
				@endif
						  
				@if(strlen($p['upc']) > 0)
				  UPC: {{ $p['upc'] }}<br/>
				@endif
				
				@if($p['prod_type'] == 1)
					{{ Lang::get('catalogue.core') }}<br/>
				@elseif($p['prod_type'] == 2)
					{{ Lang::get('catalogue.expansion') }}<br/>
				@endif
				
				</p>
				
				
				@if(Auth::check())
					<div class="input-group text-center">
					  
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
			
			<div class="row visible-xs-block">
			  <div class="col-xs-12">
				@include('components.productimage', ['code' => $p['code'], 'name' => $p['name'], 'size' => 'c', 'class' => 'img-responsive pull-right', 'style' => '', 'linked' => 'false'])
			  </div>
			  <div class="col-xs-12 text-center">
			    <h4>{{ $p['name'] }}</h4>
			    
				<p>{{ strtoupper($p['code']) }}
				
				 @if($p['prod_lang'] == 'f')
				   -&nbsp;{{ Lang::get('catalogue.frenched') }}<br/>
				 @elseif($p['prod_lang'] == 'e')
				    -&nbsp;{{ Lang::get('catalogue.englished') }}<br/>
				 @elseif($p['prod_lang'] == 'm')
				    -&nbsp;{{ Lang::get('catalogue.multied') }}<br/>
				 @endif
						  
				 {{ Lang::get('catalogue.msrp') }}: ${{ $p['msrp'] }}<br />

			    @if(strlen($p['players']) > 0)
				  {{ Lang::get('catalogue.numplayers') }}: {{ $p['players'] }}<br/>
				@endif
						  
				@if(strlen($p['age']) > 0)
				  {{ Lang::get('catalogue.ages') }}: {{ $p['age'] }}<br/>
				@endif
						  
				@if(strlen($p['case_qty']) > 0 && $p['case_qty'] > 0)
				  {{ Lang::get('catalogue.caseqty') }}: {{ $p['case_qty'] }}<br/>
				@endif
						  
				@if(strlen($p['upc']) > 0)
				  UPC: {{ $p['upc'] }}<br/>
				@endif
				
				@if($p['prod_type'] == 1)
					{{ Lang::get('catalogue.core') }}<br/>
				@elseif($p['prod_type'] == 2)
					{{ Lang::get('catalogue.expansion') }}<br/>
				@endif
				
				</p>
				@if(Auth::check())
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
			
			
			<p style="margin-top:40px;">{{ $p['description'] }}</p>

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

