<?php
$categories=get_all_category();
$totalCategory=count($categories);
?>
<div class="card card-default p-2 pt-4">
   <div class="card-heading row">
      <div class="col-md-6">
         <h5>Kategóriák&nbsp;<span class="badge bg-secondary"><?=$totalCategory ?></span></h5>
      </div>
      <div class="col-md-6">
         <span class="float-end"><a href="?f=new-category">Új kategória <i class="fas fa-long-arrow-alt-right"></i></a></span>
      </div>
   </div>

   <div class="card-body">
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
      <table class="table table-bordered table-hover">
         <thead>
            <tr class="table-dark">
               <th>Cím</th>
               <th>Leírás</th>
               <th>Kép</th>
               <th>Műveletek</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if(!is_null($categories) && !empty($categories)){
               foreach($categories as $category){
                  ?>
                  <tr>
                     <td><?php echo $category['title']; ?></td>
                     <td><?php echo $category['description']; ?></td>
                     <td><img src="<?= DIR_ADMIN_UPLOAD.$category['image'] ?>" width="70" /></td>
                     <td>
                        <a href="?f=category-edit&catid=<?php echo $category['id']; ?>" title="Szerkesztés" class="text-blue"><i class="fa fa-pen"></i></a>&nbsp;
                        <a onclick="return confirm('Biztos, hogy törölni akarod?')" href="?f=category-delete&catid=<?php echo $category['id']; ?>" title="Törlés" class="text-red"><i class="fa fa-times red-icon"></i></a>
                     </td>
                  </tr>
                  <?php
               }
            }else{
                  $_SESSION['error'] = "Nincs adat";
            }
            unset($_SESSION["message"]);
            unset($_SESSION["error"]);
            ?>
         </tbody>
      </table>
   </div>
</div>
