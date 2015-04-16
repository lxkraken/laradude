<div class="container">
	<div class="form pull-right text-center img-rounded whitebox">
		<h4 style="font-weight:bold;">{{ Lang::get('account.hey') }}, {{ $user->username }}!</h4>
		{{ Lang::get('account.howgoes') }}<br />
		
		<small>{{ Lang::get('account.lastlogin') }} {{ $user->last_login }}</small>
		<form action="{{ action('AccountController@postLogout') }}" method="POST">
			<button type="submit" class="btn btn-primary btn-sm" value="">{{ Lang::get('account.cul8r') }}</button>
		</form>

	</div>

</div>

