<?php
   $selected_cat=-1;
if (isset($_POST['category'])) {
   $selected_cat = $_POST['category'];

   if ($selected_cat=="") {
      $recipes=get_all_recipe();
   } else {
         $recipes=get_all_recipe_by_cat_front($selected_cat);
   }
} else {
   $recipes=get_all_recipe();
}

$totalRecipe=count($recipes);
?>


<div class="card card-default p-2 pt-4">
   <div class="card-heading row">
      <div class="col-md-6">
         <h5>Receptek&nbsp;<span class="badge bg-secondary"><?=$totalRecipe?></span></h5>
      </div>
      <div class="col-md-6">
         <span class="float-end"><a href="?f=new-recipe">Új recept <i class="fas fa-long-arrow-alt-right"></i></a></span>
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

   <form method="POST" action="">
   <select class="form-control text-white bg-dark" name="category" onchange="this.form.submit()">
      <option value="">Összes</option>
      <?php
      $categories=get_all_category();
      if(!is_null($categories) && !empty($categories)){
         foreach($categories as $category){
            ?>
            <option value="<?= $category['id']; ?>" <?= $selected_cat==$category['id']?"selected":""?>     > <?=$category['title'] ?></option>
            <?php
         }
      }
      ?>
   </select>
   </form>
</div>
   <table class="table table-bordered table-hover">
      <thead>
         <tr>
            <th>Kategória</th>
            <th>Név</th>
            <th>Leírás</th>
            <th>Kép</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if(!is_null($recipes) && !empty($recipes)){
            foreach($recipes as $recipe){
               $categoryDetail=get_category_by_id($recipe['category_id'])[0];

               ?>
               <tr>
                  <td><?php echo $categoryDetail['title']; ?></td>
                  <td><?php echo $recipe['title']; ?></td>
                  <td><?php echo $recipe['description']; ?></td>
                  <td><img src="<?php echo DIR_ADMIN_UPLOAD.$recipe['img']; ?>" width="100" /></td>
                  <td>
                     <a href="?f=recipe-edit&rid=<?php echo $recipe['id']; ?>" title="Szerkesztés" class="text-blue"><i class="fa fa-pen"></i></a>&nbsp;
                     <a onclick="return confirm('Biztos, hogy törölni akarod?')" href="?f=recipe-delete&rid=<?php echo $recipe['id']; ?>" title="Törlés" class="text-red"><i class="fa fa-times red-icon"></i></a>
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
