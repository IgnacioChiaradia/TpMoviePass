<?php
    namespace Controllers;

    use DAO\ShowDAO as ShowDAO;
    use Models\Show as Show;
    use DAO\MovieTheaterDAO as MovieTheaterDAO;
    use Models\MovieTheater as MovieTheater;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;    

    class ShowController
    {
        private $showDAO;
        private $movieTheaterDAO;
        private $cinemaDAO;
        private $movieDAO;

        public function __construct()
        {
            $this->showDAO = new ShowDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieTheaterDAO = new MovieTheaterDAO();
            $this->movieDAO = new MovieDAO();
        }

        public function DisplayShowView($movieTheaterName, $idCinema)
        {

            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterByName($movieTheaterName);

            if($movieTheaterSearch && $movieTheaterSearch->getState())
            {
                $showsOfMovieTheater = $this->showDAO->GetAllShowsByMovieTheater($movieTheaterSearch);
                
                if(!is_array($showsOfMovieTheater))
                    $showsOfMovieTheater = array($showsOfMovieTheater);
                
                $movieList = $this->movieDAO->GetAll();
                require_once(VIEWS_PATH."show-view.php");
            }
            else
            {
                $cinemaSearch = $this->cinemaDAO->GetCinemaById($idCinema);
                $movieTheaterList = $this->movieTheaterDAO->GetMovieTheatersByIdCinema($idCinema);
                $message = 'El nombre de la sala es incorrecto o la sala buscada esta dada de baja';

                if(!is_array($movieTheaterList))
                        $movieTheaterList = array($movieTheaterList);

                require_once(VIEWS_PATH."movie-theater.php");
            }
            
        }

        public function DisplayShowViewAfterAction($idMovieTheater, $showsOfMovieTheater, $message = "")
        {
            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterById($idMovieTheater);

            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."show-view.php");
        }

        public function AddShow($idMovie, $date, $hour, $idMovieTheater)
        {

            $movieSearch = $this->movieDAO->GetMovieById($idMovie);
            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterById($idMovieTheater);

            if($movieSearch)
            {
                if($movieTheaterSearch)
                {
                    $newShow = new Show();
                    $newShow->setState(true);
                    $newShow->setMovie($movieSearch);
                    $newShow->setDay($date);
                    $newShow->setHour($hour);
                    $newShow->setMovieTheater($movieTheaterSearch);

                    $this->showDAO->Add($newShow);

                    $message = 'Se ha creado una nueva sala';

                    $this->GetAllShowsByIdMovieTheater($idMovieTheater, $message);
                }
                else
                {
                    $message = 'La sala seleccionada no ha sido encontrada';
                }
            }
            else
            {
                $message = 'La pelicula selecionada no ha sido encontrada';
            }
        }

        public function GetAllShowsByIdMovieTheater($idMovieTheater, $message = "")
        {
            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterById($idMovieTheater);
            $showsOfMovieTheater = array();

            if($movieTheaterSearch)
            {
                $showsOfMovieTheater = $this->showDAO->GetAllShowsByMovieTheater($movieTheaterSearch);
            }
            else
            {
                $message = "hubo un error al buscar las funciones";
            }

            $this->DisplayShowViewAfterAction($idMovieTheater, $showsOfMovieTheater, $message);
        }

        public function BackToMovieTheaterView($id_cinema)
        {
            $cinemaSearch = $this->cinemaDAO->GetCinemaById($id_cinema);            
            $movieTheaterList = $this->movieTheaterDAO->GetMovieTheatersByIdCinema($id_cinema);

            if(!is_array($movieTheaterList))
                    $movieTheaterList = array($movieTheaterList);

            require_once(VIEWS_PATH."movie-theater.php");
        }
    }
?>