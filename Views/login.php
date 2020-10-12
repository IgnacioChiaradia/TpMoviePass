
<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center text-white">
               <h2>Bienvenido a Movie Pass</h2>
          </header>
          <form action="<?php FRONT_ROOT ?>Cinema/addCineView" method="POST" class="login-form bg-light-alpha p-5 text-dark font-weight-bold">
               <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" name="" class="form-control form-control-lg" placeholder="Ingresar usuario">
               </div>
               <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="" class="form-control form-control-lg" placeholder="Ingresar constraseña">
               </div>
               <button class="btn btn-primary btn-block btn-lg mt-4" type="submit">Iniciar Sesión</button>
          </form>
     </div>
</main>
