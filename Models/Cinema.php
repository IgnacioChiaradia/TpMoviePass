<?php

namespace Models;

class Cinema{

    private $idCinema;
    private $name;
    private $adress;
    private $ticket_value; //valor unico de entrada
    private $total_capacity;

    public function getIdCinema(){
		return $this->idCinema;
	}

	public function setIdCinema($idCinema){
		$this->idCinema = $idCinema;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getAdress(){
		return $this->adress;
	}

	public function setAdress($adress){
		$this->adress = $adress;
	}

	public function getTicketValue(){
		return $this->ticket_value;
	}

	public function setTicketValue($ticket_value){
		$this->ticket_value = $ticket_value;
	}

	public function getTotalCapacity(){
		return $this->total_capacity;
	}

	public function setTotalCapacity($total_capacity){
		$this->total_capacity = $total_capacity;
	}
}

?>