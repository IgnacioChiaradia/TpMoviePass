<?php
    namespace Controllers;

    use DAO\CinemaDAOJson as CinemaDAOJson;
    use Models\Cinema as Cinema;
    use Controllers\HomeController as HomeController;

    class CinemaController
    {
        private $cinemaDAOJson;

        public function __construct()
        {
            $this->cinemaDAOJson = new CinemaDAOJson();
        }

        public function ShowListCinemaView()
        {
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowUpdateCinemaView($nameCinema)
        {
            $cinemaSearch = $this->cinemaDAOJson->getCinemaByName($nameCinema);

            if($cinemaSearch){
                require_once(VIEWS_PATH."update-cinema.php");                
            }else{
                $this->listCinema();   
            }
        }

        public function updateCinema($name, $adress)
        {
            $cinema = new Cinema();
            
            $cinema->setName($name);
            $cinema->setAdress($adress);

            $this->cinemaDAOJson->update($cinema);

            $this->listCinema();            
        }
        
        public function addCinema($name, $adress)
        {
            $cinema = new Cinema();
            
            $cinema->setName($name);
            $cinema->setAdress($adress);

            $this->cinemaDAOJson->add($cinema);

            $homeController = new HomeController();
            $homeController->addCineView();                        
        }

        public function listCinema()
        {
            $listCinema = $this->cinemaDAOJson->getAll();

            //$this->ShowListCinemaView(); //no se porque no funciona asi que le dejo el require abajo
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function removeCinema($id)
        {
            $this->cinemaDAO->remove($id);

            $this->listCinema();
        }
    }
?>