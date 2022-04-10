<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/config/constants.php');
require_once(DIR_CLASS."/func.php");
require_once(DIR_CLASS."/Parsedown.php");
$Parsedown = new Parsedown();

?>
<!DOCTYPE html>
<html lang="hu" class="h-100">
<!-- head html tag include -->
<?php include(DIR_INCLUDE.'/head.php') ?>

<body class="d-flex flex-column h-100">
   <div id="modalWindow" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" src="" id="placeHolderImage" alt="">
<div id="caption"></div>
   </div>
   <!-- html header tag include with navigation -->
   <?php include(DIR_INCLUDE.'/header.php') ?>
   <!-- Begin page content -->
   <main class="flex-shrink-0">
      <div class="container">
         <div class="row mt-3">
            <!-- left side content -->
            <div class="col-md-2">
               <div class="row">
                  <?php include(DIR_INCLUDE.'/card_cat.php') ?>
               </div>
            </div>
            <!-- main content -->
            <div class="col-md-6 mx-2 rounded rounded-5 bg-light main-content" id="main-content">
               <?php
               if (isset($_GET['f'])) {
                  $function = $_GET['f'];
               } else {
                  $function = null;
               }
               if (array_key_exists($function, $page_function)){
                     include(DIR_INCLUDE.$page_function[$function]);
               } else {
                  include(DIR_INCLUDE.$default_page);
               }
               ?>
            </div>
            <!-- right side content -->
            <div class="col-md-3">
               <?php if (isset($_SESSION['loggedin'])) { ?>

                  <div class="row"><?php include(DIR_ADMIN_INCLUDE.'/card_user.php') ?></div>

               <?php } ?>
               <div class="row">
                  <?php include(DIR_INCLUDE.'/card_newest.php') ?>
               </div>
               <div class="row">
                  <?php include(DIR_INCLUDE.'/card_pop.php') ?>
               </div>
            </div>
         </div>
      </div>
   </main>
   <!-- footer html tag include -->
   <?php include(DIR_INCLUDE.'/footer.php') ?>
</body>
</html>
