<?php
    namespace Controllers;

    use DAO\CinemaDAOJson as CinemaDAOJson;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaController
    {
        private $cinemaDAO;
        //private $listCinema; no me parece correcto utilizar un atributo extra para solo un metodo, asi que paso la vaariable por parametro a la funcion que necesito

        public function __construct()
        {
            //$this->cinemaDAO = new CinemaDAOJson();
            $this->cinemaDAO = new CinemaDAO();
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

        public function AddCinema($name, $address, $total_capacity)
        {
            $cinema = new Cinema();
            $message = '';

            $cinema->setName($name);
            $cinema->setaddress($address);
            $cinema->setTotalCapacity($total_capacity);

            if($this->CinemaExists($cinema)){ // se verifica si el nombre y la direccion ya existen
                $message = "El cine que se quiere agregar ya existe";
            }else{
                $message = "El cine se ha agregado correctamente !!!";
                $this->cinemaDAO->Add($cinema);
            }

            $this->AddCineView($message);
        }

        public function ListCinema($message = '')
        {

            $listCinema = $this->cinemaDAO->GetAll();

            //if(!is_array($listCinema))
             //$listCinema = array($listCinema); // hago esto para que cuando devuelva un solo valor de la base lo convierta en array para no tener problemas en el cinema-list al mostrar la informacion con un foreach

            if(!$listCinema)
            {
                $message = 'No se encuentran cines registrados';
            }

            $this->ShowListCinemaView($listCinema,$message);
            //echo 'termina la ejecucion del metodo';
        }

        public function RemoveCinema($id)
        {
            $this->cinemaDAO->Remove($id);

            $this->ListCinema();
            require_once(VIEWS_PATH."cinema-list.php");
        }

         public function EnableCinema($id)
        {
            $this->cinemaDAO->Enable($id);

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


        public function UpdateCinema($id, $name, $address, $total_capacity)
        {
            $cinema = new Cinema();

            $cinema->setIdCinema((int)$id);
            $cinema->setState(true);
            $cinema->setName($name);
            $cinema->setaddress($address);
            $cinema->setTotalCapacity($total_capacity);

            if($this->CinemaExistsUpdate($cinema)){
                $message = "Los datos del cine a agregar ya existen en otro cine !";
            }else{
                $message = "El cine se ha editado correctamente !!!";
                $this->cinemaDAO->Update($cinema);
            }

            $this->ListCinema($message);
        }

        public function GetCinemaById($idCinema)
        {

            $cinemaList = $this->cinemaDAO->GetAll();
            //var_dump($cinemaList);
            //if(!is_array($cinemaList))
             //$cinemaList = array($cinemaList);
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
            $cinemaList = $this->cinemaDAO->GetAll();
            //$flag = 0;
            foreach($cinemaList as $cinema){
                if($cinema->getName() == $cinemaToSearch->getName() || $cinema->getaddress() == $cinemaToSearch->getaddress()){
                    return 1;
                    //$flag = 1;
                    //break;
                }
            }
            return 0;
        }

        public function CinemaExistsUpdate($cinemaToSearch)
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            //$flag = 0;
            foreach($cinemaList as $cinema){
                if(($cinema->getName() == $cinemaToSearch->getName() || $cinema->getaddress() == $cinemaToSearch->getaddress()) && $cinema->getIdCinema() != $cinemaToSearch->getIdCinema()){
                    return 1;
                    //$flag = 1;
                    //break;
                }
            }
            return 0;
        }
    }
?>
