<?php
    namespace DAO;

    use DAO\IDAOJson as IDAOJson;
    use Models\Movie as Movie;

    class MovieDAOJson implements IDAOJson
    {
        private $movieList = array();

        public function getMoviesApi()
        {
            $this->RetrieveData();

        	$movieListJson = file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=' . TMDB_KEY . '&language=en-US&page=1');

			$movieListApi = ($movieListJson) ? json_decode($movieListJson, true) : array();

            /*echo '<pre>';
            var_dump($movieListApi["results"]);
            echo '<pre>';
            die();*/

            foreach ($movieListApi["results"] as $movie) {
                array_push($this->movieList, $movie);
            }           

			/*echo '<pre>';
			var_dump($this->movieList);
			echo '<pre>';


			/*die();*/

            $this->SaveData();

            echo '<pre>';
            var_dump($this->movieList);
            echo '<pre>';
            die();

			//return $movieListArray;
        }

        public function add(Movie $movie){

            $this->RetrieveData();

            //$movie->setIdMovie($this->GetNextId()); 
            
            array_push($this->movieList, $movie);

            $this->SaveData();

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
                echo '<pre>';
                var_dump($movie);
                echo '<pre>';
                die();
                //$valuesArray["id"] = $movie->getIdmovie();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["poster_path"] = $movie->getPosterPath();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["release_date"] = $movie->getReleaseDate();
                $valuesArray["genre_ids"] = $movie->getGenreIds();
                $valuesArray["original_language"] = $movie->getOrigialLanguage();
                $valuesArray["vote_counts"] = $movie->getVoteCounts();
                $valuesArray["popularity"] = $movie->getPopularity();
                $valuesArray["runtime"] = $movie->getRuntime();
                $valuesArray["vote_average"] = $movie->getVoteAverage();

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
                    $movie = new Movie();
                    //$movie->setIdCinema($valuesArray["id"]);
                    $movie->setTitle($valuesArray["title"]);
                    $movie->setPosterPath($valuesArray["poster_path"]);
                    $movie->setOverview($valuesArray["overview"]);
                    $movie->setReleaseDate($valuesArray["release_date"]);
                    $movie->setGenreIds($valuesArray["genre_ids"]);
                    $movie->setOriginalLanguage($valuesArray["original_language"]);
                    $movie->setVoteCounts($valuesArray["vote_counts"]);
                    $movie->setPopularity($valuesArray["popularity"]);
                    $movie->setRuntime($valuesArray["runtime"]);
                    $movie->setVoteAverage($valuesArray["vote_average"]);

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