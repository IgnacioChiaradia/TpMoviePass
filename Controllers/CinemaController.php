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
        
        public function addCinema($name, $adress)
        {
            $cinema = new Cinema();
            $message = '';
            
            $cinema->setName($name);
            $cinema->setAdress($adress);

            if($this->cinemaExists($cinema)){
                $message = "El cine que se quiere agregar ya existe";
            }else{
                $message = "El cine se ha agregado correctamente !!!";
                $this->cinemaDAOJson->add($cinema);
            }            

            $homeController = new HomeController();
            $homeController->addCineView($message);                        
        }
        
        public function listCinema($message = '')
        {
            $listCinema = $this->cinemaDAOJson->getAll();
            
            //$this->ShowListCinemaView(); //no se porque no funciona asi que le dejo el require abajo
            require_once(VIEWS_PATH."cinema-list.php");
        }
        
        public function removeCinema($id)
        {
            $this->cinemaDAOJson->remove($id);

            $this->listCinema();
        }

        public function ShowUpdateCinemaView($nameCinema)
        {
            $cinemaSearch = $this->getCinemaByName($nameCinema);

            if($cinemaSearch){
                require_once(VIEWS_PATH."update-cinema.php");                
            }else{
                $message = 'El cine que busca no se encuentra registrado, intente de nuevo';
                $this->listCinema($message);   
            }
        }

        public function updateCinema($id, $name, $adress)
        {
            $cinema = new Cinema();
            //verificar que la informacion que me trae el form del update-cinema no sea de otro cine ya cargado

            $cinema->setIdCinema($id);
            $cinema->setName($name);
            $cinema->setAdress($adress);

            $this->cinemaDAOJson->update($id, $cinema);

            $this->listCinema();            
        }

        public function getCinemaByName($nameCinema){

            $cinemaList = $this->cinemaDAOJson->getAll();
            $cinemaSearch = 0;

            foreach($cinemaList as $cinema){
                if($cinema->getName() == $nameCinema){
                    $cinemaSearch = $cinema;
                }
            }

            return $cinemaSearch; 
        }

        /*public function getIdCinemaByName($nameCinema){

            $idCinema = 1;
            $cinemaList = $this->cinemaDAOJson->getAll();

            foreach($cinemaList as $cinema){
                if($cinema->getName() == $nameCinema){
                    $idCinema = $cinema->getIdCinema();
                }
            }

            return $idCinema; 
        }*/

        /*public function getCinemaById()
        {
            $idCinema = $this->getIdCinemaByName($nameCinema);

            $cinemaList = $this->cinemaDAOJson->getAll();
            $cinemaSearch = 0;

            foreach($cinemaList as $cinema){
                if($cinema->getIdCinema() == $idCinema){
                    $cinemaSearch = $cinema;
                }
            }

            return $cinemaSearch;            
        }*/

        public function cinemaExists($cinemaToSearch)
        {
            $cinemaList = $this->cinemaDAOJson->getAll();
            $flag = 0;    
            foreach($cinemaList as $cinema){
                if($cinema->getName() == $cinemaToSearch->getName() || $cinema->getAdress() == $cinemaToSearch->getAdress()){
                    $flag = 1;
                }
            }
            return $flag;            
        }
    }
?>