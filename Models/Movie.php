<?php 

namespace Models;

class Movie{

	private $id_movie;
	private $title;
	private $poster_path;
	private $overview;
	private $release_date; // fecha de estreno
	private $genre_ids;
	private $original_language;
	private $vote_counts;
	private $runtime; // tiempo de duracion

	public function getId_movie(){
		return $this->id_movie;
	}

	public function setId_movie($id_movie){
		$this->id_movie = $id_movie;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getPoster_path(){
		return $this->poster_path;
	}

	public function setPoster_path($poster_path){
		$this->poster_path = $poster_path;
	}

	public function getOverview(){
		return $this->overview;
	}

	public function setOverview($overview){
		$this->overview = $overview;
	}

	public function getRelease_date(){
		return $this->release_date;
	}

	public function setRelease_date($release_date){
		$this->release_date = $release_date;
	}

	public function getGenre_ids(){
		return $this->genre_ids;
	}

	public function setGenre_ids($genre_ids){
		$this->genre_ids = $genre_ids;
	}

	public function getOriginal_language(){
		return $this->original_language;
	}

	public function setOriginal_language($original_language){
		$this->original_language = $original_language;
	}

	public function getVote_counts(){
		return $this->vote_counts;
	}

	public function setVote_counts($vote_counts){
		$this->vote_counts = $vote_counts;
	}

	public function getRuntime(){
		return $this->runtime;
	}

	public function setRuntime($runtime){
		$this->runtime = $runtime;
	}
}





 ?>