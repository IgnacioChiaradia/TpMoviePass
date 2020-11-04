<?php 

namespace Models;

use Models\MovieTheater as MovieTheater;

class Show
{
	private $id_show;
	private $day;
	private $time;
	private $movie_theater;

	public function getIdShow(){
		return $this->id_show;
	}

	public function setIdShow($id_show){
		$this->id_show = $id_show;
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