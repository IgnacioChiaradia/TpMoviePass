<div class="container">
	<form action="<?php echo FRONT_ROOT ?>/" method="POST" class="p-3 mb-1 bg-dark rounded">
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
		   			<input type="date" name="date" value="" min="<?php echo date("Y-m-d"); ?>" max="" required> 
		   		</div> 
		   		<div class="form-group col m-2"> 
		   			<label for="time" class="text-light"> Seleccionar horario: </label> 
		   			<input type="time" name="time" min="15:00" max="23:00" required> 
		   		</div> 
		   		<input type="hidden" name="idMovieTheater" value="<?php echo($movieTheaterSearch->getIdMovieTheater());  ?>">
			</div>

			<button type="submit" name="button" class="mt-2 btn btn-light ml-auto d-block">Agregar</button>
	</form>
</div>

	<div class="row mt-3">
	  <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative color-pelis">

        <div class="col p-4 d-flex flex-column position-static text-white">
          <strong class="d-inline-block mb-2 text-primary"> Dia de estreno: <?php //echo ($movie->getReleaseDate());?></strong>
          <h3 class="mb-0">Titulo: <?php //echo ($movie->getTitle());?> </h3>
          <div class="mb-1 text-muted"> Promedio de votos: <?php //echo ($movie->getVoteAverage());?></div>
          <p class="card-text mb-auto"><strong>Descripcion:</strong> <?php //echo ($movie->getOverview());?></p>
          <p class="card-text mb-auto"><strong>Popularidad:</strong> <?php //echo ($movie->getPopularity());?></p>
          <p class="card-text mb-auto"><strong>Duracion:</strong> <?php //echo ($movie->getRuntime());?> minutos </p>
          <!--<a href="#" class="stretched-link">Continue reading</a>-->
        </div>

        <div class="col-auto <!--d-none--> d-lg-block">   
        <?php //echo ('<img src="https://image.tmdb.org/t/p/w185' . $movie->getPosterPath() .  '">'); ?>
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative color-pelis">

        <div class="col p-4 d-flex flex-column position-static text-white">
          <strong class="d-inline-block mb-2 text-primary"> Dia de estreno: <?php //echo ($movie->getReleaseDate());?></strong>
          <h3 class="mb-0">Titulo: <?php //echo ($movie->getTitle());?> </h3>
          <div class="mb-1 text-muted"> Promedio de votos: <?php //echo ($movie->getVoteAverage());?></div>
          <p class="card-text mb-auto"><strong>Descripcion:</strong> <?php //echo ($movie->getOverview());?></p>
          <p class="card-text mb-auto"><strong>Popularidad:</strong> <?php //echo ($movie->getPopularity());?></p>
          <p class="card-text mb-auto"><strong>Duracion:</strong> <?php //echo ($movie->getRuntime());?> minutos </p>
          <!--<a href="#" class="stretched-link">Continue reading</a>-->
        </div>

        <div class="col-auto <!--d-none--> d-lg-block">   
        <?php //echo ('<img src="https://image.tmdb.org/t/p/w185' . $movie->getPosterPath() .  '">'); ?>
        </div>

      </div>
    </div>
  </div>
	<form action="<?php echo FRONT_ROOT ?>Show/BackToMovieTheaterView" method="POST">
		<input type="hidden" name="id_cinema" value="<?php echo($idCinema); ?>">
		<button type="submit" class="btn btn-light d-block" href="">Volver a salas</button>
	</form>
