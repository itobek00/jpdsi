<?php
// W skrypcie definicji kontrolera nie trzeba dołączać już niczego.
// Kontroler wskazuje tylko za pomocą 'use' te klasy z których jawnie korzysta
// (gdy korzysta niejawnie to nie musi - np używa obiektu zwracanego przez funkcję)

// Zarejestrowany autoloader klas załaduje odpowiedni plik automatycznie w momencie, gdy skrypt będzie go chciał użyć.
// Jeśli nie wskaże się klasy za pomocą 'use', to PHP będzie zakładać, iż klasa znajduje się w bieżącej
// przestrzeni nazw - tutaj jest to przestrzeń 'app\controllers'.

// Przypominam, że tu również są dostępne globalne funkcje pomocnicze - o to nam właściwie chodziło

namespace app\controllers;

//zamieniamy zatem 'require' na 'use' wskazując jedynie przestrzeń nazw, w której znajduje się klasa
use app\forms\CalcForm;
use app\transfer\CalcResult;

/** Kontroler kalkulatora

 */
class CalcCtrl {

	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku

	/** 
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}
	
	/** 
	 * Pobranie parametrów
	 */
	public function getParams(){
        $this->form->amount = getFromRequest('amount');
        $this->form->percentage = getFromRequest('percentage');
        $this->form->time = getFromRequest('time');
	}
	
	/** 
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku 
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
        if (! (isset ( $this->form->amount ) && isset ( $this->form->percentage ) && isset ( $this->form->time ))) {
            // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
            return false; //zakończ walidację z błędem
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
        if ($this->form->amount == "") {
            getMessages()->addError('Nie podano kwoty');
        }
        if ($this->form->percentage == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }
        if ($this->form->time == "") {
            getMessages()->addError('Nie podano raty');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
        if (! getMessages()->isError()) {

            // sprawdzenie, czy $x i $y są liczbami całkowitymi
            if (! is_numeric ( $this->form->amount )) {
                getMessages()->addError('Kwota nie jest liczbą całkowitą');
            }

            if (! is_numeric ( $this->form->time )) {
                getMessages()->addError('Raty nie są liczbą całkowitą');
            }
        }

        return ! getMessages()->isError();
	}
	
	/** 
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function action_calcCompute(){

		$this->getParams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
            $this->form->amount = intval($this->form->amount);
            $this->form->percentage = intval($this->form->percentage);
            $this->form->time = intval($this->form->time);
            getMessages()->addInfo('Parametry są poprawne.');
				
			//wykonanie operacji
            $q = 1+((($this->form->percentage)/100)/12);
            $years = $this->form->time  * 12;
            $rata = round($this->form->amount *pow($q, $years)*($q-1)/((pow($q, $years))-1),2);
            $this->result->result = $rata;


			
			getMessages()->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	public function action_calcShow(){
		getMessages()->addInfo('Witamy w kalkulatorze');
		$this->generateView();
	}
	
	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){

		getSmarty()->assign('user',unserialize($_SESSION['user']));
				
		getSmarty()->assign('page_title','Kalkulejtor');

		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.tpl');
	}
}
