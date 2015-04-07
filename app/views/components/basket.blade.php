    {{ Form::open( array(
        'route' => 'ajax.update',
        'method' => 'post',
        'id' => 'basket'
    ) ) }}
  <input type="hidden" name="code" value="{{ $product['code'] }}">
  <input type="hidden" name="verb" value="{{ $verb }}">
@if($product['available'] < 5)
  <input id="{{ $verb }}-{{ $product['code'] }}" type="text" class="form-control" name="{{ $verb }}-{{ $product['code'] }}" value="
  @if($product['inBasket'] > 0)
	{{ $product['inBasket'] }}
  @elseif($product['inPreorder'] > 0)
    {{ $product['inPreorder'] }}
  @else
    1
  @endif
  " style="width:
@if($product['available'] == 2)
  60px;
 @elseif($product['available'] == 3)
  70px;
 @else
  50px;
 @endif

  @if($verb == 'tt')
	@if($product['inBasket'] > 0)
		color:#fff;background-color:#EC9923;
	@endif
  @else
	  @if($product['inBasket'] > 0)
		color:#fff;background-color:#4EA64E;
	  @elseif($product['inPreorder'] > 0)
		color:#fff;background-color:#D14642;
	  @endif
  @endif
  
  
  ">
@endif
  <!-- input name="buy" src="{{ asset('../img/goButton.png') }}" class="goButton" style="position:relative;top:6px;" type="image" -->
  
  @if($verb == 'buy')
	  <button type="submit" class="btn btn-success btn-sm" style="margin-top:20px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
  @elseif($verb == 'reserve')
	@if($product['available'] < 5)
      <button type="submit" class="btn btn-danger btn-sm" style="margin-top:20px;"><span class="glyphicon glyphicon-paperclip"></span> {{ $product['button'] }}</button>
    @else
	  <button type="submit" class="btn btn-danger btn-sm" style="margin-top:20px;" disabled="disabled"><span class="glyphicon glyphicon-paperclip"></span> {{ $product['button'] }}</button>
	@endif
  @else
      <button type="submit" class="btn btn-warning btn-sm" style="margin-top:20px;"><span class="glyphicon glyphicon-user"></span> p'tite t&ecirc;te</button>
  @endif
@if($product['available'] < 5)
  <script>
	$("input[name='{{ $verb }}-{{ $product['code'] }}']").TouchSpin({
	  min: 0,
	  max: 999
	});
  </script>
@endif
{{ Form::close() }}
