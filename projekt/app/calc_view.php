<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
</head>
<body>
<h1>Witaj w kalkulatorze kredytowym. Wpisz informacje w odpowiednie rubryki by obliczyć swoją rate.</h1>
<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_amount">Kwota: </label>
	<input id="id_amount" type="text" name="amount" value="<?php if(isset($amount))print($amount); ?>" /><br />
	<label for="id_time">Na ile lat: </label>
	<input id="id_time" type="text" name="time" value="<?php if(isset($time))print($time); ?>" /><br />
	<label for="id_percentage">Oprocentowanie(w %): </label>
	<input id="id_percentage" type="text" name="percentage" value="<?php if(isset($percentage))print($percentage); ?>" /><br />
	<input type="submit" value="Oblicz rate" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($info)) {
	if (count ( $info ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $info as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Rata miesieczna: '.$result; ?>
</div>
<?php } ?>

</body>
</html>
