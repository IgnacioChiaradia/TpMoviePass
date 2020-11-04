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
            //$this->showDAO = new showDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieTheaterDAO = new movieTheaterDAO();
            $this->movieDAO = new movieDAO();
        }

        public function DisplayShowView($movieTheaterName, $idCinema)
        {

            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterByName($movieTheaterName);

            if($movieTheaterSearch)
            {
                $movieList = $this->movieDAO->GetAll();
                require_once(VIEWS_PATH."show-view.php");
            }
            else
            {
                $cinemaSearch = $this->cinemaDAO->GetCinemaById($idCinema);
                $movieTheaterList = $this->movieTheaterDAO->GetMovieTheatersByIdCinema($idCinema);
                $message = 'El nombre de la sala es incorrecto';

                if(!is_array($movieTheaterList))
                        $movieTheaterList = array($movieTheaterList);

                require_once(VIEWS_PATH."movie-theater.php");
            }
            
        }

        public function AddShow($idMovie, $date, $time, $idMovieTheater)
        {

            $movieSearch = $this->movieDAO()->GetMovieById($idMovie);
            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterById($idMovieTheater);

            if($movieSearch)
            {
                if($movieTheaterSearch)
                {
                    $newShow = new Show();
                    $newShow->setMovie($movieSearch);
                    $newShow->setDate($date);
                    $newShow->setTime($time);
                    $newShow->setMovieTheater($movieTheaterSearch);
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