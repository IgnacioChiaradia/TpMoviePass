<?php
    namespace DAO;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\ICinemaDAO as ICinemaDAO;
    use DAO\IDAO as IDAO;
    use Models\Genre as Genre;
    use DAO\Connection as Connection;

    class GenreDAO implements ICinemaDAO, IDAO
    {
        private $connection;
        private $tableName = "genres";

        public function Add(Genre $genre)
        {
            $query = "INSERT INTO ".$this->tableName." (idGenre, name) VALUES (:idGenre, :name);";
        	try
            {
                $parameters["idGenre"] = $genre->getIDGenre();
                $parameters["name"] = $genre->getName();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
            	throw $ex;
            }

        }

        public function getGenresApi(){
        
            $json = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=' . TMDB_KEY . '&language=es-MX&page=1');
            
            $jsonArray = json_decode($json, true);
            $arrayJsonData = $jsonArray["genres"];
            $genres = array();
    
            for($i=0;$i<count($arrayJsonData); $i++){
                $jsonData = $arrayJsonData[$i];
                $id = $jsonData["idGenre"];
                $name = $jsonData["name"];
    
                $genre = new Genre();
                $genre->setIDGenre($idGenre);
                $genre->setName($name);
    
                array_push($genres,$genre);
            }        
            return $genres;
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->genreList as $genre)
            {
                $id = ($genre->getIdGenre() > $id) ? $genre->getIdGenre() : $id;
            }

            return $id + 1;
        }
    }
?>