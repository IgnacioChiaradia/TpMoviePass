<?php

namespace Controllers;

use Models\Show as Show;
use DAO\ShowDAO as ShowDAO;
use Models\Ticket as Ticket;
use DAO\TicketDAO as TicketDAO;
use DAO\UserDAO as UserDAO;
use DAO\MovieTheaterDAO as MovieTheaterDAO;
use Models\MovieTheater as MovieTheater;
use DAO\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use DAO\MovieDAO as MovieDAO;
use Models\Movie as Movie;
use DAO\PurchaseDAO as PurchaseDAO;
use Models\Purchase as Purchase;

class TicketController
{
    private $ticketDAO;
    private $userDAO;
    private $movieTheaterDAO;
    private $cinemaDAO;
    private $movieDAO;
    private $showDAO;
    private $purchaseDAO;

    public function __construct()
    {
        $this->ticketDAO = new TicketDAO();
        $this->userDAO = new UserDAO();
        $this->movieTheaterDAO = new MovieTheaterDAO();
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
        $this->showDAO = new ShowDAO();
        $this->purchaseDAO = new PurchaseDAO();
    }

    public function add($qr, $id_show, $idPurchase)
    {
        $ticket = new Ticket();
        $ticket->setQr($qr);
        $ticket->setIdPurchase($id_purchase);

        $show = new Show();
        $show->setId($id_show);
        $ticket->setShow($show);

        return $this->ticketDAO->add($ticket);
    }

    public function getTickets()
    {
        return $this->ticketDAO->getAll();
    }

    public function getByNumber($ticket_number)
    {
        $ticket = new Ticket();
        $ticket->setTicketNumber($ticket_number);
        return $this->ticketDAO-getByNumber($ticket_number);
    }

    public function ticketsSoldPath()
    {
        if (isset($_SESSION["loggedUser"]))
        {
            $admin = $_SESSION["loggedUser"];
            if ($admin->getRole() == 1)
            {
                $tickets = $this->ticketDAO->getInfoShowTickets();
                if ($tickets)
                {
                    require_once(VIEWS_PATH . "ticket-sold-reminder.php");
                }
                else
                {
                    require_once(VIEWS_PATH."admin-view.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."login.php");
            }
        }
        else
        {
            require_once(VIEWS_PATH."login.php");;
        }
    }

    public function getTicketsSold($id_show)
    {
        $show = new Show();
        $show->setId($id_show);
        return $this->ticketDAO->getTicketsOfShows($show);
    }

    public function getTickesRemainder($id_show)
    {
        $show = new Show();
        $show->setIdShow($id_show);
        $movieTheater = $movieTheaterDAO->getByIdShow($id_show);
        $tickesSold = $this->getTicketsSold($id_show);

        return ($movieTheater->getCapacity() - $tickesSold);
    }

    public function ticketSoldReminderView()
    {
        $tickets = $this->ticketDAO->getAll();
        //$ticketDAO = $this->ticketDAO;
        $tickets = $this->SetCompleteTickets($tickets);
        $cinemas = $this->cinemaDAO->getAll();
        $movies = $this->movieDAO->getAll();
        require_once(VIEWS_PATH."ticket-sold-reminder.php");
    }

    public function SetCompleteTickets($tickets)
    {
         if(!is_array($tickets))
                $tickets = array($tickets);

        foreach ($tickets as $ticket)
            {
                $show = $this->showDAO->GetShowById($ticket->getShow()->getIdShow());
                $show->setMovie($this->movieDAO->GetMovieById($show->getMovie()->getIdMovie()));

                $hour = strtotime($show->getHour());
                $hour = date('H:i', $hour);
                $show->setHour($hour);

                $show->setMovieTheater($this->movieTheaterDAO->GetMovieTheaterById($show->GetMovieTheater()->getIdMovieTheater()));

                $show->getMovieTheater()->setCinema($this->cinemaDAO->GetCinemaById($show->getMovieTheater()->getCinema()->getIdCinema()));

                $ticket->setPurchase($this->purchaseDAO->getById($ticket->getPurchase()->getId()));

                $ticket->setShow($show);
            }

        return $tickets;
    }
}

?>
