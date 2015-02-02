<div class="container center-block">
	<div class="row img-rounded hidden-xs center-block" style="background-image:url('../img/backgrounds/bgLcg523v2CR.jpeg');background-repeat:no-repeat;max-width:750px;">
		<div class="img-rounded center-block" style="margin-top:40px;max-width:680px;background-image:url('../img/transpDot.png');background-repeat: repeat;padding:10px;">
			{{ HTML::image('../img/covers/'.strtolower($code).'c.png', $f_name) }}
		</div>
	</div>
	
	<div class="img-rounded visible-xs" style="background-color:#F6F5F0;padding:10px;">
			{{ HTML::image('../img/covers/'.strtolower($code).'c.png', $f_name, array('class' => 'img-responsive')) }}
	</div>

	
</div>
