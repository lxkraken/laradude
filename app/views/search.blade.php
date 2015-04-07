@include('components.ajax')

<div class="container center-block" style="margin-bottom:100px;">
	
	<div class="row">
		
		@if(isset($products))
		
			<h2>R&eacute;sultats pour la recherche "
			@if(strlen(Input::get('q')) > 20)
				{{ substr(Input::get('q'), 0, 30) }}...
			@else
				{{ Input::get('q') }}
			@endif
			"</h2>
			<hr style="border-color: #000;">
			
		  <?php
		  
			$x = 1;
			
		  ?>
		
			@foreach($products as $p)
			
				<div class="col-sm-3" style="text-align:center;margin-bottom:40px;max-height:500px;">
					
				@include('components.productimage', ['code' => $p['code'], 'name' => $p['name'], 'size' => 'c', 'class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;max-height:200px;', 'linked' => 'true'])

			  <p><span style="font-weight:bold;">{{ $p['name'] }}</span><br />{{ $p['code'] }}<br />Prix sugg&eacute;r&eacute;: ${{ $p['msrp'] }}</p>
			
			@if(Auth::check())
			<div class="input-group text-center" style="margin-left:auto;margin-right:auto;">
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
			  <?php
				if($x % 4 == 0) echo '</div><hr style="border-color:#ccc;" /><div class="row">';
				$x++;
			  ?>
				
			@endforeach
			
		@else
		
			<h1>D&eacute;sol&eacute;...</h1>
			<h4>Aucun résultat correspondant à votre recherche n’a été trouvé.</h4>
			
		@endif
		
		
		
	</div>
</div>

