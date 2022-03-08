<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$amount = $_REQUEST ['amount'];
$time = $_REQUEST ['time'];
$percentage = $_REQUEST ['percentage'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($amount) && isset($time) && isset($percentage))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$info [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $amount == "") {
	$info [] = 'Nie podano kwoty';
}
if ( $time == "") {
	$info [] = 'Nie podano czasu';
}
if ( $percentage == "") {
	$info [] = 'Nie podano oprocentowania';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $info )) {
	
	// sprawdzenie, czy $amount, $time i $percentage są liczbami całkowitymi
	if (! is_numeric( $amount )) {
		$info [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $time )) {
		$info [] = 'Druga wartość nie jest liczbą całkowitą';
	}
	if (! is_numeric( $percentage )) {
		$info [] = 'Trzecia wartość nie jest liczbą całkowitą';
	}	

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $info )) { // gdy brak błędów
	
	//konwersja parametrów na int oraz oprocentowania na double
	$amount = intval($amount);
	$time = intval($time);
	$percentage = doubleval($percentage);
	
	
	$q = 1+(($interest/100)/12);
	$years = $time * 12;
	//wykonanie operacji;
	$rata = $sum*pow($q, $years)*($q-1)/((pow($q, $years))-1);
	$result = round($rata, 2);
	
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($info,$amount,$time,$percentage,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';
