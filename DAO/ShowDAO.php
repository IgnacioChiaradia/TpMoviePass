<?php
	namespace DAO;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\IShowDAO as IShowDAO;
    use DAO\IDAO as IDAO;
    use Models\Show as Show;
    use Models\MovieTheater as MovieTheater;
    use Models\Movie as Movie;
    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    class ShowDAO implements IShowDAO, IDAO
    {
        private $connection;
        private $tableName = "shows";

        public function Add(Show $newShow)
        {
            $query = "INSERT INTO ".$this->tableName." (state, day, hour, id_movie, id_movie_theater) VALUES (:state, :day, :hour, :id_movie, :id_movie_theater);";

            try
            {
                $parameters["state"] = true;
                $parameters["day"] = $newShow->getDay();
                $parameters["hour"] = $newShow->getHour();

                $parameters["id_movie"] = $newShow->getMovie()->getIdMovie();
                $parameters["id_movie_theater"] = $newShow->getMovieTheater()->getIdMovieTheater();

                $this->connection = Connection::GetInstance();

                $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            return $rowCount;
        }

        public function GetAll()
        {
            $sql = "SELECT * FROM ". $this->tableName;
            $result = array();

            try {
              $this->connection = Connection::getInstance();
              $resultSet = $this->connection->execute($sql);

              if(!empty($resultSet))
              {
                $result = $this->mapear($resultSet);

                if(!is_array($result))
                    $result = array($result); 
              }
            }
            catch(Exception $ex){
               throw $ex;
            }
            return $result;
        }

        public function GetAllShowsByMovieTheater(MovieTheater $movieTheater)
        {
            $query ="select shows.*
                    from shows
                    where shows.id_movie_theater = :id_movie_theater";
            $result = array();

            try{

                $this->connection = Connection::GetInstance();

                $parameters['id_movie_theater'] = $movieTheater->getIdMovieTheater();

                $resultSet = $this->connection->execute($query, $parameters);       

                if(!empty($resultSet))
                {
                    $result = $this->mapear($resultSet);
                }

            }catch(Exception $e) {
                throw $e;
            }

            return $result;
        }

        public function GetCinemaById($idCinema)
        {
            $sql = "SELECT * FROM cinemas WHERE id_cinema = :id_cinema";
            $cinema = null;

            try {
                    $parameters["id_cinema"] = $idCinema;

                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->Execute($sql,$parameters);

                    if(!empty($resultSet))
                    {
                        foreach($resultSet as $value)
                        {
                            $cinema = new Cinema();
                            $cinema->setIdCinema($value["id_cinema"]);
                            $cinema->setState($value["state"]);
                            $cinema->setName($value["name"]);
                            $cinema->setAddress($value["address"]);
                        }                    
                    }
                }
            catch(Exception $ex){
               throw $ex;
            }

            return $cinema;
        }

        public function GetMovieTheaterById($idMovieTheater)
        {
            $sql = "SELECT * FROM movie_theaters WHERE id_movie_theater = :id_movie_theater";
            $movieTheater = null;

            try {
                    $parameters["id_movie_theater"] = $idMovieTheater;

                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->Execute($sql,$parameters);

                    if(!empty($resultSet))
                    {
                      foreach($resultSet as $value)
                        {
                            $movieTheater = new MovieTheater();
                            $movieTheater->setIdMovieTheater($value["id_movie_theater"]);
                            $movieTheater->setState($value["state"]);
                            $movieTheater->setName($value["name"]);
                            $movieTheater->setCurrentCapacity($value["current_capacity"]);
                            $movieTheater->setPrice($value["price"]);
                            $movieTheater->setTotalCapacity($value["total_capacity"]);

                            $cinemaSearch = $this->GetCinemaById($value["id_cinema"]);

                            $movieTheater->setCinema($cinemaSearch);

                        }                   
                    }
            }
            catch(Exception $ex){
               throw $ex;
            }

            return $movieTheater;
        }

        public function GetMovieById($idMovie)
        {
            $sql = "SELECT * FROM movies WHERE id_movie = :id_movie";
            $movie = null;

            try {
                    $parameters["id_movie"] = $idMovie;

                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->Execute($sql,$parameters);

                    if(!empty($resultSet))
                    {
                        foreach($resultSet as $value)
                        {
                          $movie = new Movie();
                          $movie->setIdMovie($value["id_movie"]);
                          $movie->setTitle($value["title"]);
                          $movie->setPosterPath($value["poster_path"]);
                          $movie->setOverview($value["overview"]);
                          $movie->setReleaseDate($value["release_date"]);
                          $movie->setGenreIds($value["genre_ids"]); 
                          $movie->setOriginalLanguage($value["original_language"]);
                          $movie->setVoteCounts($value["vote_count"]);
                          $movie->setPopularity($value["popularity"]);
                          $movie->setRuntime($value["runtime"]);
                          $movie->setVoteAverage($value["vote_average"]);
                        }
                    }
            }
            catch(Exception $ex){
               throw $ex;
            }

            return $movie;
        }


        public function Remove($id) //poner show
        {

        }

        public function Enable(Show $show) //poner show
        {

        }        

        public function Update(Show $show)
        {

        }

        protected function mapear($value) {
            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p){

            $show = new Show();
            $show->setIdShow($p["id_show"]);
            $show->setState($p["state"]);
            $show->setDay($p["day"]);
            $show->setHour($p["hour"]);

            $movieSearch = new Movie();
            $movieSearch = $this->GetMovieById($p["id_movie"]);
            $show->setMovie($movieSearch);

            $movieTheaterSearch = new MovieTheater();
            $movieTheaterSearch = $this->GetMovieTheaterById($p["id_movie_theater"]);
            $show->setMovieTheater($movieTheaterSearch);

              return $show;
            }, $value);
            return count($resp) > 1 ? $resp : $resp[0];
          }        
    }

?>
