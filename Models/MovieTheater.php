<?php 

namespace Models;

class MovieTheater{

	private $id_movie_theater;
	private $name;
	private $current_capacity;
	private $quantity_tickets;
	private $price;
	private $total_capacity;

	public function getIDMovieTheater()
	{
		return $this->id_movie_theater;
	}

	public function setIDMovieTheater($id_movie_theater)
	{
		$this->id_movie_theater = $id_movie_theater;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getCurrentCapacity()
	{
		return $this->current_capacity;
	}

	public function setCurrentCapacity($current_capacity)
	{
		$this->current_capacity = $current_capacity;
	}

	public function getQuantityTickets()
	{
		return $this->quantity_tickets;
	}

	public function setQuantityTickets($quantity_tickets)
	{
		$this->quantity_tickets = $quantity_tickets;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function getTotalCapacity()
	{
		return $this->total_capacity;
	}

	public function setTotalCapacity($total_capacity)
	{
		$this->total_capacity = $total_capacity;
    }
}

?>