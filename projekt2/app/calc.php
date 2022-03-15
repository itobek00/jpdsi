<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora kredytowego

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$amount,&$time,&$percentage){
	$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
	$time = isset($_REQUEST['time']) ? $_REQUEST['time'] : null;
	$percentage = isset($_REQUEST['percentage']) ? $_REQUEST['percentage'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$amount,&$time,&$percentage,&$info){
    global $role;
    // sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($amount) && isset($time) && isset($percentage))) {
		// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		// teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $amount == "") {
		$info [] = 'Nie podano kwoty';
	}
	if ( $time == "") {
		$info [] = 'Nie podano czasu spłaty';
	}
    if ( $percentage == "") {
        $info [] = 'Nie podano oprocentowania';
    }

	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $info ) != 0) return false;
	
	// sprawdzenie, czy $amount i $time są liczbami całkowitymi
	if (! is_numeric( $amount )) {
		$info [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $time )) {
		$info [] = 'Druga wartość nie jest liczbą całkowitą';
	}

    if (! is_numeric( $percentage )) {
        $info [] = 'Trzecia wartość nie jest liczbą całkowitą';
    }
    if ($amount > 10000 && $role == 'user') {
        $info [] = 'Tylko admin może liczyć ratę na kwotę wyższą niż 10 tysięcy złotych';
    }


    if (count ( $info ) != 0) return false;
	else return true;
}

function process(&$amount,&$time,&$percentage,&$info,&$result){


    //konwersja parametrów na int oraz oprocentowania na float
    $amount = intval($amount);
    $time = intval($time);
    $percentage = floatval($percentage);


    $q = 1+(($percentage/100)/12);
    $years = $time * 12;
    //wykonanie operacji;
    $rata = $amount*pow($q, $years)*($q-1)/((pow($q, $years))-1);
    $result = round($rata, 2);

}

//definicja zmiennych kontrolera
$amount = null;
$time = null;
$percentage = null;
$result = null;
$info = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($amount,$time,$percentage);
if ( validate($amount,$time,$percentage,$info) ) { // gdy brak błędów
	process($amount,$time,$percentage,$info,$result);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($info,$amount,$time,$percentage,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';