<?php

namespace Controllers;

    use DAO\GenreDAO as GenreDAO;
    use Models\Genre as Genre;

class GenreController
{
    private $genreDAO;

    public function __construct()
    {
        $this->genreDAO = new GenreDAO();
    }

    public function listGenres($message = '')
    {
        $movieGenreList = $this->genreDAO->getGenresApi();

        $this->moviesView($movieList,$message); 
    }
}

?>