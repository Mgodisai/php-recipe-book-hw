<?php
require_once(DIR_CLASS."/upload.php");

if(isset($_POST['cat_add'])){
   $data=array();
   $data['cat_title']=strip_tags($_POST['cat_title']==''?null:$_POST['cat_title']);
   $data['cat_desc']=strip_tags($_POST['cat_desc']);

   if ($_FILES['cat_image']['error'] == 0) {
      $image=strip_tags($_FILES['cat_image']);
   } else {
      $image = null;
      $data['cat_image'] = "default_cat.png";
   }

   $is_title_unique = get_category_by_title($data['cat_title']);
   if (count($is_title_unique)!=0) {
      $data['error'] = "Már van ilyen kategória";
   } else {
      if (isset($image)) {
         $uploaded = image_upload($image);

         if ($uploaded['success']===true) {
            $data['cat_image'] = $uploaded['filename'];
            $data['message'] = $uploaded['message'];
         } else {
            $data['error'] = $uploaded['message'];
         }
      } else {
         $data['cat_image'] = "default_cat.png";
      }
      $res=add_category($data);

      if($res<0) {
         if ($data['cat_title']=='') {
            $data['error'] = "Nem adtál meg címet, kötelező!";
         } else {
            $data['error'] = "adatbázis hiba";
         }
      } else {
         $data['message'] = "\"".$data['cat_title']."\" sikeresen hozzáadva";
      }
   }
}
?>
<div class="row mt-3">
   <div class="col-md-6">
      <h5><span class="badge bg-secondary mb-3">Új kategória hozzáadása</span></h5>
   </div>
   <div class="col-md-6">
      <span class="float-end"><a href="?f=category-list">Vissza a listához<i class="fas fa-long-arrow-alt-right"></i></a></span>
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
   <?php } ?>

   <form class="needs-validation" method="post" enctype="multipart/form-data" action="">
      <div class="mb-3">
         <label for="cat_title" class="form-label">Cím</label>
         <input type="text" class="form-label" name="cat_title" value="<?=isset($data['cat_title'])?$data['cat_title']:"" ?>"</input>
         <div class="invalid-feedback">Adj meg egy kategória címet!</div>
      </div>
      <div class="mb-3">
         <label for="cat_desc" class="form-label">Kategória rövid leírása</label>
         <textarea class="form-control" name="cat_desc" placeholder="Leírás"></textarea>
         <div class="invalid-feedback">
            Adj meg egy rövid leírást
         </div>
      </div>
      <div class="mb-3">
         <div class="mb-3">
            <label for="fileSelect">Fájlnév:</label>
            <input class="btn btn-outline-primary" type="file" name="cat_image">

            <p><strong>Megjegyzés: </strong>Kiterjesztések: .jpg, .jpeg, .gif, .png, Max méret: 5 MB.</p>
         </div>
      </div>
      <div class="mb-3">
         <button class="btn btn-primary" type="submit" name="cat_add">Hozzáad</button>
      </div>
   </form>
</div>
