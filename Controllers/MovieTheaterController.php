<?php
    namespace Controllers;

    //use DAO\MovieTheaterDAO as MovieTheaterDAO;
    use Models\MovieTheater as MovieTheater;

    class MovieTheaterController
    {
        //private $movieTheaterDAO;
        
        public function __construct()
        {
            //$this->movieTheaterDAO = new MovieTheaterDAO();
        }

        public function ShowMovieTheaterView()
        {
            $idCinema = $_GET['id'];
            require_once(VIEWS_PATH."movie-theater.php");
        }
    }

?>