<?php
    namespace Controllers;

    use DAO\CinemaDAOJson as CinemaDAOJson;
    use Models\Cinema as Cinema;

    class CinemaController
    {
        private $cinemaDAOJson;
        //private $listCinema; no me parece correcto utilizar un atributo extra para solo un metodo, asi que paso la vaariable por parametro a la funcion que necesito 

        public function __construct()
        {
            $this->cinemaDAOJson = new CinemaDAOJson();
        }

        public function listCineView($message = "")
        {
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function addCineView($message = "")
        {
            require_once(VIEWS_PATH."cinema-add.php");
        }   

        public function ShowListCinemaView($listCinema, $message = '')
        {
            //$listCinema = $cinemaList; // no hace falta asignar la variable a otra variable en este ambito ya que lo trae del otro metodo
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

            $this->addCineView($message);                        
        }
        
        public function listCinema($message = '')
        {
            $listCinema = $this->cinemaDAOJson->getAll();
            
            $this->ShowListCinemaView($listCinema,$message); 
            //echo 'termina la ejecucion del metodo';
        }
        
        public function removeCinema($id)
        {
            $this->cinemaDAOJson->remove($id);

            $this->listCinema();
        }

        /*public function ShowUpdateCinemaView($nameCinema)
        {
            $cinemaSearch = $this->getCinemaByName($nameCinema);

            if($cinemaSearch){
                require_once(VIEWS_PATH."update-cinema.php");                
            }else{
                $message = 'El cine que busca no se encuentra registrado, intente de nuevo';
                $this->listCinema($message);   
            }
        }*/

        public function ShowUpdateCinemaView()
        {
            $idCinema = $_GET['id'];
            $cinemaSearch = $this->getCinemaById($idCinema);

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

            $cinema->setIdCinema((int)$id);
            $cinema->setName($name);
            $cinema->setAdress($adress);

            if($this->cinemaExistsUpdate($cinema)){
                $message = "Los datos del cine a agregar ya existen en otro cine !";
            }else{
                $message = "El cine se ha editado correctamente !!!";
                $this->cinemaDAOJson->update($cinema);
            }
            
            $this->listCinema($message);            
        }

        /*public function getCinemaByName($nameCinema){

            $cinemaList = $this->cinemaDAOJson->getAll();
            $cinemaSearch = 0;

            foreach($cinemaList as $cinema){
                if($cinema->getName() == $nameCinema){
                    $cinemaSearch = $cinema;
                }
            }

            return $cinemaSearch; 
        }*/

        public function getCinemaById($idCinema){

            $cinemaList = $this->cinemaDAOJson->getAll();
            $cinemaSearch = 0;

            foreach($cinemaList as $cinema){
                if($cinema->getIdCinema() == $idCinema){
                    $cinemaSearch = $cinema;
                }
            }

            return $cinemaSearch; 
        }

        public function cinemaExists($cinemaToSearch)
        {
            $cinemaList = $this->cinemaDAOJson->getAll();
            //$flag = 0;    
            foreach($cinemaList as $cinema){
                if($cinema->getName() == $cinemaToSearch->getName() || $cinema->getAdress() == $cinemaToSearch->getAdress()){
                    return 1;
                    //$flag = 1;
                    //break;
                }
            }
            return 0;            
        }

        public function cinemaExistsUpdate($cinemaToSearch)
        {
            $cinemaList = $this->cinemaDAOJson->getAll();
            //$flag = 0;    
            foreach($cinemaList as $cinema){
                if(($cinema->getName() == $cinemaToSearch->getName() || $cinema->getAdress() == $cinemaToSearch->getAdress()) && $cinema->getIdCinema() != $cinemaToSearch->getIdCinema()){
                    return 1;
                    //$flag = 1;
                    //break;
                }
            }
            return 0;            
        }
    }
?>