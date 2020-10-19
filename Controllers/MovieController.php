<?php
    namespace Controllers;

    use DAO\MovieDAOJson as MovieDAOJson;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAOJson;

        public function __construct()
        {
            $this->movieDAOJson = new movieDAOJson();
        }

        public function moviesView($movieList,$message = '')
        {
            require_once(VIEWS_PATH."movieList.php");
        }

        public function listMovies($message = '')
        {
            $this->movieDAOJson->getMoviesApi();
            $movieList = $this->movieDAOJson->getAll();

            $this->moviesView($movieList,$message); 
        }

        
    }
?>