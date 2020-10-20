<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4 text-white">Agregar cine</h2>
               <?php if(isset($message)){ ?>
                    <label class="text-white" for=""> <strong> <?php echo $message ?> </strong> </label>
               <?php } ?>
               <label for=""></label>
               <form class="bg-light-alpha p-5" action="<?php echo FRONT_ROOT ?>Cinema/addCinema" method="POST">
                    <div class="row font-weight-bold">
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Nombre del cine</label>
                                   <input type="Text" name="name" value="" class="form-control" placeholder="Nombre" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="Text" name="adress" value="" class="form-control" placeholder="Direccion" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Valor de entrada</label>
                                   <input type="number" name="ticket_value" value="" class="form-control" placeholder="Valor de entrada" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Capacidad total</label>
                                   <input type="number" name="total_capacity" value="" class="form-control" placeholder="Capacidad total" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>

