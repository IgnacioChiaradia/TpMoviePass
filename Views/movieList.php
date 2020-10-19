<div class="container">

    <div class="col-md-12">

      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative color-pelis">
        
        <div class="col p-4 d-flex flex-column position-static text-white">
          <strong class="d-inline-block mb-2 text-primary"> Dia de estreno: <?php echo ($movieList["results"][0]["release_date"]);?></strong>
          <h3 class="mb-0">Titulo: <?php echo ($movieList["results"][0]["title"]);?> </h3>
          <div class="mb-1 text-muted"> Promedio de votos: <?php echo ($movieList["results"][1]["vote_average"]);?></div>
          <p class="card-text mb-auto"><strong>Descripcion:</strong> <?php echo ($movieList["results"][0]["overview"]);?></p>
          <p class="card-text mb-auto"><strong>Popularidad:</strong> <?php echo ($movieList["results"][0]["popularity"]);?></p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>

        <div class="col-auto <!--d-none--> d-lg-block">   
        <?php echo ('<a href="movie.php?id="' . $movieList["results"][0]["id"] . '"> <img src="https://image.tmdb.org/t/p/w185' . $movieList["results"][0]["poster_path"] .  '"></a>'); ?>

        </div>

      </div>
    </div>
        <div class="col-md-12">

      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative color-pelis">
        
        <div class="col p-4 d-flex flex-column position-static text-white">
          <strong class="d-inline-block mb-2 text-primary"> Dia de estreno: <?php echo ($movieList["results"][0]["release_date"]);?></strong>
          <h3 class="mb-0">Titulo: <?php echo ($movieList["results"][1]["title"]);?> </h3>
          <div class="mb-1 text-muted"> Promedio de votos: <?php echo ($movieList["results"][1]["vote_average"]);?></div>
          <p class="card-text mb-auto"><strong>Descripcion:</strong> <?php echo ($movieList["results"][1]["overview"]);?></p>
          <p class="card-text mb-auto"><strong>Popularidad:</strong> <?php echo ($movieList["results"][1]["popularity"]);?></p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>

        <div class="col-auto <!--d-none--> d-lg-block">   
        <?php echo ('<a href="movie.php?id="' . $movieList["results"][1]["id"] . '"> <img src="https://image.tmdb.org/t/p/w185' . $movieList["results"][1]["poster_path"] .  '"></a>'); ?>

        </div>

      </div>
    </div>

</div>