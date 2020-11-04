<?php
	namespace DAO;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\IShowDAO as IShowDAO;
    use DAO\IDAO as IDAO;
    use Models\Show as Show;
    use DAO\Connection as Connection;

    class ShowDAO implements IShowDAO, IDAO
    {
        private $connection;
        private $tableName = "shows";

        
    }

?>
