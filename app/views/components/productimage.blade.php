@if($linked == 'true')
  <a href="/product/{{ $code }}">
@endif

@if($size == 'c')
	@if(File::exists('img/covers/'.strtolower($code).$size.'.png'))
	  {{ HTML::image('img/covers/'.strtolower($code).$size.'.png', $name, array('class' => $class, 'style' => $style)) }}
	@elseif(File::exists('img/covers/'.strtolower($code).$size.'.jpg'))
	  {{ HTML::image('img/covers/'.strtolower($code).$size.'.jpg', $name, array('class' => $class, 'style' => $style)) }}				
	@elseif(File::exists('img/covers/'.strtolower($code).$size.'.jpeg'))
	  {{ HTML::image('img/covers/'.strtolower($code).$size.'.jpeg', $name, array('class' => $class, 'style' => $style)) }}
	@elseif(File::exists('img/covers/'.strtolower($code).$size.'.gif'))
	  {{ HTML::image('img/covers/'.strtolower($code).$size.'.gif', $name, array('class' => $class, 'style' => $style)) }}
	@endif
@else
	@if(File::exists('img/thumbs/'.strtolower($code).$size.'.png'))
	  {{ HTML::image('img/thumbs/'.strtolower($code).$size.'.png', $name, array('class' => $class, 'style' => $style)) }}
	@elseif(File::exists('img/thumbs/'.strtolower($code).$size.'.jpg'))
	  {{ HTML::image('img/thumbs/'.strtolower($code).$size.'.jpg', $name, array('class' => $class, 'style' => $style)) }}				
	@elseif(File::exists('img/thumbs/'.strtolower($code).$size.'.jpeg'))
	  {{ HTML::image('img/thumbs/'.strtolower($code).$size.'.jpeg', $name, array('class' => $class, 'style' => $style)) }}
	@elseif(File::exists('img/thumbs/'.strtolower($code).$size.'.gif'))
	  {{ HTML::image('img/thumbs/'.strtolower($code).$size.'.gif', $name, array('class' => $class, 'style' => $style)) }}
	@endif
@endif
						
@if($linked == 'true')
  </a>
@endif
