<div class="container">
	<form class="form-group" id="preorder" method="POST" action="/preorder" accept-charset="UTF-8">
<div class="pull-right" style="margin-top:10px;"><button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-refresh"></span> {{ Lang::get('basket.refresh') }}</button></div>	
  <h1>{{ Lang::get('basket.preorder') }}</h1>
  
  <hr style="border-color:#000;">
	  <div class="col-sm-12">
		
		<table class="table table-striped table-condensed">
		  <tr style="font-weight:bold;text-align:center;">
			  <td style="vertical-align:middle;">Code</td>
			  <td style="vertical-align:middle;">Description</td>
			  <td style="vertical-align:middle;">{{ Lang::get('basket.qty') }}</td>
			  <td style="vertical-align:middle;">{{ Lang::get('catalogue.msrp') }}</td>
			  <td style="vertical-align:middle;">Status</td>
			  <td>&nbsp;</td>
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
			  <td style="text-align:center;vertical-align:middle;">{{ $i['status'] }}</td>
			  <td  class="remove-item" style="text-align:center;vertical-align:middle;"><a href="/preorder/remove/{{ $i['code'] }}" id="remove-{{ $i['code'] }}" alt="{{ Lang::get('basket.remove') }} {{ $i['code'] }} {{ Lang::get('basket.frompreorder') }}" title="{{ Lang::get('basket.remove') }} {{ $i['code'] }} {{ Lang::get('basket.frompreorder') }}"><span class="glyphicon glyphicon-remove"></span></a></td>
		  <script language="javascript" type="text/javascript">
			$("input[name='{{ $i['code'] }}']").TouchSpin({
			  min: 0,
			  max: 1000
			});
		  </script>
		  </tr>
		  @endforeach
		  
		</table>
		
	  </div>
	  
	  
		
	  </div>
		  
	</form>
</div>

