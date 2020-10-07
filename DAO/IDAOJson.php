<?php
    namespace DAO;

    interface IDAOJson
    {
        function add($object);
        function getAll();
        function remove($id);
    }
?>