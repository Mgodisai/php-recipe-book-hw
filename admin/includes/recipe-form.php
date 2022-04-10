<?php
require_once(DIR_CLASS."/upload.php");
$Parsedown = new Parsedown();
$is_add = false;
$is_update = false;
$recipe = null;

if (isset($_GET['f']) && $_GET['f']=="new-recipe") {
   $is_add=true;
}
if (isset($_GET['f']) && $_GET['f']=="recipe-edit") {
   $is_update=true;
   if (isset($_GET['rid'])) {
      $recipe = get_recipe_by_id($_GET['rid']);
      if (!isset($recipe)) {
         die("nincs ilyen recept");
      }
   }

}

if(isset($_POST['addRec'])){
   $data=array();
   $data['category']=$_POST['category'];
   $data['title']=strip_tags($_POST['title']);
   $data['description']=strip_tags($_POST['description']);
   $data['instruction']=strip_tags($_POST['instruction']);
   $data['videourl']=strip_tags($_POST['videourl']);
   $data['cooking_time']=strip_tags($_POST['cooking_time']);
   $data['servings']=strip_tags($_POST['servings']);

   if ($_FILES['image']['error'] == 0) {
      $image=$_FILES['image'];
   } else {
      $image = null;
   }

   if (isset($image)) {
      $uploaded = image_upload($image);

      if ($uploaded['success']===true) {
         $data['image'] = $uploaded['filename'];
         $data['message'] = $uploaded['message'];
      } else {
         $data['error'] = $uploaded['message'];
      }
   } else {
      $data['image'] = (isset($_POST['image_old'])&&$_POST['image_old']!="")?$_POST['image_old']:"default_recipe.png";
   }
   if ($is_add) {
         $res = add_recipe($data);
   } else if ($is_update) {
      $res = update_recipe($data,$recipe['id']);
   }


   if($res<0) {
      if ($data['title']=='') {
         $data['error'] = "Nem adtál meg címet, kötelező!";
      } else {
         $data['error'] = "adatbázis hiba";
      }
   } else {
      $data['message'] = "\"".$data['title']."\"".($is_add?" sikeresen hozzáadva!":" frissítve");
      $_SESSION['message'] = $data['message'];
      header("Refresh:0");
   }
}
?>
<div class="row mt-3">
   <div class="col-md-6">
      <h5><span class="badge bg-secondary mb-3"><?= $is_add?"Új recept hozzáadása":"Recept szerkesztése"?></span></h5>
   </div>
   <div class="col-md-6">
      <span class="float-end"><a href="?f=recipe-list">Vissza a listához<i class="fas fa-long-arrow-alt-right"></i></a></span>
   </div>
   <?php
   if(isset($data["error"])){
      $error = $data["error"];
      ?>
      <div class="alert alert-danger" role="alert"><?=$error?></div>
      <?php
   } else if(isset($data["message"])){
      $message = $data["message"]; ?>
      <div class="alert alert-success" role="alert"><?=$message?></div>
      <?php }
      else if(isset($_SESSION["message"])){
         $message = $_SESSION["message"]; ?>
         <div class="alert alert-success" role="alert"><?=$message?></div>
   <?php
      unset($_SESSION["message"]);
   } ?>

   <form action="" method="post" enctype="multipart/form-data">
      <table class="table table-bordered">
         <tr>
            <th>Válassz kategóriát (*)</th>
            <td>
               <select class="form-control" name="category" required>
                  <option value="">--- Válassz kategóriát ---</option>
                  <?php
                  $categories=get_all_category();
                  if(!is_null($categories) && !empty($categories)){
                     foreach($categories as $category){
                        ?>
                        <option value="<?= $category['id']; ?>" <?=$is_add?"":(($category['id']==$recipe['category_id'])?"selected":"")?>><?=$category['title']; ?></option>
                        <?php
                     }
                  }
                  ?>
               </select>
            </td>
         </tr>
         <tr>
            <th>Cím (*)</th>
            <td><input type="text" name="title" class="form-control" value="<?=$is_add?"":$recipe['title']?>" required/></td>
         </tr>
         <tr>
            <th>Rövid leírás (*)</th>
            <td><textarea class="form-control" name="description" required><?=$is_add?"":$recipe['description']?></textarea></td>
         </tr>
         <tr>
            <th>Elkészítés (*)</th>
            <td><textarea class="form-control" rows="10" name="instruction" required><?=$is_add?"":$recipe['instruction']?></textarea></td>
         </tr>

         <tr <?=$is_add?"hidden":""?>>
            <th>Eredeti kép</th>
            <td><img src="<?php echo DIR_ADMIN_UPLOAD.$recipe['img']; ?>" width="75" />
            <input type="hidden" name="image_old" value="<?= isset($recipe['img'])?$recipe['img']:"" ?>" />
         </td>
         </tr>

         <tr>
            <th>Kép</th>
            <td><input type="file" name="image" /></td>
         </tr>
         <tr>
            <th>Video Url</th>
            <td><input type="text" name="videourl" class="form-control" value="<?=$is_add?"":$recipe['video_url']?>"/></td>
         </tr>
         <tr>
            <th>Idő (percben)</th>
            <td><input type="text" name="cooking_time" class="form-control" pattern="[0-9]+" value="<?=$is_add?"":$recipe['cooking_time']?>"/></td>
         </tr>
         <tr>
            <th>Adag</th>
            <td><input type="text" name="servings" class="form-control" value="<?=$is_add?"":$recipe['servings']?>" /></td>
         </tr>
         <tr>
            <td colspan="2">
               <input type="submit" class="btn btn-danger" value=<?=$is_add?"Hozzáad":"Frissít"?> name="addRec" />
            </td>
         </tr>
      </table>
   </form>
</div>
