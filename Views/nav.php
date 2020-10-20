
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a href="<?php echo FRONT_ROOT ?>Home/HomeView" style="text-decoration: none;"><strong> Movie </strong> Pass Home</a>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="#">Logout</a>
          </li>
     </ul>
</nav>

<div id="sidebar" class="sidebar">
  <a href="#" class="boton-cerrar" onclick="ocultar()">&times;</a>
    <ul class="menu">
      <li><a href="<?php echo FRONT_ROOT ?>Cinema/addCineView">Agregar cine</a></li>
      <li><a href="<?php echo FRONT_ROOT ?>Cinema/listCinema">Listar cines</a></li>
      <li><a href="<?php echo FRONT_ROOT ?>Movie/listMovies">Lista de peliculas</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
    <div id="contenido">
    <h1 class="intro">Menu MoviePass</h1>
        <a id="abrir" class="abrir-cerrar" href="javascript:void(0)" onclick="mostrar()">Abrir menu</a><a id="cerrar" class="abrir-cerrar" href="#" onclick="ocultar()">Cerrar menu</a>
  </div>


