<div class="container-fluid">
	<div class="form">
		<div class="form-group center-block" style="max-width:500px;">
			
			{{ Form::open(array('url'=>'reminders/remind')) }}
	<h2 class="form-remind-heading">Oubli de mot de passe</h2>
	<div class="form-group">
		{{ Form::label('email', 'Adresse courriel', array('for'=>'email')) }}	
		{{ Form::email('email', null, array('class'=>'form-control', 'id' => 'email', 'placeholder'=>'Adresse courriel')) }}
	</div>
    {{ Form::submit('Envoyer', array('class'=>'btn btn-primary'))}}
{{ Form::close() }}
	  </div>
	</div>
</div>
