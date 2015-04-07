<div class="container">
  <h1>Les cossins dans ton panier...</h1>
  <hr style="border-color:#000;">
	<div class="row">
		<div class="col-sm-3">
			<div style="position:fixed;max-width:250px;">
				<script language="javascript" type="text/javascript">
					function submitBasket()
					{
						$('#formAction').html('<input type="hidden" name="formAction" value="submitBasket" />');
						$('#basket').submit();
					}
					function refreshBasket()
					{
						$('#formAction').html('<input type="hidden" name="formAction" value="refreshBasket" />');
						$('#basket').submit();
					}
					
				</script>
				
				<div class="img-rounded" style="background-color:#fff;min-height:200px;padding:20px;">
					<div>
						<table class="table">
							<tr>
								<td>Sous-total:</td><td style="padding-left:10px;text-align:right;">${{ $subtotal }}</td>
							</tr>
							<tr>
								<td>TPS:</td><td style="padding-left:10px;text-align:right;">${{ $taxes['gst'] }}</td>
							</tr>
							<tr>
								<td>TVQ:</td><td style="padding-left:10px;text-align:right;">${{ $taxes['pst'] }}</td>
							</tr>
							<tr class="info">
								<td><strong>Grand total:</strong></td><td style="padding-left:10px;text-align:right;"><strong>${{ $grandTotal }}</strong></td>
							</tr>
						</table>
					  </div>
					<div class="text-center">
						<button class="btn btn-success" type="button" onClick="submitBasket()"><span class="glyphicon glyphicon-ok"></span> Confirmer la commande</button>
					</div>
					<div class="text-center" style="margin-top:40px;">
						<button class="btn btn-info" type="button" onClick="refreshBasket()"><span class="glyphicon glyphicon-refresh"></span> Rafra&icirc;chir</button>
					</div>
				</div>
				@if(Auth::check() && Auth::user()->rank > 1)
				<div class="img-rounded" style="background-color:#ff0;min-height:200px;padding:10px;margin-top:20px;">
					<form class="form-group" id="quickSearch" method="POST" action="/basket/quicksearch" accept-charset="UTF-8">
						<input type="text" class="form-control input-sm" name="qs" placeholder="Rechercher &amp; Rajouter"
						@if(isset($qsQuery))
							value="{{ $qsQuery }}"
						@endif

						/>
						<button class="btn btn-default" type="submit">Rechercher</button>
					</form>
					@if(isset($qsResults))
						<div>{{ $qsMsg }}</div>
						
						@foreach($qsResults as $q)
							<div>{{ $q['name'] }}</div>
							<div>{{ $q['code'] }} {{ $q['msrp'] }}</div>
							<form class="form-control">
								<input type="text" name="qs-{{ $q['code'] }}" value="{{ $q['inBasket'] }}" />
							</form>
								
						@endforeach
					@endif
				</div>
				@endif
		    </div>
		
	    </div>
	  <div class="col-sm-9">
		<form class="form-group" id="basket" method="POST" action="/basket" accept-charset="UTF-8">
		<table class="table table-striped table-condensed">
		  <tr style="font-weight:bold;text-align:center;">
			  <td style="vertical-align:middle;">Code</td>
			  <td style="vertical-align:middle;">Description</td>
			  <td style="vertical-align:middle;">Quantit&eacute;</td>
			  <td style="vertical-align:middle;">Prix Sugger&eacute;</td>
			  <td style="vertical-align:middle;">Votre Prix</td>
			  <td style="vertical-align:middle;">Total</td>
			  <td><span id="formAction"></span></td>
		  </tr>

		  @foreach($items as $i)
		  <tr>
			  <td style="text-align:center;vertical-align:middle;">{{ $i['code'] }}</td>
			  <td style="padding-top:10px;vertical-align:middle;">
				  @if(strlen($i['link']) > 0)
					<a id="{{ $i['code'] }}" href="{{ $i['link'] }}">
				  @endif
				  {{ $i['name'] }}
				  @if(strlen($i['link']) > 0)
				    </a>
				  @endif
				  </td>
			  <td style="text-align:center;width:130px;vertical-align:middle;"><input type="text" name="{{ $i['code'] }}" value="{{ $i['qty'] }}" /></td>
			  <td style="text-align:center;vertical-align:middle;">${{ $i['msrp'] }}</td>
			  <td style="text-align:center;vertical-align:middle;">${{ $i['retailer_price'] }}</td>
			  <td style="text-align:center;vertical-align:middle;">${{ $i['total'] }}</td>
			  <td  class="remove-item" style="text-align:center;vertical-align:middle;"><a href="/basket/remove/{{ $i['code'] }}" id="remove-{{ $i['code'] }}" alt="Supprimer {{ $i['code'] }} du panier" title="Supprimer {{ $i['code'] }} du panier"><span class="glyphicon glyphicon-remove"></span></a></td>
		  <script language="javascript" type="text/javascript">
			$("input[name='{{ $i['code'] }}']").TouchSpin({
			  min: 0,
			  max: 1000
			});
		  </script>
		  </tr>
		  @endforeach
		  
		</table>
		</form>
	  </div>
	  
	  
		
	  </div>
		  

</div>

