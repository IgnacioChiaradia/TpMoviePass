<div class="container">
	<form action="<?php echo FRONT_ROOT ?>Show/AddShow" method="POST" class="p-3 mb-1 bg-dark rounded">
		<div class="form-group">
		    <label for="select-cinema" class="text-light"> Seleccionar pelicula: </label>
		    <select class="form-control" id="select-add-cinema" name="cinema" required="">
		    	<option value="" selected="" disabled="">Peliculas</option>
		    	<?php foreach ($movieList as $movie){ ?>
          			<option name="movieId" value="<?php echo($movie->getIdMovie()); ?>"> <?php echo ($movie->getTitle()); ?></option>
        		<?php } ?>
		   	</select>
		   	<div id="3" class="mt-3 text-dark row" style="background-color: rgba(0, 0, 0, 0.25);"> 
		   		<div class="form-group col m-2"> 
		   			<label for="date" class="text-light"> Añadir fecha: </label> 
		   			<input type="date" name="day" value="" min="<?php echo date("Y-m-d"); ?>" max="" required> 
		   		</div> 
		   		<div class="form-group col m-2"> 
		   			<label for="time" class="text-light"> Seleccionar horario: </label> 
		   			<input type="time" name="hour" min="15:00" max="23:00" required> 
		   		</div> 
		   		<input type="hidden" name="idMovieTheater" value="<?php echo($movieTheaterSearch->getIdMovieTheater());  ?>">
			</div>

			<button type="submit" name="button" class="mt-2 btn btn-light ml-auto d-block">Agregar</button>
	</form>
</div>
<?php 
	if (isset($showsOfMovieTheater[0])) { ?>
		<h3 class="mb-3 mt-2 text-white">Funciones cargadas</h3>
	<?php } if (!isset($showsOfMovieTheater[0])) { ?>
		<h3 class="mb-3 mt-2 text-white">Ninguna funcion cargada aqui</h3>
	<?php } ?>

	<div class="row mt-3">
	<?php 
	if (isset($showsOfMovieTheater)) { ?>
	<?php foreach ($showsOfMovieTheater as $show) { ?>					
	  <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative color-pelis">

        <div class="col p-4 d-flex flex-column position-static text-white">
          <strong class="d-inline-block mb-2 text-primary"> <?php echo ($show->getMovieTheater()->getCinema()->getName() . " - " .$show->getMovieTheater()->getName());?></strong>
          <h3 class="mb-0">Titulo: <?php echo ($show->getMovie()->getTitle());?> </h3>
          <div class="mb-1 text-muted"> Promedio de votos: <?php echo ($show->getMovie()->getVoteAverage());?></div>
          <p class="card-text mb-auto recorta-texto"><strong>Descripcion:</strong> <?php echo ($show->getMovie()->getOverview());?></p>
          <p class="card-text mb-auto"><strong>Popularidad:</strong> <?php echo ($show->getMovie()->getPopularity());?></p>
          <p class="card-text mb-auto"><strong>Duracion:</strong> <?php echo ($show->getMovie()->getRuntime());?> minutos </p>
          <p class="card-text mb-auto"><strong>Dia de la funcion:</strong> <?php echo ($show->getDay());?></p>
          <p class=""><strong>Hora de la funcion:</strong> <?php echo ($show->getHour()	);?> </p>
          <button type="submit" name="button_delete" value="<?php //echo $movieTheater->getIdMovieTheater(); ?>" class="btn btn-danger">Dar de baja</button>
          <a class="btn btn-info" href="<?php// echo FRONT_ROOT ?>MovieTheater/ShowUpdateMovieTheaterView/?id=<?php //echo $movieTheater->getIdMovieTheater(); ?>"> Editar</a>
                                        
          <!--<a href="#" class="stretched-link">Continue reading</a>-->
        </div>

        <div class="col-auto <!--d-none--> d-lg-block">   
        <?php echo ('<img src="https://image.tmdb.org/t/p/w185' . $show->getMovie()->getPosterPath() .  '">'); ?>
        </div>



      </div>
    </div>
    <?php } 
    }?>
  </div>
	<form action="<?php echo FRONT_ROOT ?>Show/BackToMovieTheaterView" method="POST">
		<?php if (isset($show)) { ?>
			<input type="hidden" name="id_cinema" value="<?php echo ($show->getMovieTheater()->getCinema()->getIdCinema()); ?>">			
		<?php } ?>
		<button type="submit" class="btn btn-light d-block" href="">Volver a salas</button>
	</form>
