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

        public function IntroView()
        {
            require_once(VIEWS_PATH."introMoviePass.php");
        }

        public function ListCineView($message = "")
        {
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function AddCineView($message = "")
        {
            require_once(VIEWS_PATH."cinema-add.php");
        }   

        public function ShowListCinemaView($listCinema, $message = '')
        {
            //$listCinema = $cinemaList; // no hace falta asignar la variable a otra variable en este ambito ya que lo trae del otro metodo
            require_once(VIEWS_PATH."cinema-list.php");

        }
        
        public function AddCinema($name, $adress, $total_capacity)
        {
            $cinema = new Cinema();
            $message = '';
            
            $cinema->setName($name);
            $cinema->setAdress($adress);
            $cinema->setTotalCapacity($total_capacity);

            if($this->CinemaExists($cinema)){ // se verifica si el nombre y la direccion ya existen
                $message = "El cine que se quiere agregar ya existe";
            }else{
                $message = "El cine se ha agregado correctamente !!!";
                $this->cinemaDAOJson->Add($cinema);
            }            

            $this->AddCineView($message);                        
        }
        
        public function ListCinema($message = '')
        {

            $listCinema = $this->cinemaDAOJson->GetAll();
            $listCinemas = array([],[]);

            if(!$listCinema) 
            {
                $message = 'No se encuentran cines registrados';
            }
            else
            {
                foreach ($listCinema as $cinema) {

                    if($cinema->getState())
                    {
                        array_push($listCinemas[0], $cinema); //aqui se guardan los cines activos
                    }
                    else
                    {
                        array_push($listCinemas[1], $cinema); //aqui los inactivos
                    }                    
                }
            }
            
            $this->ShowListCinemaView($listCinemas,$message); 
            //echo 'termina la ejecucion del metodo';
        }

        public function RemoveCinema($id)
        {
            $this->cinemaDAOJson->Remove($id);

            $this->ListCinema();
            require_once(VIEWS_PATH."cinema-list.php");
        }

         public function EnableCinema($id)
        {
            $this->cinemaDAOJson->Enable($id);

            $this->ListCinema();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function ShowUpdateCinemaView()
        {
            $idCinema = $_GET['id'];
            $cinemaSearch = $this->GetCinemaById($idCinema);

            if($cinemaSearch){
                require_once(VIEWS_PATH."update-cinema.php");                
            }else{
                $message = 'El cine que busca no se encuentra registrado, intente de nuevo';
                $this->ListCinema($message);   
            }
        }


        public function UpdateCinema($id, $name, $adress, $total_capacity)
        {
            $cinema = new Cinema();

            $cinema->setIdCinema((int)$id);
            $cinema->setState(true);
            $cinema->setName($name);
            $cinema->setAdress($adress);
            $cinema->setTotalCapacity($total_capacity);

            if($this->CinemaExistsUpdate($cinema)){
                $message = "Los datos del cine a agregar ya existen en otro cine !";
            }else{
                $message = "El cine se ha editado correctamente !!!";
                $this->cinemaDAOJson->Update($cinema);
            }
            
            $this->ListCinema($message);            
        }

        /*public function GetCinemaByName($nameCinema){

            $cinemaList = $this->cinemaDAOJson->GetAll();
            $cinemaSearch = 0;

            foreach($cinemaList as $cinema){
                if($cinema->getName() == $nameCinema){
                    $cinemaSearch = $cinema;
                }
            }

            return $cinemaSearch; 
        }*/

        public function GetCinemaById($idCinema){

            $cinemaList = $this->cinemaDAOJson->GetAll();
            $cinemaSearch = 0;

            foreach($cinemaList as $cinema){
                if($cinema->GetIdCinema() == $idCinema){
                    $cinemaSearch = $cinema;
                }
            }

            return $cinemaSearch; 
        }

        public function CinemaExists($cinemaToSearch)
        {
            $cinemaList = $this->cinemaDAOJson->GetAll();
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

        public function CinemaExistsUpdate($cinemaToSearch)
        {
            $cinemaList = $this->cinemaDAOJson->GetAll();
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