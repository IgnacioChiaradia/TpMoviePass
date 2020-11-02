<div class="container">
  <?php if(isset($message)){ ?>
          <div class="text-white ml-3 mb-1" for=""> <strong> <?php echo $message ?> </strong> </div>
  <?php } ?>
  <label class="col-lg-3 mb-2">
    <select name="career" class="form-control form-control-ml">
        <option selected="" value="">Seleccione el genero</option>
        <?php foreach ($genreList as $genre){ ?>
          <option name="movieGenre" value="<?php echo($genre->getIDGenre()); ?>"> <?php echo ($genre->getName()); ?></option>
        <?php } ?>
                                   
    </select>

    

  </label>               
  <!--<a class="btn btn-info mb-2" href="<?php echo FRONT_ROOT ?>Movie/RenewJsonMovies">Renovar lista peliculas</a> -->
  <?php foreach ($movieList as $movie) { ?>
    <div class="col-md-12">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative color-pelis">

        <div class="col p-4 d-flex flex-column position-static text-white">
          <strong class="d-inline-block mb-2 text-primary"> Dia de estreno: <?php echo ($movie->getReleaseDate());?></strong>
          <h3 class="mb-0">Titulo: <?php echo ($movie->getTitle());?> </h3>
          <div class="mb-1 text-muted"> Promedio de votos: <?php echo ($movie->getVoteAverage());?></div>
          <p class="card-text mb-auto"><strong>Descripcion:</strong> <?php echo ($movie->getOverview());?></p>
          <p class="card-text mb-auto"><strong>Popularidad:</strong> <?php echo ($movie->getPopularity());?></p>
          <p class="card-text mb-auto"><strong>Duracion:</strong> <?php echo ($movie->getRuntime());?> minutos </p>
          <!--<a href="#" class="stretched-link">Continue reading</a>-->
        </div>

        <div class="col-auto <!--d-none--> d-lg-block">   
        <?php echo ('<img src="https://image.tmdb.org/t/p/w185' . $movie->getPosterPath() .  '">'); ?>
        </div>

      </div>
    </div>
  <?php } ?>
</div>