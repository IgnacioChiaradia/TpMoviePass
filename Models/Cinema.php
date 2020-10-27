<?php

namespace Models;

class Cinema{

    private $idCinema;
    private $state;
    private $name;
    private $address;
    private $total_capacity;
    private $movie_theater_list = array ();

    public function getIdCinema(){
		return $this->idCinema;
	}

	public function setIdCinema($idCinema){
		$this->idCinema = $idCinema;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}


	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getaddress(){
		return $this->address;
	}

	public function setaddress($address){
		$this->address = $address;
	}

	public function getTotalCapacity(){
		return $this->total_capacity;
	}

	public function setTotalCapacity($total_capacity){
		$this->total_capacity = $total_capacity;
	}

	public function getMovieTheaterList(){
		return $this->movie_theater_list;
	}

	public function setMovieTheaterList($movie_theater_list){
		$this->movie_theater_list = $movie_theater_list;
	}
}

?>