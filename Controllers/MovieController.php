<?php
    namespace Controllers;

    use DAO\MovieDAOJson as MovieDAOJson;
    use DAO\GenreDAO as GenreDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieDAOJson;
        private $genreDAO;

        public function __construct()
        {
            $this->movieDAOJson = new movieDAOJson();
            $this->genreDAO = new GenreDAO();
        }

        public function MoviesView($movieList, $genreList, $message = '')
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

            $genreList = $this->genreDAO->getGenresApi();

            $this->MoviesView($movieList, $genreList, $message);
        }

    }
?>
