<div class="card border-info mb-3 p-2">
   <div class="card-header bg-info text-light">User adatok</div>
   <div class="card-body">
      <p class="card-text">
         <i class="fa fa-user fa-fw"></i>&nbsp;<?=$_SESSION['user']['username']." (".$_SESSION['user']['lastname']." ".$_SESSION['user']['firstname'].")"?>
      </p>
      <p class="card-text">
         <i class="fa fa-user-cog fa-fw"></i>&nbsp;<?=$_SESSION['user']['role']?>
      </p>
      <p class="card-text">
         <i class="fa fa-envelope"></i>&nbsp;<?=$_SESSION['user']['email']?>
      </p>
      <p>
         <img src="/admin/upload/<?= $_SESSION['user']['img'] ?>" class="mx-auto d-block w-75"/>
      </p>
      <p class="card-text text-secondary">
         <a class="link link-primary" href="/admin/logout.php">Logout from page</a>

      </p>
   </div>
</div>
