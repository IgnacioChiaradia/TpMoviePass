<?php
include('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar cine</h2>

               <form class="bg-light-alpha p-5" action="<?php echo FRONT_ROOT ?>Cinema/updateCinema" method="POST">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Nombre del cine</label>
                                   <input type="Text" name="name" value="<?php echo $cinemaSearch->getName(); ?>" class="form-control" placeholder="Nombre" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="Text" name="adress" value="<?php echo $cinemaSearch->getAdress(); ?>" class="form-control" placeholder="Direccion" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Editar</button>
               </form>
          </div>
     </section>
</main>

