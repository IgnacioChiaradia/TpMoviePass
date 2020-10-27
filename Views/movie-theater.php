<main class="py-5">
     <div class="container">
               <?php if(isset($message)){ ?>
                    <label class="text-white" for=""> <strong> <?php echo $message ?> </strong> </label>
               <?php } ?>
                    <h2 class="mb-4 text-white">Cine</h2>
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>Nombre</th>
                              <th>Direccion</th>
                              <th>Capacidad total</th>
                         </thead>
                         <tbody>
                              <tr>
                                   <td><?php echo 'asd';//echo $cinema->getName(); ?></td>
                                   <td><?php echo 'asd';//echo $cinema->getaddress(); ?></td>
                                   <td><?php echo 'asd';//echo $cinema->getTotalCapacity(); ?></td>
                              </tr>
                         </tbody>
                    </table>
               </div>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-0 text-white">Agregar Salon</h2>
               <?php if(isset($message)){ ?>
                    <label class="text-white" for=""> <strong> <?php echo $message ?> </strong> </label>
               <?php } ?>
               <label for=""></label>
               <form class="bg-light-alpha p-5" action="<?php echo FRONT_ROOT ?>" method="POST">
                    <div class="row font-weight-bold">
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Nombre de la sala</label>
                                   <input type="text" name="name" value="" class="form-control" placeholder="Nombre" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Capacidad</label>
                                   <input type="number" name="capacity" value="" class="form-control" placeholder="Direccion" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Precio</label>
                                   <input type="number" name="price" value="" class="form-control" placeholder="Capacidad total" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>

