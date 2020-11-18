<?php

    namespace Controllers;

    use Models\User as User;
    use Models\Show as Show;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieTheater as MovieTheater;
    use Models\Purchase as Purchase;
    use DAO\PurchaseDAO as PurchaseDAO;
    use DAO\ShowDAO as ShowDAO;
    use DAO\TicketDAO as TicketDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieTheaterDAO as MovieTheaterDAO;

    class PurchaseController
    {

        private $purchaseDAO;
        private $userDAO;
        private $ticketDAO;
        private $showDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $movieTheaterDAO;

        public function __construct()
        {
            $this->purchaseDAO = new PurchaseDAO();
            $this->userDAO = new UserDAO();
            $this->showDAO = new ShowDAO();
            $this->ticketDAO = new TicketDAO();
            $this->movieDAO = new MovieDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieTheaterDAO = new MovieTheaterDAO();
        }

        public function add($ticket_quantity, $id_show)
        {
            $date = date('Y-m-d');
            $user = $_SESSION["loggedUser"];
            $discount = 0;
            //echo ("este es el id " . $id_show . " del show");
            $showSearch = $this->showDAO->getShowById($id_show);
            $showSearch = $this->SetCompleteShows($showSearch);
            $price = $showSearch[0]->getMovieTheater()->getPrice();

            // Descuento: 25%
            if ($this->applyDiscount($ticket_quantity))
            {
                $totalWithoutDiscount = $ticket_quantity * $price;
                $discountValue = ($price * .25);
                $newPriceTicket = $price - $discountValue;
                $total = $ticket_quantity * $newPriceTicket;
                $discount = $totalWithoutDiscount - $total;
            }
            else
            {
                $total = $ticket_quantity * $price;
            }

            $purchase = new Purchase();
            $purchase->setTicketQuantity($ticket_quantity);
            $purchase->setDiscount($discount);
            $purchase->setDate($date);
            $purchase->setTotal($total);

            if($purchase)
            {
                $this->purchaseDAO->add($purchase);
                $message = 'Gracias por su compra, esperamos su pronto regreso '.$user->getUserName().'.<br>';
                require_once(VIEWS_PATH."succesfully-purchase.php");
            }
            else
            {
                $message = "No se puede realizar la compra correctamente.";
                $this->buyTicketView();
            }
        }

        private function applyDiscount($ticket_quantity)
        {
            $date= getdate();
            $today = $date['wday'];
            if ($ticket_quantity >= 2)
            {
                $tuesday = 2;   // 2 - Martes
                $wednesday = 3; // 3 - Miercoles
                if ($today == $tuesday || $today == $wednesday )
                {
                    return true;
                }
            }
            return false;
        }

        public function buyTicketPath($idShow)
        {
            if (isset($_SESSION["loggedUser"]))
            {
                $show = $showDAO->getShowById($idShow);
                if ($show)
                {
                    $title = 'Buy ticket - ' . $show->getMovie()->getTitle();
                    $img = IMG_PATH_TMDB . $show->getMovie()->getPosterPath();
                    $available = $this->numberOfTicketsAvailable($idShow);
                    require_once(VIEWS_PATH . "purchase-view.php");
                }
                else
                {
                   require_once(VIEWS_PATH."client-view.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function purchaseSuccess($id)
        {
            if (isset($_SESSION["loggedUser"]))
            {
                $purchaseTemp = new Purchase();
                $purchaseTemp->setId($id);
                $purchase = $this->purchaseDAO->getById($purchaseTemp);
                if ($purchase)
                {
                    require_once(VIEWS_PATH."succesfully-purchase.php");
                }
                else
                {
                    require_once(VIEWS_PATH."client-view.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function numberOfTicketsAvailable($id_show)
        {
            $tickets = $ticketController->ticketsNumber($id_show);
            $capacity = $showDAO->getShowById($id_show)->getMovieTheater()->getTotalCapacity();

            return $capacity - $tickets;
        }

        public function ticketsAvailable($id_show)
        {
            $quantity = $this->numberOfTicketsAvailable($id_show);
            return ($quantity > 0) ? true : false;
        }

        public function getPurchases()
        {
            return $this->purchaseDAO->getAll();
        }

        public function getById($id)
        {
            $purchase = new Purchase();
            $purchase->setId($id);
            return $this->purchaseDAO->getById($purchase);
        }

        public function SetCompleteShows($showsOfMovieTheater)
        {
             if(!is_array($showsOfMovieTheater))
                    $showsOfMovieTheater = array($showsOfMovieTheater);

            foreach ($showsOfMovieTheater as $show)
                {
                    /*mediante el id de la movie que cargue en el mapear busco la movie y la seteo en el
                    show(funcion)*/
                    $show->setMovie($this->movieDAO->GetMovieById($show->getMovie()->getIdMovie()));

                    /*mediante el id de la movieTheater que cargue en el mapear busco la movieTheater y la seteo en el show(funcion)*/
                    $show->setMovieTheater($this->movieTheaterDAO->GetMovieTheaterById($show->GetMovieTheater()->getIdMovieTheater()));

                    //seteo el cine de la sala
                    $show->getMovieTheater()->setCinema($this->cinemaDAO->GetCinemaById($show->getMovieTheater()->getCinema()->getIdCinema()));
                }

            return $showsOfMovieTheater;
        }
    }

?>
