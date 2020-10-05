<?php
include('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Lista de cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Direccion</th>
                    </thead>
                    <tbody>
                         <?php foreach ($listCinema as $cinema) { ?>
                              <tr>
                                   <td><?php echo $cinema->getName(); ?></td>
                                   <td><?php echo $cinema->getAdress(); ?></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>

     <section id="eliminar">
          <div class="container">
               <form action="" method="POST" class="form-inline bg-light-alpha p-3">

               </form>
          </div>
     </section>

</main>
