<?php
// image upload function
function image_upload($image) {
   $res = array();

   if(isset($image) && $image["error"] == 0){
      $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
      $filename = $image["name"];
      $temp_filename = $image["tmp_name"];
      $rename = time()."_".$filename;
      $filetype = $image["type"];
      $filesize = $image["size"];


      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if(!array_key_exists($ext, $allowed)) {
         $res['message'] = "Hiba: Nem megfelelő fájlformátum";
         $res['success'] = false;
         return $res;
      }

      $maxsize = 5 * 1024 * 1024;
      if($filesize > $maxsize) {
         $res['message'] = "Hiba: A fájl nagyobb a megengedett méretnél (5MB)";
         $res['success'] = false;
         return $res;
      }

      if(in_array($filetype, $allowed)){

         if(file_exists("upload/".$rename)){
            $res['message'] = $rename . " már létezik";
            $res['success'] = false;
            return $res;
         } else{
            move_uploaded_file($image["tmp_name"], "upload/".$rename);
            $res['message'] = "Sikeres fájlfeltöltés";
            $res['success'] = true;
            $res['filename'] = $rename;
            return $res;
         }
      } else{
         $res['message'] = "Hiba: Probléma merült fel a feltöltés során, próbáld újra!";
         $res['success'] = false;
         return $res;
      }

   } else{
      $res['message'] = "Hiba: " . $image["error"];
      $res['success'] = false;
      return $res;
   }
   $res['message'] = "utolsó utáni hiba";
   $res['success'] = false;
   return $res;
}
?>
