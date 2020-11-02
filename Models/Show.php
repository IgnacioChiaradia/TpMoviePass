<?php

    namespace Models;

    class Show
    {
        private $id_room;
        private $showStartTime;
        private $id_show;
        private $id_movie;

        public function getIDRoom()
        {
            return $this->id_room;
        }

        public function setIDRoom($id_room)
        {
            $this->id_room = $id_room;
        }

        public function getShowStartTime()
        {
            return $this->showStartTime;
        }

        public function setShowStartTime($showStartTime)
        {
            $this->showStartTime = $showStartTime;
        }

        public function getIDShow()
        {
            return $this->id_show;
        }

        public function setIDShow($id_show)
        {
            $this->id_show = $id_show;
        }

        public function getIDMovie()
        {
            return $this->id_movie;
        }

        public function setIDMovie($id_movie)
        {
            $this->id_movie = $id_movie;
        }



    }

?>