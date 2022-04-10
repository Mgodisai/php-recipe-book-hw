<?php if (isset($_SESSION['role'])) {
   $role = $roles[$_SESSION['role']];

} else {
   $role = $roles['user'];
}
?>
<header>
   <!-- Fixed navbar -->
   <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark rounded-top rounded-2">
      <div class="container-fluid w-75">
         <a class="navbar-brand" href="#">Admin oldal</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
               <li <?=$role['categories']?"":"hidden"?> class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategóriák</a>

                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <li><a class="dropdown-item" href="index.php?f=category-list">Lista</a></li>
                     <li><a class="dropdown-item" href="index.php?f=new-category">Új kategória</a></li>
                  </ul>
               </li>
               <li <?=$role['recipes']?"":"hidden"?> class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Receptek</a>

                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <li><a class="dropdown-item" href="index.php?f=recipe-list">Lista</a></li>
                     <li><a class="dropdown-item" href="index.php?f=new-recipe">Új recept</a></li>
                  </ul>





                  <li <?=$role['users']?"":"hidden"?> class="nav-item"><a class="nav-link" href="index.php?f=user-list">Felhasználók</a></li>
                  <li class="nav-item"><a class="nav-link incl-content" href="../index.php" tabindex="-1" aria-disabled="true">Vissza a főoldalra</a></li>
               </ul>

            </div>
         </div>
      </nav>
   </header>
