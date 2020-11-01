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

        public function MoviesView($movieList,$message = '')
        {
            require_once(VIEWS_PATH."movieList.php");
        }

        public function RenewJsonMovies(){
            $this->movieDAOJson->GetMoviesApi();

            $this->listMovies($message = 'La lista de peliculas se ha actualizado correctamente');
        }

        public function ListMovies($message = '')
        {
            $movieList = $this->movieDAOJson->getAll();


            $this->MoviesView($movieList,$message); 
        }

        
    }
?>