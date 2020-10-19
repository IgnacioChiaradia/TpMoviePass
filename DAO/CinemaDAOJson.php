<?php
    namespace DAO;

    use DAO\IDAOJson as IDAOJson;
    use DAO\ICinemaDAOJson as ICinemaDAOJson;
    use Models\Cinema as Cinema;

    class CinemaDAOJson implements IDAOJson, ICinemaDAOJson 
    {
        private $cinemaList = array();

        public function add(Cinema $cinema)
        {
            $this->RetrieveData();

            $cinema->setIdCinema($this->GetNextId()); 
            
            array_push($this->cinemaList, $cinema);

            $this->SaveData();
        }

        public function getAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        }

        public function remove($id)
        {
            $this->RetrieveData();

            foreach($this->cinemaList as $key => $cinema){
                if($cinema->getIdCinema() == $id){
                    unset($this->cinemaList[$key]);
                }
            }

            $this->SaveData();                        
        }

        public function update(Cinema $newCinema)
        {
            $this->RetrieveData();

            foreach($this->cinemaList as $key => $cinema){
                if($cinema->getIdCinema() == $newCinema->getIdCinema()){
                    $this->cinemaList[$key] = $newCinema;
                }
            }

            $this->SaveData();                        
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray["idCinema"] = $cinema->getIdCinema();
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["adress"] = $cinema->getAdress();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cinemas.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cinemaList = array();

            if(file_exists('Data/cinemas.json'))
            {
                $jsonContent = file_get_contents('Data/cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema();
                    $cinema->setIdCinema($valuesArray["idCinema"]);
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setAdress($valuesArray["adress"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->cinemaList as $cinema)
            {
                $id = ($cinema->getIdCinema() > $id) ? $cinema->getIdCinema() : $id;
            }

            return $id + 1;
        }
    }
?>