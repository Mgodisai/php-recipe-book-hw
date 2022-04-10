

<div class="row">
   <div class="col-2">
   </div>
   <div class="bg-white p-4 p-lg-5 col-8">
      <h2 class="mb-1 text-dark mb-4">Admin belépés</h2>
      <form action="auth.php" method="POST" class="needs-validation" novalidate>

         <?php
         if(isset($_SESSION["error"])){
            $error = $_SESSION["error"];
            ?>
            <div class="alert alert-danger" role="alert"><?=$error?></div>
            <?php
         } else if(isset($_SESSION["message"])){
            $message = $_SESSION["message"]; ?>
            <div class="alert alert-success" role="alert"><?=$message?></div>
         <?php } ?>

         <div class="mb-4">
            <label class="visually-hidden" for="email">Email</label>
            <div class="input-group">
               <div class="input-group-text"><i class="fa fa-envelope"></i></div>
               <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="email form-control" id="email" name="email" placeholder="test@example.com" value="<?=isset($_SESSION['email'])?$_SESSION['email']:""?>">
               <div class="valid-feedback feedback-pos">Rendben</div>
               <div class="invalid-feedback feedback-pos">Töltse ki a mezőt!</div>

            </div>
         </div>
         <div class="mb-4">
            <label class="visually-hidden" for="password">Jelszó</label>
            <div class="input-group">
               <div class="input-group-text"><i class="fa fa-key"></i></div>
               <input type="password" class="form-control" id="password" name="password">
               <div class="valid-feedback feedback-pos">Rendben</div>
               <div class="invalid-feedback feedback-pos">Töltse ki a mezőt!</div>
            </div>
         </div>
         <button type="submit" class="btn btn-primary">Belépés</button>
      </form>
      <?php
      unset($_SESSION["message"]);
      unset($_SESSION["error"]);
      unset($_SESSION["email"]);
      ?>
   </div>
   <div class="col-2">
   </div>
</div>
