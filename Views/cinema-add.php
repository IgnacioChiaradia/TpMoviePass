<?php
include('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar cine</h2>

               <form class="bg-light-alpha p-5" action="<?php echo FRONT_ROOT ?>Cinema/addCinema" method="POST">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Nombre del cine</label>
                                   <input type="Text" name="name" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="Text" name="adress" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>

