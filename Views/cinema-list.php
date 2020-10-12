<?php
include('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form action="<?php echo FRONT_ROOT ?>Cinema/removeCinema" method="POST">
               <div class="container">
                    <h2 class="mb-4 text-white">Lista de cines</h2>
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>Nombre</th>
                              <th>Direccion</th>
                              <th colspan="2">Acciones</th>
                         </thead>
                         <tbody>
                              <?php foreach ($listCinema as $cinema) { ?>
                                   <tr>
                                        <td><?php echo $cinema->getName(); ?></td>
                                        <td><?php echo $cinema->getAdress(); ?></td>
                                        <td> <button type="submit" name="button_delete" value="<?php echo $cinema->getIdCinema(); ?>" class="btn btn-danger">Borrar</button> </td>
                                        <td><a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Cinema/ShowUpdateCinemaView/?id=<?php echo $cinema->getIdCinema(); ?>"> Editar</a></td>
                                   </tr>
                              <?php } ?>
                         </tbody>
                    </table>
               <?php if(isset($message)){ ?>
                              <label for=""> <strong> <?php echo $message ?> </strong> </label>
                         <?php } ?>
               </div>
          </form>
     </section>
     
     <!-- no eliminar, puede servir a futuro como otro editar -->
     <!--<section id="eliminar">
          <div class="container">
               <form action="<?php //echo FRONT_ROOT ?>Cinema/ShowUpdateCinemaView" method="POST" class="form-inline bg-light-alpha p-3">
                    <div class="form-group text-white">
                         <label for="">Ingrese nombre del cine a editar</label>
                         <input type="text" name="name" value="" class="form-control ml-3" required="">
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-3">Editar</button>
               </form>
          </div>
     </section> -->

</main>
