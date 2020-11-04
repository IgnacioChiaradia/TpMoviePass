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
            $query = "INSERT INTO ".$this->tableName." (id_genre, genre_name) VALUES (:id_genre, :genre_name);";
        	try
            {
                $parameters["id_genre"] = $genre->getIDGenre();
                $parameters["genre_name"] = $genre->getName();

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

        public function getGenreByID ($genre)
        {
            try {
                $query = "SELECT * FROM " . $this->tableName . "WHERE id_genre = " . $genre->getIDGenre() . ";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {
                    $genero->setIDGenre($row["id_genre"]);
                    $genero->setName($row["genre_name"]);
                }
                    return $genero->getName();
                } catch (Exception $ex) {
                    throw $ex;
            }
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

        public function getGenresApi()
        {

        	$genreList = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=' . TMDB_KEY . '&language=es-MX');

            $genreListApi = ($genreList) ? json_decode($genreList, true) : array();

            foreach ($genreListApi as $genres) {

                foreach ($genres as $genre) {

                    $newGenre = new Genre();
                    $newGenre->setIDGenre($genre["id"]);
                    $newGenre->setName($genre["name"]);

                    $this->Add($newGenre);
                }
            }
        }


        protected function mapear($value)
        {
		    $value = is_array($value) ? $value : [];

		    $resp = array_map(function($p){

		    $genre = new Genre();
            $genre->setIDGenre($p["id_genre"]);
            $genre->setName($p["genre_name"]);

		      return $genre;
		    }, $value);
		    return count($resp) > 1 ? $resp : $resp[0];
		}

        /*public function getGenresApi()
        {
        
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
        }*/
    }
?>