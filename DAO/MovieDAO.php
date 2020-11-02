<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Movie as Movie;
    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\Connection as Connection;

    class MovieDAO implements IDAO
    {
        private $connection;
        private $tableName = "movies";

        public function GetMoviesApi()
        {

        	$movieListJson = file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=' . TMDB_KEY . '&language=es-MX&page=1');

			$movieListApi = ($movieListJson) ? json_decode($movieListJson, true) : array();

            foreach ($movieListApi["results"] as $movie) {

                $movieDataJson = file_get_contents('https://api.themoviedb.org/3/movie/' . $movie["id"] . '?api_key=' . TMDB_KEY . '&language=en-US');

                $movieData = ($movieDataJson) ? json_decode($movieDataJson, true) : array();

                $newMovie = new Movie();
                $newMovie->setIdMovie($movie["id"]);
                $newMovie->setTitle($movie["title"]);
                $newMovie->setPosterPath($movie["poster_path"]);
                $newMovie->setOverview($movie["overview"]);
                $newMovie->setReleaseDate($movie["release_date"]);
                $newMovie->setGenreIds($movie["genre_ids"]);
                $newMovie->setOriginalLanguage($movie["original_language"]);
                $newMovie->setVoteCounts($movie["vote_count"]);
                $newMovie->setPopularity($movie["popularity"]);
                $newMovie->setRuntime($movieData["runtime"]);
                $newMovie->setVoteAverage($movie["vote_average"]);

                $this->Add($newMovie);
            }
        }

        public function Add(Movie $movie)
        {
            $query = "INSERT INTO ".$this->tableName." (id_movie, title, poster_path, overview, release_date, genre_ids, original_language, vote_count, popularity, runtime, vote_average) VALUES 
            (:id_movie, :title, :poster_path, :overview, :release_date, :genre_ids, :original_language, :vote_count, :popularity, :runtime, :vote_average);";
            
            try
            {

                $parameters = array();

                $parameters["id_movie"] = $movie->getIdMovie();
                $parameters["title"] = $movie->getTitle();
                $parameters["poster_path"] = $movie->getPosterPath();
                $parameters["overview"] = $movie->getOverview();
                $parameters["release_date"] = $movie->getReleaseDate();
                $parameters["genre_ids"] = $movie->getGenreIds();
                $parameters["original_language"] = $movie->getOriginalLanguage();
                $parameters["vote_count"] = $movie->getVoteCounts();
                $parameters["popularity"] = $movie->getPopularity();
                $parameters["runtime"] = $movie->getRuntime();
                $parameters["vote_average"] = $movie->getVoteAverage();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
            	throw $ex;
            }

        }

        public function Remove($id)
        {

        }

        public function GetAll()
        {
            $sql = "SELECT * FROM " .$this->tableName;

		    $result = array();

		    try {
		      $this->connection = Connection::getInstance();
		      $resultSet = $this->connection->execute($sql);

		      if(!empty($resultSet))
		      {
		        $result = $this->mapear($resultSet);
                
                if(!is_array($result))
                    $result = array($result); // hago esto para que cuando devuelva un solo valor de la base lo convierta en array para no tener problemas al querer recorrer la variable con un foreach
		      }
		  	}
		    catch(Exception $ex){
		       throw $ex;
		    }
		    return $result;
        }

        protected function mapear($value)
        {
		    $value = is_array($value) ? $value : [];

		    $resp = array_map(function($p){

		    $movie = new Movie();
            $movie->setIdMovie($p["id_movie"]);
            $movie->setTitle($p["title"]);
            $movie->setPosterPath($p["poster_path"]);
            $movie->setOverview($p["overview"]);
            $movie->setReleaseDate($p["release_date"]);
            $movie->setGenreIds($p["genre_ids"]);
            $movie->setOriginalLanguage($p["original_language"]);
            $movie->setVoteCounts($p["vote_count"]);
            $movie->setPopularity($p["popularity"]);
            $movie->setRuntime($p["runtime"]);
            $movie->setVoteAverage($p["vote_average"]);

		      return $movie;
		    }, $value);
		    return count($resp) > 1 ? $resp : $resp[0];
		}

    }
?>