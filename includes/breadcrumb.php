<?php
$f="list";
if(isset($_GET['q'])){
   $first_level_link = "index.php?f=".$f."&q=".$_GET['q'];
   $first_level_string = "Eredmény";
} else {
   $first_level_link = "index.php?f=".$f;
   $first_level_string = "Összes";
}
$first_level_list_element =
"<li class='breadcrumb-item'><a href=".$first_level_link.">".$first_level_string."</a></li>";

if(isset($_GET['catid'])) {
   $second_level_tag = "&catid=".$_GET['catid'];
   $second_level_link = $first_level_link.$second_level_tag;
   $second_level_string = get_category_by_id($_GET['catid'])[0]['title'];
   $second_level_list_element =
   "<li class='breadcrumb-item'><a href=".$second_level_link.">".$second_level_string."</a></li>";
} else {
   $second_level_tag = "";
   $second_level_list_element = "";
}

if(isset($_GET['rid'])) {
   $p=3;
   $third_level_tag = "&rid=".$_GET['rid'];
   $third_level_link = "index.php?f=".$p.$second_level_tag.$third_level_tag;
   $third_level_string = get_recipe_by_id($_GET['rid'])['title'];
   $third_level_list_element =
   "<li class='breadcrumb-item'><a href=".$third_level_link.">".$third_level_string."</a></li>";
} else {
   $third_level_link="";
   $third_level_list_element = "";
}
?>

<div class="alert alert-dark p-0 pt-2 ps-2" role="alert">
   <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
         <?php
         echo $first_level_list_element;
         echo $second_level_list_element;
         echo $third_level_list_element;
         ?>

      </ol>
   </nav>
</div>
