<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAOJson
    {
        function Add(Cinema $cinema);
        function Update(Cinema $cinema);
    }
?>