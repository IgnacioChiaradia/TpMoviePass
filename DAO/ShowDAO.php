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

        public function Remove($id) //poner show
        {

        }

        public function Enable(Show $show)
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

              return $show;
            }, $value);
            return count($resp) > 1 ? $resp : $resp[0];
          }        
    }

?>
