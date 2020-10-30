<?php
    namespace DAO;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\IDAO as IDAO;
    use Models\Genre as Genre;
    use DAO\Connection as Connection;

    class GenreDAO implements IDAO
    {
        private $connection;
        private $tableName = "genres";

        public function Add(Genre $genre)
        {
            $query = "INSERT INTO " . $this->tableName . "(name) VALUES (:name);";
        	try
            {
                $parameters["name"] = $genre->getName();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
            	throw $ex;
            }

        }

        public function Remove($id){}
        public function GetAll(){}

        public function getGenresApi(){
        
            $json = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=' . TMDB_KEY . '&language=es-MX');
            $jsonArray = json_decode($json, true);
            $arrayJsonData = $jsonArray["genres"];
            $genreList = array();
    
            for($i=0; $i < count($arrayJsonData); $i++){
                $jsonData = $arrayJsonData[$i];
                $idGenre = $jsonData["id"];
                $name = $jsonData["name"];
    
                $genre = new Genre();
                $genre->setIDGenre($idGenre);
                $genre->setName($name);
    
                array_push($genreList,$genre);
            }        
            return $genreList;
        }
    }
?>