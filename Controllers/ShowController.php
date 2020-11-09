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
                
                //aqui seteo la funcion por completo
                $showsOfMovieTheater = $this->SetCompleteShows($showsOfMovieTheater);

                if($showsOfMovieTheater)
                {

                }

                /*echo '<pre>';
                var_dump($showsOfMovieTheater);
                echo '<pre>';
                die();*/
                
                //$movieList = $this->movieDAO->GetAll();
                $movieList = $this->movieDAO->GetAllActive();
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

            $movieList = $this->movieDAO->GetAllActive();
            require_once(VIEWS_PATH."show-view.php");
        }

        public function GetAllActiveShows()
        {
            $showsActive = $this->showDAO->GetAllActive();

            require_once(VIEWS_PATH."intro-moviepass.php");
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

                    //$this->CanAddAShow($newShow);

                    $this->showDAO->Add($newShow);

                    $message = 'Se ha creado una nueva sala';
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
            $this->GetAllShowsByIdMovieTheater($idMovieTheater, $message);
        }

        public function GetAllShowsByIdMovieTheater($idMovieTheater, $message = "")
        {
            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterById($idMovieTheater);
            $showsOfMovieTheater = array();

            if($movieTheaterSearch)
            {
                $showsOfMovieTheater = $this->showDAO->GetAllShowsByMovieTheater($movieTheaterSearch);
                $showsOfMovieTheater = $this->SetCompleteShows($showsOfMovieTheater);
            }
            else
            {
                $message = "hubo un error al buscar las funciones";
            }

            $this->DisplayShowViewAfterAction($idMovieTheater, $showsOfMovieTheater, $message);
        }

        public function SetCompleteShows($showsOfMovieTheater)
        {
             if(!is_array($showsOfMovieTheater))
                    $showsOfMovieTheater = array($showsOfMovieTheater);

            foreach ($showsOfMovieTheater as $show)
                {                    
                    /*mediante el id de la movie que cargue en el mapear busco la movie y la seteo en el 
                    show(funcion)*/
                    $show->setMovie($this->movieDAO->GetMovieById($show->getMovie()->getIdMovie()));

                    /*mediante el id de la movieTheater que cargue en el mapear busco la movieTheater y la seteo en el show(funcion)*/
                    $show->setMovieTheater($this->movieTheaterDAO->GetMovieTheaterById($show->GetMovieTheater()->getIdMovieTheater()));

                    //seteo el cine de la sala
                    $show->getMovieTheater()->setCinema($this->cinemaDAO->GetCinemaById($show->getMovieTheater()->getCinema()->getIdCinema()));
                }

            return $showsOfMovieTheater;
        }

        //verifico que la pelicula de la funcion solo se encuentre en una sala de un cine por dia
        //
        public function CanAddAShow(Show $newShow)
        {
            //$allShows = $this->showDAO->GetAll();
            //$allShows = $this->SetCompleteShows($allShows);

            /*foreach ($allShows as $show) 
            {
                if($show->getMovie()->getIdMovie() == $newShow->getMovie()->getIdMovie() && $show->getDay() == $newShow->getDay())
                {
                    $message = "la pelicula que se quiere utilizar ya se encuentra en otra sala para el dia: " . $show->getDay();
                }
            }*/

            $showSearch = $this->showDAO->findShowByDayAndMovie($newShow);

                echo '<pre>';
            var_dump($showSearch);
            echo '<pre>';
            die();

        }

        public function DisableShow($idShow)
        {
            $showSearch = $this->showDAO->GetShowById($idShow);
            $this->SetCompleteShows($showSearch);

            $this->showDAO->Disable($showSearch);

            $this->GetAllShowsByIdMovieTheater($showSearch->getMovieTheater()->getIdMovieTheater(), $message = "Se ha dado de baja la funcion correctamente");
        }

        // agregar verificaciones necesarias
        public function EnableShow($idShow)
        {
            //buscar sala y pasarla
            $showSearch = $this->showDAO->GetShowById($idShow);
            $this->SetCompleteShows($showSearch);

            $this->showDAO->Enable($showSearch);

            $this->GetAllShowsByIdMovieTheater($showSearch->getMovieTheater()->getIdMovieTheater(), $message = "Se ha dado de alta la funcion correctamente, si su funcion sigue dada de baja intente activar la pelicula");
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