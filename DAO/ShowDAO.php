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

        public function GetAllActive()
        {
            $sql = "SELECT * FROM " .$this->tableName." WHERE ".$this->tableName.".is_active = 1";

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
            $query ="select *
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

        //si me devuelve el registro debere elejir otro dia para esa pelicula
        public function findShowByDayAndMovie($newShow)
        {

            //$query = "select shows.* from shows where shows.id_movie = :id_movie AND shows.day = :day;";

            $query = "select s.*
                     from shows s
                     where s.id_movie= :id_movie AND s.day= :day;";

            $result = null;

            try{
                $this->connection = Connection::GetInstance();

                $parameters = array();
                
                $parameters['day'] = $newShow->getDay();
                $parameters['id_movie'] = $newShow->getMovie()->getIdMovie();

                var_dump($query);
                echo '<br>';

                echo ($newShow->getDay());
                echo '<br>';
                echo ($newShow->getMovie()->getIdMovie());

                echo '<br>';
                var_dump($parameters);

                $resultSet = $this->connection->execute($query, $parameters);

                //var_dump($parameters);
                //die();


                if(!empty($resultSet))
                {
                    $result = $this->mapear($resultSet);
                }

            }catch(Exception $e) {
                throw $e;
            }

            return $result;
        }

        public function Disable(Show $show)
        {
            $query = "UPDATE ".$this->tableName." SET state = :state WHERE id_show = :id_show";
            
            try
            {
                $parameters["id_show"] = $show->getIdShow();
                $parameters["state"] = false;

                $this->connection = Connection::GetInstance();

                $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            return $rowCount;
        }

        public function Enable(Show $show)
        {
            $query = "UPDATE ".$this->tableName." SET state = :state WHERE id_show = :id_show";
            
            try
            {
                $parameters["id_show"] = $show->getIdShow();
                $parameters["state"] = true;

                $this->connection = Connection::GetInstance();

                $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            return $rowCount;
        }        

        public function Update(Show $show)
        {

        }

        public function GetShowById($idShow)
        {
            $sql = "SELECT * FROM " . $this->tableName . " WHERE id_show = :id_show";
            $result = null;

            try {
                    $parameters["id_show"] = $idShow;

                    $this->connection = Connection::getInstance();
                    $resultSet = $this->connection->Execute($sql,$parameters);

                    if(!empty($resultSet))
                    {
                      $result = $this->mapear($resultSet);
                    }
            }
            catch(Exception $ex){
               throw $ex;
            }

            return $result;
        }

        protected function mapear($value) {
            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p){

            $show = new Show();
            $show->setIdShow($p["id_show"]);
            $show->setState($p["state"]);
            $show->setDay($p["day"]);
            $show->setHour($p["hour"]);

            /*$movieSearch = new Movie();
            $movieSearch = $this->GetMovieById($p["id_movie"]);
            $show->setMovie($movieSearch);*/

            //solo cargo el id para luego buscarlo en la controladora y conformar el objeto como es debido y no tener que hacer repeticion de codigo ya que no puedo acceder a otros daos
            $movieSearch = new Movie();
            $movieSearch->setIdMovie($p["id_movie"]); 
            $show->setMovie($movieSearch);

            /*$movieTheaterSearch = new MovieTheater();
            $movieTheaterSearch = $this->GetMovieTheaterById($p["id_movie_theater"]);
            $show->setMovieTheater($movieTheaterSearch);*/

            //aqui tambien solo cargo el id para luego buscarlo en la controladora y conformar el objeto como es debido  y no tener que hacer repeticion de codigo ya que no puedo acceder a otros daos
            $movieTheaterSearch = new MovieTheater();
            $movieTheaterSearch->setIdMovieTheater($p["id_movie_theater"]);
            $show->setMovieTheater($movieTheaterSearch);

            //$cinemaSearch = new Cinema();
            //$cinemaSearch->setIdCinema()

              return $show;
            }, $value);
            return count($resp) > 1 ? $resp : $resp[0];
          }        
    }

?>
