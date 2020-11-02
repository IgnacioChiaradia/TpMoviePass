<?php
    namespace Controllers;

    use DAO\MovieDAOJson as MovieDAOJson;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAOJson;
        private $movieDAO;
        private $genreDAO;

        public function __construct()
        {
            //$this->movieDAOJson = new movieDAOJson();
            $this->movieDAO = new movieDAO();
            $this->genreDAO = new GenreDAO();
        }

        public function MoviesView($movieList, $genreList, $message = '')
        {
            require_once(VIEWS_PATH."movieList.php");
        }

        public function RenewJsonMovies()
        {
            $this->movieDAO->GetMoviesApi();

            $this->ListMovies($message = 'La lista de peliculas se ha actualizado correctamente');
        }

        public function ListMovies($message = '')
        {
            $movieList = $this->movieDAO->getAll();

            $genreList = $this->genreDAO->getAll();

            $this->MoviesView($movieList, $genreList, $message); 
        }
        
    }
?>