<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Logowanie do kalkulatora kredytowego</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT); ?>/app/security/login.php" method="post" class="pure-form pure-form-stacked">
    <center><b><legend><span style="font-size: large">Logowanie do kalkulatora kredytowego</span></legend></b>
	<fieldset>
		<label for="id_login">login: </label>
		<input id="id_login" type="text" name="login" value="<?php out($form['login']); ?>" />
		<label for="id_pass">hasło: </label>
		<input id="id_pass" type="password" name="pass" />
	</fieldset>
	<input type="submit" value="Zaloguj" class="pure-button pure-button-primary"/></center>
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($info)) {
	if (count ( $info ) > 0) {
		echo '<ol style="padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $info as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

</div>

</body>
</html>