<div class="container center-block" style="margin-bottom:100px;">
	
	<div class="row">
		
		@if(isset($products))
		
			<h2>R&eacute;sultats pour la recherche "{{ Input::get('q') }}"</h2>
			<hr style="border-color: #000;">
			
		  <?php
		  
			$x = 1;
			
		  ?>
		
			@foreach($products as $p)
			
				<div class="col-sm-3" style="text-align:center;margin-bottom:40px;">

				@if(File::exists('img/covers/'.strtolower($p->code).'c.png'))
				  {{ HTML::image('img/covers/'.strtolower($p->code).'c.png', $p->f_name, array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
				@elseif(File::exists('img/covers/'.strtolower($p->code).'c.jpg'))
				  {{ HTML::image('img/covers/'.strtolower($p->code).'c.jpg', $p->f_name, array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}				
				@elseif(File::exists('img/covers/'.strtolower($p->code).'c.jpeg'))
				  {{ HTML::image('img/covers/'.strtolower($p->code).'c.jpeg', $p->f_name, array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
				@elseif(File::exists('img/covers/'.strtolower($p->code).'c.gif'))
				  {{ HTML::image('img/covers/'.strtolower($p->code).'c.gif', $p->f_name, array('class' => 'img-responsive', 'style' => 'margin-left:auto;margin-right:auto;')) }}
				@endif
				  <p><span style="font-weight:bold;">{{ $p->f_name }}</span><br />{{ $p->code }}<br />Prix sugg&eacute;r&eacute;: ${{ $p->msrp }}</p>
				  
			<div class="input-group text-center" style="margin-left:auto;margin-right:auto;">
			{{ Form::open(array('url' => 'foo/bar')) }}

				<input id="buy-{{ $p->code }}" type="text" class="form-control" name="buy-{{ $p->code }}" value="1" style="width:40px;">
				<button type="submit" class="btn btn-success btn-sm" style="margin-top:10px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
				<script>
					$("input[name='buy-{{ $p->code }}']").TouchSpin({
						min: 1
					});
				</script>

			{{ Form::close() }}
			</div>
				</div>
			  <?php
				if($x % 4 == 0) echo '</div><div class="row">';
				$x++;
			  ?>
				
			@endforeach
			
		@else
		
			<h1>D&eacute;sol&eacute;...</h1>
			<h4>Aucun résultat correspondant à votre recherche n’a été trouvé.</h4>
			
		@endif
		
		
		
	</div>
</div>

