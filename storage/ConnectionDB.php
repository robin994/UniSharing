<?php

interface IConnectionDB{

	// metodo che connette al db
	public function connetti();

	//metodo che disconnette dal db
	public function disconnetti();

	// metodo che implementa query multiple
	public function myMultiQuery($query);

	//metodo che implementa una query singola
	public function myQuery($query);

	// metodo che resituisce un valore boolean true se c'è stato un errore, false altrimenti
	public function errno();

	// metodo che restituisce l'errore nel dettaglio
	public function error();

	// metodo che restituisce il valore AUTO_INCREMENT nelle insert
	public function insert_id();

	// metodo che itera le righe provenienti dal db
	public function myFetch($result);

}


class ConnectionDB implements IConnectionDB{

	// dati di accesso al db su MAMP
	private $db_host = "localhost";
	private $db_user = "root";
	private $db_password = "root";
	private $db_database = "unisharing";

	private $attiva = false;
	public $connessione;
	public $selezione;


	public function connetti(){
		if(!$this->attiva){
			$this->connessione = mysqli_connect($this->db_host,$this->db_user,$this->db_password, $this->db_database) or die("Errore1: ".mysqli_connect_error());
			mysqli_set_charset($this->connessione,'utf8');
			if(!mysqli_connect_errno())
			{
				$this->attiva = true;

			}
		}

		return $this->connessione;
	}
	public function myMultiQuery($query){
		$result = mysqli_multi_query($this->connessione,$query);
		return $result;
	}

	public function myQuery($query){
		$result = mysqli_query($this->connessione,$query);
		return $result;
	}

	public function errno(){
		return mysqli_errno($this->connessione);
	}

	public function error(){
		return mysqli_error($this->connessione);
	}

	public function insert_id(){
		return mysqli_insert_id($this->connessione);
	}

	public function disconnetti(){

		if(!$this->attiva) return;

		mysqli_close($this->connessione);
		$this->attiva = false;
	}

	public function myFetch($result){
		return mysqli_fetch_array($result);
	}

}
