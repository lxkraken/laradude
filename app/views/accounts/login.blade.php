<div class="container-fluid">
	<div class="form">
		<div class="form-group center-block" style="max-width:500px;">

{{ Form::open(array('url'=>'account/signin')) }}

    <h2 class="form-signin-heading">Se connecter</h2>
	<div class="form-group">
		{{ Form::label('username', 'Nom d\'utilisateur', array('for'=>'username')) }}	
		{{ Form::text('username', null, array('class'=>'form-control', 'id' => 'username', 'placeholder'=>'Nom d\'utilisateur')) }}
	</div>
	<div class="form-group">
		{{ Form::label('password', 'Mot de passe', array('for'=>'password')) }}
		{{ Form::password('password', array('class'=>'form-control', 'id' => 'inputPassword', 'placeholder'=>'Mot de passe')) }}
	</div>
	<div class="form-group">
		{{ Form::checkbox('remember', '1', 'true') }} {{ Form::label('remember', 'Se souvenir de moi', array('for'=>'remember')) }}
	</div>
 
    {{ Form::submit('Se connecter', array('class'=>'btn btn-primary'))}} <span style="float:right;">{{ HTML::link('reminders/remind', 'Vous avez oubli&eacute; votre mot de passe?') }} </span>
{{ Form::close() }}

	<div class="well" style="margin-top:20px;">
		Si vous n'avez pas de compte avec nous... blah blah blah
	</div>
	

	
	  </div>
	</div>
</div>
