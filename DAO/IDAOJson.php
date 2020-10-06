<?php
    namespace DAO;

    interface IDAOJson
    {
        function Add($object);
        function GetAll();
        function remove($id);
    }
?>