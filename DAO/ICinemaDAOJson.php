<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAOJson
    {
        function add(Cinema $cinema);
        function update(Cinema $cinema);
    }
?>