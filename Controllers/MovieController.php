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

        public function renewJsonMovies(){
            $this->movieDAOJson->getMoviesApi();

            $this->listMovies($message = 'La lista de peliculas se ha actualizado correctamente');
        }

        public function listMovies($message = '')
        {
            $movieList = $this->movieDAOJson->getAll();

            $this->moviesView($movieList,$message); 
        }

        
    }
?>