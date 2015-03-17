<div class="container-fluid">
	<div class="form">
		<div class="form-group center-block" style="max-width:500px;">
		
		<h2 class="form-remind-heading">R&eacute;inisialiser votre mot de passe</h2>

<form action="{{ action('RemindersController@postReset') }}" method="POST">
	<div class="form-group">
    <input type="hidden" name="token" value="{{ $token }}">
		{{ Form::label('email', 'Adresse courriel', array('for'=>'email')) }}
		{{ Form::email('email', null, array('class'=>'form-control', 'id' => 'email', 'placeholder'=>'Adresse courriel')) }}
	</div>
	<div class="form-group">
    {{ Form::label('password', 'Nouveau mot de passe', array('for' => 'password')) }}<br />
    {{ Form::password('password', null, array('class' => 'form-control', 'id' => 'password')) }}
    </div>
    <div class="form-group">
    {{ Form::label('password_confirmation', 'Confirmer le nouveau mot de passe', array('for' => 'password_confirmation')) }}<br />
    {{ Form::password('password_confirmation', null, array('class' => 'form-control', 'id' => 'password_confirmation')) }}
    </div>

    <input type="submit" value="R&eacute;initialiser">
</form>

{{ Session::get('error') }}

	  </div>
	</div>
</div>
