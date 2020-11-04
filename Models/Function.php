<?php 

namespace Models;

use Models\MovieTheater as MovieTheater;

class Function
{
	private $id_function;
	private $day;
	private $time;
	private $movie_theater;

	public function getId_function(){
		return $this->id_function;
	}

	public function setId_function($id_function){
		$this->id_function = $id_function;
	}

	public function getDay(){
		return $this->day;
	}

	public function setDay($day){
		$this->day = $day;
	}

	public function getTime(){
		return $this->time;
	}

	public function setTime($time){
		$this->time = $time;
	}

	public function getMovie_theater(){
		return $this->movie_theater;
	}

	public function setMovie_theater(MovieTheater $movie_theater){
		$this->movie_theater = $movie_theater;
	}
}


 ?>