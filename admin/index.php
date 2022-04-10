<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/config/constants.php');
require_once(DIR_CLASS."/Parsedown.php");
require_once(DIR_CLASS.'/func.php');
require_once(DIR_CLASS.'/upload.php');
?>

<!DOCTYPE html>
<html lang="hu" class="h-100">
<?php include(DIR_ADMIN_INCLUDE.'/head.php') ?>
<body class="d-flex flex-column h-100">
   <!-- html header tag include with navigation -->
   <?php include(DIR_ADMIN_INCLUDE.'/header.php') ?>
   <!-- Begin page content -->
   <main class="flex-shrink-0">
      <div class="container">
         <div class="row">
            <!-- main content -->
            <div class="col-md-8 mx-2 rounded rounded-5 bordered bg-light" id="main-content">
               <?php
               if (!isset($_SESSION['loggedin'])) {
                   include(DIR_ADMIN.'/login.php');
               } else {

                  if (isset($_GET['f'])) {
                     $function = $_GET['f'];
                  } else {
                     $function = null;
                  }
                  if (array_key_exists($function, $page_admin_function)){
                        include(DIR_ADMIN_INCLUDE.$page_admin_function[$function]);
                  } else {
                     include(DIR_ADMIN_INCLUDE.$default_page);
                  }

               }


               ?>
            </div>
            <!-- right side content -->
            <div class="col-md-3">
               <div class="row">
                  <?php
                  if (isset($_SESSION['loggedin'])) {
                   include(DIR_ADMIN_INCLUDE.'/card_user.php');
                }
                   ?>
               </div>
            </div>

         </div>
      </div>
   </main>
   <!-- footer html tag include -->
   <?php include(DIR_ADMIN_INCLUDE.'/footer.php') ?>
</body>
</html>
