<?php
require_once($_SERVER['DOCUMENT_ROOT']."/class/db_class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
$con = new DatabasePDO($dsn, $username, $password, $options);

function white_list(&$value, $allowed, $message) {
    if ($value === null) {
        return $allowed[0];
    }
    $key = array_search($value, $allowed, true);
    if ($key === false) {
        throw new InvalidArgumentException($message);
    } else {
        return $value;
    }
}


function get_all_recipe_front($start,$limit,$orderby, $direction){
   $res=array();
   global $con;
   $statement = "SELECT * FROM recipe ORDER BY `$orderby` $direction LIMIT ?, ?";
   $res = $con->Select($statement, [$start, $limit]);
   return $res;
}

function get_all_recipe(){
   $res=array();
   global $con;
   $statement = "SELECT * FROM recipe ORDER BY id DESC";
   $res = $con->Select($statement, []);
   return $res;
}

function get_latest_recipes($limit){
   $res=array();
   global $con;
   $statement = "SELECT id,title,description,img, views, created, cooking_time, category_id FROM recipe ORDER BY id DESC LIMIT ?";
   $res = $con->Select($statement, [$limit]);
   return $res;
}

function get_latest_recipes_by_category($category_id){
   $res=array();
   global $con;
   $statement = "SELECT created FROM recipe WHERE category_id=? ORDER BY created DESC LIMIT 1";
   $res = $con->Select($statement, [$category_id]);
   return $res;
}

function get_popular_recipes($limit){
   $res=array();
   global $con;
   $statement = "SELECT id,title,description,img,views,created, cooking_time, category_id FROM recipe ORDER BY views DESC LIMIT ?";
   $res = $con->Select($statement, [$limit]);
   return $res;
}

function get_recipe_by_id($id){
   $res=array();
   global $con;
   $statement = "SELECT * FROM recipe WHERE id=?";
   $res = $con->Select($statement, [$id]);
   return count($res)==0?null:$res[0];
}

function get_all_recipe_by_cat($catid,$start,$limit, $orderby, $direction){
   $res=array();
   global $con;
   $statement = "SELECT * FROM recipe WHERE category_id=? ORDER BY `$orderby` $direction LIMIT ?, ?";
   $res = $con->Select($statement, [$catid, $start, $limit]);
   return $res;
}

function get_all_recipe_by_cat_front($catid){
   $res=array();
   global $con;
   $statement = "SELECT * FROM recipe WHERE category_id=? ORDER BY created";
   $res = $con->Select($statement, [$catid]);
   return $res;
}

function count_recipe(){
   global $con;
   $statement = "SELECT COUNT(*) as total FROM recipe";
   $res = $con->Select($statement, []);
   return $res[0]['total'];
}

function count_recipe_by_cat($catid){
   global $con;
   $statement = "SELECT COUNT(*) as total FROM recipe WHERE category_id=?";
   $res = $con->Select($statement, [$catid]);
   return $res[0]['total'];
}

function get_recipe_views($id){
   $res=array();
   global $con;
   $statement = "SELECT views FROM recipe WHERE id=?";
   $res = $con->Select($statement, [$id]);
   return $res[0]["views"];
}

function update_recipe_views($id,$views){
   $res=array();
   global $con;
   $statement = "UPDATE recipe SET views=? WHERE id=?";
   $res = $con->Update($statement, [$views, $id]);
   return $views;
}

function get_all_category(){
   $res=array();
   global $con;
   $statement="SELECT * FROM category";
   $res = $con->Select($statement, []);
   return $res;
}

function get_category_by_id($id){
   $res=array();
   global $con;
   $statement = "SELECT * FROM category WHERE id=?";
   $res = $con->Select($statement, [$id]);
   return $res;
}

function get_category_by_title($str){
   $res=array();
   global $con;
   $statement = "SELECT * FROM category WHERE title=?";
   $res = $con->Select($statement, [$str]);
   return $res;
}

function search_data($str,$start,$limit, $orderby, $direction){
   $res=array();
   global $con;
   $statement = "SELECT * FROM recipe WHERE title LIKE CONCAT('%', ?, '%') or description LIKE CONCAT('%', ?, '%') ORDER BY `$orderby` $direction LIMIT ?, ?";
   $res = $con->Select($statement, [$str, $str,$start, $limit]);
   return $res;
}

function search_data_count($str){
   $res=array();
   global $con;
   $statement = "SELECT count(*) as total FROM recipe WHERE title LIKE CONCAT('%', ?, '%') or description LIKE CONCAT('%', ?, '%')";
   $res = $con->Select($statement, [$str, $str]);
   return $res[0]['total'];
}

function check_user($str) {
   $res=array();
   global $con;
   $statement = "SELECT id, password FROM users WHERE email = ?";
   $res = $con->Select($statement, [$str]);
   return $res;
}

function get_user_by_id($id) {
   $res=array();
   global $con;
   $statement = "SELECT email, firstname, lastname, role, username,img FROM users WHERE id = ?";
   $res = $con->Select($statement, [$id]);
   return $res[0];
}


function get_all_user() {
   $res=array();
   global $con;
   $statement = "SELECT id, email, firstname, lastname, role, username, img FROM users";
   $res = $con->Select($statement, []);
   return $res;
}

function get_all_user_order_by($orderby, $direction) {
   $res=array();
   global $con;
   $statement = "SELECT id, email, firstname, lastname, role, username, img FROM users ORDER BY `$orderby` $direction";
   //$statement = $db->prepare($statement);
   $res = $con->Select($statement, []);
   return $res;
}

function add_category($data){
   $res=array();
   global $con;
   $title=$data['cat_title'];
   $desc=$data['cat_desc'];
   $img=$data['cat_image'];
   $statement = "INSERT INTO category (title,description,image) VALUES (?,?,?)";

   try {
      $res = $con->insert($statement, [$title, $desc, $img]);
   } catch(Exception $e){
      $res=-1;
      return $res;
   }
   return $res;
}

function delete_category($id){
   $res=true;
   global $con;
   $statement = "DELETE FROM category WHERE id=?";
   try {
      $con->remove($statement, [$id]);
   } catch(Exception $e){
      $res = false;
   }
   return $res;
}

function delete_recipe($id){
   $res=true;
   global $con;
   $statement = "DELETE FROM recipe WHERE id=?";
   try {
      $con->remove($statement, [$id]);
   } catch(Exception $e){
      $res = false;
   }
   return $res;
}

function update_category($data,$id){
   $res=1;
   global $con;
   $title=$data['cat_title'];
   $desc=$data['cat_desc'];
   $img=$data['cat_image'];
   $statement = "UPDATE category SET title=?, description=?,image=? WHERE id=?";
   try {
      $con->update($statement, [$title, $desc, $img, $id]);
   } catch(Exception $e){
      $res=-1;
      return $res;
   }
   return $res;
}

function add_recipe($data){
   $res=array();
   global $con;
   $category=$data['category'];
   $title=$data['title'];
   $desc=$data['description'];
   $inst=$data['instruction'];
   $videourl=$data['videourl'];
   $img=$data['image'];
   $cooking_time=$data['cooking_time'];
   $servings=$data['servings'];
   $statement = "INSERT INTO recipe (category_id,title,description,instruction,video_url,img, cooking_time, servings ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   try {
      $res = $con->insert($statement, [$category, $title, $desc, $inst, $videourl, $img, $cooking_time, $servings]);
   } catch(Exception $e){
      $res=-1;
      return $res;
   }
   return $res;
}

function update_recipe($data,$id){
   $res=1;
   global $con;
   $category=$data['category'];
   $title=$data['title'];
   $desc=$data['description'];
   $inst=$data['instruction'];
   $videourl=$data['videourl'];
   $img=$data['image'];
   $cooking_time=$data['cooking_time'];
   $servings=$data['servings'];
   $statement = "UPDATE recipe SET category_id=?, title=?, description=?, instruction=?, video_url=?, img=?, cooking_time=?, servings=? WHERE id=?";
   try {
      $con->update($statement, [$category, $title, $desc, $inst, $videourl, $img, $cooking_time, $servings, $id]);
   } catch(Exception $e){
      $res=-1;
      return $res;
   }
   return $res;
}


?>
