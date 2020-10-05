<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function listCineView($message = "")
        {
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function addCineView($message = "")
        {
            require_once(VIEWS_PATH."cinema-add.php");
        }            
    }
?>