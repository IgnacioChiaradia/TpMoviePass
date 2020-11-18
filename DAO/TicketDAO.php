<?php

    namespace DAO;

    use Models\Ticket as Ticket;
    use DAO\QueryType as QueryType;
    use DAO\Connection as Connection;
    use \Exception as Exception;
    use \PDOException as PDOException;
    
    class TicketDAO 
    {
        
        private $tableName = "tickets";
        private $connection;

        public function add(Ticket $ticket) 
        {
            try 
            {                
                $query = "INSERT INTO ".$this->tableName." (ticket_number,qr, purchase, show) VALUES (:ticket_number,:qr, :idPurchase, :idShow);";
                $parameters["ticket_number"] = $ticket->getTicketNumber();
                $parameters["qr"] = $ticket->getQr();
                $parameters["id_purchase"] = $ticket->getIdPurchase();
                $parameters["id_show"] = $ticket->getShow();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch(Exception $e) 
            {
                throw $ex;
                return false;
            }
        }
        
        public function getByNumber($ticket_number) 
        {
            $sql = "SELECT * FROM tickets WHERE ticket_number = :ticket_number";
            $parameters["ticket_number"] = $ticket_number;

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

        public function getAll() 
        {
            $sql = "SELECT * FROM tickets";
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

        public function getInfoShowTickets() 
        {
            $sql = "";
            $result = array();
            try 
            {           
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($sql,array());
                $ticketList = array();
                foreach ($resultSet as $row) 
                {
                    $ticket = new Ticket();
                    
                    $cinema = new Cinema();
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setName($row["name"]);

                    $movieTheater = new MovieTheater();
                    $movieTheater->setName($row["name"]);
                    $movieTheater->setCinema($cinema);

                    $movie = new Movie();
                    $movie->setTitle($row["title"]);

                    $show = new Show();
                    $show->setIdShow($row["id_show"]);
                    $show->setDay($row["day"]);
                    $show->setHour($row["hour"]);
                    $show->setMovie($movie);
                    $show->setMovieTheater($movieTheater);

                    $ticket->setShow($show);

                    array_push($ticketList, $ticket);
                }

                return $ticketList;
                
            } 
            catch(Exception $e) 
            {
                return false;
            }
        }

        public function getTicketsOfShows(Show $show) 
        {
            try 
            {
                $query = "SELECT * FROM tickets WHERE id_show = :id_show";
                $parameters['id_show'] = $show->getIdShow();
                $this->connection = Connection::getInstance();
                $results = $this->connection->Execute($query, $parameters);
                $results = $results[0];

                return $results["count(FK_id_show)"];
                
            } 
            catch(Exception $e) 
            {
                return false;
            }
        }
        
        protected function mapear($value) 
        {
		    $value = is_array($value) ? $value : [];

            $resp = array_map(function($p)
            {

		    $ticket = new Ticket();
            $ticket->setId($p["idTicket"]);
            $ticket->setTicketNumber($p["ticket_number"]);
            $ticket->setQr($p["qr"]);
            $ticket->setShow($p["id_show"]);
            $ticket->setIdPurchase($p["idPurchase"]);

		      return $ticket; 
		    }, $value);
		    return count($resp) > 1 ? $resp : $resp[0]; 
		  }

    }

?>