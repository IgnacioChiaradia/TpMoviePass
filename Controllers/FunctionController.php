<?php
    namespace Controllers;
    echo 'holaa';
    //die();

    use DAO\FunctionDAO as FunctionDAO;
    //use Models\Function as Function;
    use DAO\MovieTheaterDAO as MovieTheaterDAO;
    use Models\MovieTheater as MovieTheater;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;

    class FunctionController
    {
        private $functionDAO;
        private $movieTheaterDAO;
        private $cinemaDAO;

        public function __construct()
        {
            //$this->functionDAO = new FunctionDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieTheaterDAO = new movieTheaterDAO();
        }

        public function AddFunctionView($movieTheaterName, $idCinema)
        {
            echo 'holaa2222';
            //die();
            $movieTheaterSearch = $this->movieTheaterDAO->GetMovieTheaterByName($movieTheaterName);

            /*echo '<pre>';
            var_dump($movieTheaterSearch);
            echo '<pre>';
            die();*/

            if($movieTheaterSearch)
            {
                require_once(VIEWS_PATH."function-add.php");
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
    }
?>