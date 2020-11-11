<?php require_once(VIEWS_PATH."nav.php");?>
<main class="py-5">
     <section id="register" class="mb-5">
          <div class="container">
               <h2 class="mb-4 text-white">Sign Up</h2>
               <?php if(isset($message)){ ?>
                    <label class="text-white" for=""> <strong> <?php echo $message ?> </strong> </label>
               <?php } ?>
               <label for=""></label>
               <form class="bg-light-alpha p-5" action="<?php echo FRONT_ROOT ?>User/register" method="POST">
                    <div class="row font-weight-bold">
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">User Name</label>
                                   <input type="Text" name="userName" value="" class="form-control" placeholder="User name" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="password" name="password" value="" class="form-control" placeholder="Password" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">First Name</label>
                                   <input type="Text" name="firstName" value="" class="form-control" placeholder="First Name" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Last Name</label>
                                   <input type="Text" name="lastName" value="" class="form-control" placeholder="Last name" required>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="" class="form-control" placeholder="Email" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Done</button>
               </form>
          </div>
     </section>
</main>
