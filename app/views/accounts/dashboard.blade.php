<div class="container">
	<div class="form pull-right text-center img-rounded" style="background-color:#fff;padding:10px;">
		<h4 style="font-weight:bold;">Ben Salut, {{ $user->username }}!</h4>
		Comment &ccedil;a va, ce soir?<br />
		
		<small>Derni&egrave;re connexion: {{ $user->last_login }}</small>
		<form action="{{ action('AccountController@postLogout') }}" method="POST">
			<button type="submit" class="btn btn-primary btn-sm" value="">&Agrave; plus, man...</button>
		</form>

	</div>

</div>

