<?php
    namespace DAO;

    use DAO\IDAOJson as IDAOJson;
    use Models\Movie as Movie;

    class MovieDAOJson implements IDAOJson
    {
        private $movieList = array();

        public function getMoviesApi()
        {
        	$this->movieList = file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=' . TMDB_KEY . '&language=en-US&page=1');

			$movieListArray = ($this->movieList) ? json_decode($this->movieList, true) : array();

			/*echo '<pre>';
			var_dump($movieListArray);
			echo '<pre>';

			/*die();*/

			return $movieListArray;
        }

        public function add($object){

        }

        public function remove($id){

        }

        public function getAll()
        {
            $this->RetrieveData();

            return $this->movieList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->movieList as $movie)
            {
                $valuesArray["idmovie"] = $movie->getIdmovie();
                $valuesArray["name"] = $movie->getName();
                $valuesArray["adress"] = $movie->getAdress();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/movies.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->movieList = array();

            if(file_exists('Data/movies.json'))
            {
                $jsonContent = file_get_contents('Data/movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new Cinema();
                    $movie->setIdCinema($valuesArray["idCinema"]);
                    $movie->setName($valuesArray["name"]);
                    $movie->setAdress($valuesArray["adress"]);

                    array_push($this->movieList, $movie);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->movieList as $movie)
            {
                $id = ($movie->getIdCinema() > $id) ? $movie->getIdMovie() : $id;
            }

            return $id + 1;
        }
    }
?>