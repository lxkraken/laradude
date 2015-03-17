<!DOCTYPE html>
<html lang="fr-CA">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>R&eacute;initialisation de votre mot de passe</h2>

		<div>
			Pour r&eacute;initialiser votre mot de passe, S.V.P remplir ce formulaire: <a href="{{ URL::to('password/reset', array($token)) }}">{{ URL::to('password/reset', array($token)) }}</a>.<br/>
			Ce lien va expirer en {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
