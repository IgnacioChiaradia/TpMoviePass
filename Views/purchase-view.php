<?php require_once(VIEWS_PATH."nav.php");
//var_dump($show);?>
<main>
        <div class="container">
            <div class="purchase-container">
                <div class="show-info">
                    <h3 class="text-white">Informacion</h3>
                    <h3 class="text-white">
                            <i class="icon ion-md-videocam"></i>
                            <?php echo $show->getMovie()->getTitle(); ?>
                        </h3>
                    <h3 class="text-white">
                            <i class="text-white"></i>
                            Precio del Ticket: $<span class="text-white" id="price-ticket"><?php echo $show->getMovieTheater()->getPrice(); ?></span>
                        </h3>
                        <h3 class="text-white">
                            <i class="icon ion-md-calendar"></i>
                            <?php echo $show->getMovieTheater()->getCinema()->getName(); ?> - <?php echo $show->getMovieTheater()->getName(); ?>
                        </h3>
                        <h3 class="text-white">
                            <i class="icon ion-md-pin"></i>
                            <?php echo $show->getMovieTheater()->getCinema()->getAddress(); ?>
                        </h3>
                        <h3 class=text-white>
                            <i class="icon ion-md-calendar"></i>
                            <?php $show->getDay(); ?>
                            at
                            <?php $show->getHour(); ?>
                        </h3>

                        <h3 class="text-white">
                            Descuentos los Martes y Miercoles <br>
                            Comprando dos tickets o mas...
                        </h3>
                    </div>
                    <div class="show-total">
                        <h3 class="text-white">
                            <i class="icon ion-md-cart"></i>
                            Total: $<span id="cart-total">0</span>
                            <div class="ticket-information">
                                <h4 class = "text-white">Tipo de Ticket: General</h4>
                                <h4 class = "text-white">Tickets: <span id="ticket-quantity">0</span> </h4>
                                <h4 class = "text-white">Descuento: <span id="discount">N/A</span></h4>
                                <h4 class = "text-white"  id="total"></h4>
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="purchase-form">
                    <form action="<?php echo FRONT_ROOT ?>Purchase/add" method="POST" class="register-form">
                        <label>
                            <h4 class = "text-white">Insert quantity of tickets</h4>
                            <input type="number" name="ticket_quantity" id="numberTickets" min="1" max="<?php $available; ?>" required>
                        </label>

                        <input type="hidden" name="id_show" value="<?php echo $show->getIdShow(); ?>">
                        <br>
                        <label>
                            <h4 class = "text-white">Tarjeta</h4>
                            <div class="card-container">
                                <input type="radio" name="card" placeholder="Visa" value="MasterCard o Visa">
                            </div>
                        </label>

                        <br>
                        <label>
                            <h4 class = "text-white">Insert card number</h4>
                            <input type="text" placeholder="1234123412341234" name="cardName" maxlength="16" minlength="16" required>
                        </label>
                        <br>
                        <label>
                            <h4 class = "text-white">Security code</h4>
                            <input type="text" placeholder="123" name="scode" maxlength="3" minlength="3" required>
                        </label>
                        <br>
                        <label>
                            <h4 class = "text-white">Expiration date</h4>
                            <input type="month" name="eDate" required>
                        </label>
                        <br>
                        <button class="btn-l" type="submit">Confirmar compra</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
