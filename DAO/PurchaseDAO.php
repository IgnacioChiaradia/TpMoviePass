<?php

namespace DAO;

    use Models\Purchase as Purchase;
    use DAO\QueryType as QueryType;
    use DAO\Connection as Connection;
    use \Exception as Exception;
    use \PDOException as PDOException;

class PurchaseDAO
{
    private $tableName = "purchases";
        private $connection;
        
        public function add(Purchase $purchase) 
        {
            $query = "INSERT INTO ".$this->tableName." (ticket_quantity, discount, date_purchase, total) VALUES (:ticket_quantity, :discount, :date_purchase, :total);";
        	try
            {
                $parameters["ticket_quantity"] = $purchase->getTicketQuantity();
                $parameters["discount"] = $purchase->getDiscount();
                $parameters["date_purchase"] = $purchase->getDate();
                $parameters["total"] = $purchase->getTotal();
        
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }          
        }
        
        public function getAll()
         {
            $sql = "SELECT * FROM purchases";
		    $result = array();

            try 
            {
		      $this->connection = Connection::getInstance();
		      $resultSet = $this->connection->execute($sql);
		    
		      if(!empty($resultSet))
		      {
		        $result = $this->mapear($resultSet);
		      }
		  	}
            catch(Exception $e)
            {
		       throw $ex;
		    }
		    return $result;
        }
        
        public function getById($idPurchase) 
        {
            $sql = "SELECT * FROM purchases WHERE idPurchase = :idPurchase";
            $parameters["idPurchase"] = $idPurchase;

            try
            {
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($sql, $parameters);
            }
            catch(Exception $e)
            {
                throw $e;
            }

            if(!empty($resultSet))
                return $this->mapear($resultSet);
            else
                return false;
        }

        protected function mapear($value) 
        {
		    $value = is_array($value) ? $value : [];

            $resp = array_map(function($p)
            {

		    $purchase = new Purchase();
            $purchase->setId($p["idPurchase"]);
            $purchase->setTicketQuantity($p["userName"]);
            $purchase->setDiscount($p["password"]);
            $purchase->setDate($p["firstName"]);
            $purchase->setTotal($p["lastName"]);

		      return $purchase; 
		    }, $value);
		    return count($resp) > 1 ? $resp : $resp[0]; 
		  }
}

?>