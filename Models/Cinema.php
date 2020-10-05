<?php

namespace Models;

class Cinema{

    private $idCinema;
    private $name;
    private $adress;

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
}

?>