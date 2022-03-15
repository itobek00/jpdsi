<?php
//Tu już nie ładujemy konfiguracji - sam widok nie będzie już punktem wejścia do aplikacji.
//Wszystkie żądania idą do kontrolera, a kontroler wywołuje skrypt widoku.
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Kalkulator kredytowy</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
<h1><center>Witaj w kalkulatorze kredytowym.</center></h1>
<h1><center>Wpisz informacje w odpowiednie rubryki by obliczyć swoją rate.</center></h1>
<center><div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">Nastepna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div></center>

<div style="width:20%; margin: 1em auto;">

<form action="<?php print(_APP_ROOT); ?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
	<center><legend>Kalkulator kredytowy</legend>
	<fieldset>
		<label for="id_amount">Kwota: </label>
		<input id="id_amount" type="text" name="amount" value="<?php out($amount) ?>" />
		<label for="id_time">Na ile lat: </label>
		<input id="id_time" type="text" name="time" value="<?php out($time); ?>" />
		<label for="id_percentage">Oprocentowanie(w %): </label>
		<input id="id_percentage" type="text" name="percentage" value="<?php out($percentage) ?>" />
	</fieldset>	
        <input type="submit" value="Oblicz rate" class="pure-button pure-button-primary" /></center>
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($info)) {
	if (count ( $info ) > 0) {
		echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
		foreach ( $info as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
<?php echo 'Rata miesieczna: '.$result; ?>
</div>
<?php } ?>

</div>

</body>
</html>