<?php
$page_function = array(
   "welcome" => "/welcome.php",
   "list" => "/recipe-list.php",
   "details" => "/recipe-details.php",
   "contact" => "/contact-form.php",
   "process" => "/form-process.php"
);

$page_admin_function = array(
   "welcome" => "/welcome.php",
   "recipe-list" => "/recipe-list.php",
   "recipe-edit" => "/recipe-form.php",
   "recipe-delete" => "/recipe-delete.php",
   "category-list" => "/category-list.php",
   "category-edit" =>"/category-edit.php",
   "category-delete" => "/category-delete.php",
   "new-recipe" => "/recipe-form.php",
   "new-category" => "/category-form.php",
   "user-list" => "/user-list.php",
   "back" => "/../",
   "admin" => "/admin",
   "logout" => "/logout.php"
);

$roles = array();

$roles['admin'] = array(
    "categories" => true,
    "recipes" => true,
    "users" => true
);

$roles['editor'] = array(
    "categories" => true,
    "recipes" => true,
    "users" => false
);

$roles['user'] = array(
    "categories" => false,
    "recipes" => false,
    "users" => false
);

$default_page = "/welcome.php";
$page_title = "Receptkönyv";
$page_admin_title = "Receptkönyv - Admin oldal";
$admin = "/admin";
define("DIR_INCLUDE", $_SERVER["DOCUMENT_ROOT"]."/includes");
define("DIR_CONFIG", $_SERVER["DOCUMENT_ROOT"]."/config");
define("DIR_CLASS", $_SERVER["DOCUMENT_ROOT"]."/class");
define("DIR_IMAGES", "/images");
define("DIR_ADMIN", $_SERVER["DOCUMENT_ROOT"].$admin);
define("DIR_ADMIN_PHP_UPLOAD", DIR_ADMIN."/upload/");
define("DIR_ADMIN_UPLOAD", "/admin/upload/");
define("DIR_ADMIN_INCLUDE", DIR_ADMIN."/includes");

?>
