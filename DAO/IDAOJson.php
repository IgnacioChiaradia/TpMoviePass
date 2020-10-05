<?php
    namespace DAO;

    //use Models\Cellphone as Cellphone;

    interface IDAOJson
    {
        function Add($object);
        function GetAll();
        function remove($id);
    }
?>