<?php
	namespace DAO;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\IFunctionDAO as IFunctionDAO;
    use DAO\IDAO as IDAO;
    //use Models\Function as Function;
    use DAO\Connection as Connection;

    class FunctionDAO implements IFunctionDAO, IDAO
    {
        private $connection;
        private $tableName = "functions";

        public function Add(Function $function)
        {
            $query = "INSERT INTO ".$this->tableName." (state, name, address) VALUES (:state, :name, :address);";
        	try
            {
                $parameters["state"] = true;
                $parameters["name"] = $cinema->getName();
                $parameters["address"] = $cinema->getAddress();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
            	throw $ex;
            }

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
                    $result = array($result); // hago esto para que cuando devuelva un solo valor de la base lo convierta en array para no tener problemas al querer recorrer la variable con un foreach
		      }
		  	}
		    catch(Exception $ex){
		       throw $ex;
		    }
		    return $result;
        }

        public function Remove($id)
        {
            $query = "UPDATE ".$this->tableName." SET state = :state WHERE id_cinema = :id_cinema";

            try
            {
                $parameters["id_cinema"] = $id;
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

        public function Enable($id)
        {
            $query = "UPDATE ".$this->tableName." SET state = :state WHERE id_cinema = :id_cinema";
            try
            {
                $parameters["id_cinema"] = $id;
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

        public function Update(Function $newFunction)
        {
            $query = "UPDATE ".$this->tableName." SET name = :name, address = :address WHERE id_cinema = :id_cinema";
        	try
            {
            	$parameters["id_cinema"] = $newCinema->getIdCinema();  

                $parameters["name"] = $newCinema->getName();
                $parameters["address"] = $newCinema->getAddress();

                $this->connection = Connection::GetInstance();

                $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            return $rowCount;
        }

        public function GetCinemaById($idFunction)
        {
        	$sql = "SELECT * FROM " . $this->tableName . " WHERE id_cinema = :id_cinema";
		    $result = array();

		    try {
                    $parameters["id_cinema"] = $idCinema;

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

		    $cinema = new Cinema();
            $cinema->setIdCinema($p["id_cinema"]);
            $cinema->setState($p["state"]);
            $cinema->setName($p["name"]);
            $cinema->setAddress($p["address"]);

		      return $cinema;
		    }, $value);
		    return count($resp) > 1 ? $resp : $resp[0];
		  }
    }

?>
