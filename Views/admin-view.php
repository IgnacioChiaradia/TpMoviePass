<?php
require_once(VIEWS_PATH."nav.php");
?>
<div id="contenido2" class="contenido">
	<article class="">
		<h1 class="intro">Bienvenido a la parte administrativa de MoviePass!</h1>
		<?php if(isset($message)){ ?>
          <div class="text-white ml-3 mb-1" for=""> <strong> <?php echo $message ?> </strong> </div>
  <?php } ?>  
		<p class="presentacion">Gracias por su participacion en este proyecto, se le presentaran varias opciones para la parte administrativa.</p>
		<p class="presentacion">Elija una opción del menu de navegación que se encuentra en el lateral izquierdo de la página para comenzar a utilizar el sistema.</p>
	</article>
</div>
