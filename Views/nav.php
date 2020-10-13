<style>
body {
    font-family: "Segoe UI", sans-serif;
    font-size:100%;
}

.sidebar {
    position: fixed;
    height: 100%;
    width: 0;
    top: 0;
    left: 0;
    z-index: 1;
    background-color: #18277a;
    overflow-x: hidden;
    transition: 0.4s;
    padding: 1rem 0;
    box-sizing:border-box;
}

.sidebar .boton-cerrar {
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    font-size: 2rem;
    display: block;
    padding: 0;
    line-height: 1.5rem;
    margin: 0;
    height: 32px;
    width: 32px;
    text-align: center;
    vertical-align: top;
}

.sidebar ul, .sidebar li{
    margin:0;
    padding:0;
    list-style:none inside;
}

.sidebar ul {
    margin: 4rem auto;
    display: block;
    width: 80%;
    min-width:200px;
}

.sidebar a {
    display: block;
    font-size: 120%;
    color: #eee;
    text-decoration: none;
    
}

.sidebar a:hover{
    color:#fff;
    background-color: #f90;

}

h1 {
    color:#f90;
    font-size:180%;
    font-weight:normal;
}
#contenido {
    transition: margin-left .4s;
    padding: 1rem;
}

.abrir-cerrar {
    color: #2E88C7;
    font-size:1rem;   
}

#abrir {
    
}
#cerrar {
    display:none;
}
</style>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a href="<?php echo FRONT_ROOT ?>" style="text-decoration: none;"><strong> Movie </strong> Pass Home</a>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/listCinema">Listar</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/addCineView">Agregar</a>
          </li>
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
<li><a href="#">Logout</a></li>
</ul>
</div>
<div id="contenido">
<h1>Menu MoviePass</h1>
<a id="abrir" class="abrir-cerrar" href="javascript:void(0)" onclick="mostrar()">Abrir menu</a><a id="cerrar" class="abrir-cerrar" href="#" onclick="ocultar()">Cerrar menu</a>
</div>
<script>
function mostrar() {
    document.getElementById("sidebar").style.width = "300px";
    document.getElementById("contenido").style.marginLeft = "300px";
    document.getElementById("abrir").style.display = "none";
    document.getElementById("cerrar").style.display = "inline";
}

function ocultar() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("contenido").style.marginLeft = "0";
    document.getElementById("abrir").style.display = "inline";
    document.getElementById("cerrar").style.display = "none";
}
</script>


