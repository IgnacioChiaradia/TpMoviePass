<?php require_once(VIEWS_PATH."nav.php");?>
<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center text-white">
               <h2>Welcome to Movie Pass</h2>
          </header>
          <form action="<?php echo FRONT_ROOT ?>User/login" method="POST" class="login-form bg-light-alpha p-5 text-dark font-weight-bold">
               <div class="form-group">
               <?php if(isset($message)){ ?>
                    <label for=""> <strong> <?php echo $message ?></strong> </label>
               <?php } ?>
               </br>
                    <label for="">User Name</label>
                    <input type="text" name="userName" class="form-control form-control-lg" placeholder="Enter User Name">
               </div>
               <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password">
               </div>
               
               <button class="btn btn-primary btn-block btn-lg mt-4" type="submit">Sign In</button>
          </form>
          <form action="<?php echo FRONT_ROOT?>User/register" method="POST" class="login-form bg-light-alpha p-5 text-dark font-weight-bold">
          <div class="form-group">
              <a class="btn btn-primary btn-block btn-lg " href="<?php echo FRONT_ROOT ?>Home/register">Sign Up</a>
          </div>
     </form>      
     </div>  
</main>
