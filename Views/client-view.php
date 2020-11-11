<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a href="<?php echo FRONT_ROOT ?>" style="text-decoration: none;"><strong> Movie </strong> Pass Home</a>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT?>Home/logout">Logout</a>
          </li>
    </ul>
</nav>

<div class="container">
          <section id="listado" class="mb-5">
               <h2 class="mb-4 text-white">Bienvenido!! Gracias por elegirnos</h2>
               <?php if(isset($message)){ ?>
                    <label class="text-white" for=""> <strong> <?php echo $message ?> </strong> </label>
               <?php } ?>
               <label for=""></label>
               <h3 class="mb-4 text-white">Funciones</h3>
               <?php if(isset($showsActive))
               {
               ?>
                 <?php   foreach ($showsActive as $show) { ?>
                    <div class="col p-4 d-flex flex-column position-static text-white">
                         <strong class="d-inline-block mb-2 text-primary"> Dia de estreno: <?php echo ($show->getDay());?></strong>
                         <h3 class="mb-0">Hora: <?php echo ($show->getHour());?> </h3>
                         <div class="mb-1 text-muted"> Movie: <?php echo ($show->getMovie()->getTitle());?></div>
                          <p class="card-text mb-auto"><strong>Cine:</strong> <?php echo ($show->getMovieTheater()->getCinema()->getName() . " - " .$show->getMovieTheater()->getName());?></p>
                    </div>
               <?php }
               } else if(!isset($showsActive))
                    {?>
                    <h3 class="text-white">No hay funciones Cargadas!</h3>
                 <?php   }
               ?>
          </section>
</div>
