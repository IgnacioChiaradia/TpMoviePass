<?php
    namespace DAO;

    use DAO\IGenreDAOJson as IGenreDAOJson;
    use Models\Genre as Genre;

    class GenreDAO implements IGenreDAOJson
    {
        private $genreList = array();

        public function getAll()
        {
            $this->RetrieveData();

            return $this->genreList;
        }

        private function RetrieveData()
        {
            $this->genreList = array();

            if(file_exists('Data/genre.json'))
            {
                $jsonContent = file_get_contents('Data/genre.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $genre = new Genre();
                    $genre->setIdGenre($valuesArray["idGenre"]);
                    $genre->setName($valuesArray["name"]);

                    array_push($this->genreList, $genre);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->genreList as $genre)
            {
                $id = ($genre->getIdGenre() > $id) ? $genre->getIdGenre() : $id;
            }

            return $id + 1;
        }
    }
?>