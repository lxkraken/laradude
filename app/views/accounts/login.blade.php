<script type="text/javascript">
$( document ).ready(function() {
  $( "#username" ).focus();
});
</script>
<div class="container-fluid">
	<div class="form">
		<div class="form-group center-block" style="max-width:500px;">

{{ Form::open(array('url'=>'account/signin')) }}

    <h2 class="form-signin-heading">{{ Lang::get('account.pleaselogin') }}</h2>
	<div class="form-group">
		{{ Form::label('username', Lang::get('account.username'), array('for'=>'username')) }}	
		{{ Form::text('username', null, array('class'=>'form-control', 'id' => 'username', 'placeholder'=> Lang::get('account.username'))) }}
	</div>
	<div class="form-group">
		{{ Form::label('password', Lang::get('account.password'), array('for'=>'password')) }}
		{{ Form::password('password', array('class'=>'form-control', 'id' => 'inputPassword', 'placeholder'=> Lang::get('account.password'))) }}
	</div>
	<div class="form-group">
		{{ Form::checkbox('remember', '1', 'true') }} {{ Form::label('remember', Lang::get('account.rememberme'), array('for'=>'remember')) }}
	</div>
 
    {{ Form::submit(Lang::get('account.login'), array('class'=>'btn btn-primary'))}} <span style="float:right;">{{ HTML::link('reminders/remind', Lang::get('account.forgotpassword')) }} </span>
{{ Form::close() }}

	<div class="well" style="margin-top:20px;">
		{{ Lang::get('account.noaccount') }}
	</div>
	

	
	  </div>
	</div>
</div>
