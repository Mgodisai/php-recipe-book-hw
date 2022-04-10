<?php
$orders = [
   "title-DESC"=>"ABC csökkenő",
   "title-ASC"=>"ABC növekvő",
   "created-DESC"=>"Beküldés ideje újabb",
   "created-ASC"=>"Beküldés ideje régebbi",
   "views-DESC"=>"Nézettség csökkenő",
   "views-ASC"=>"Nézettség növekvő"
];
$_SESSION['orderby']=isset($_POST['orderby'])?$_POST['orderby']:(isset($_SESSION['orderby'])?$_SESSION['orderby']:"views-DESC");

$orderby = explode("-", $_SESSION['orderby'])[0];
$direction =  explode("-", $_SESSION['orderby'])[1];


// pager
$limit=5;
if(!isset($_GET['page']) || $_GET['page']==1){
   $start=0;
}else{
   $start=($_GET['page']*$limit)-$limit;
}

// isset catid
if(isset($_GET['catid'])) {
   $category_id = $_GET['catid'];
} else {
   $category_id = -1;
}

// isset query string
if(isset($_GET['q'])){
   $query_string=$_GET['q'];
   $recipes = search_data($query_string,$start,$limit, $orderby, $direction);
   $totalRecipes=search_data_count($query_string,$start,$limit);
} else {
   if ($category_id >=0) {
      $recipes=get_all_recipe_by_cat($category_id,$start,$limit, $orderby, $direction);
      $totalRecipes = count_recipe_by_cat($category_id);
   } else {
      $totalRecipes = count_recipe();
      $recipes=get_all_recipe_front($start,$limit,$orderby, $direction);
   }
}
include(DIR_INCLUDE.'/breadcrumb.php');
?>
<div class="card ps-2 mb-2">
   <h6>Rendezés: <span class="badge bg-light text-dark">
<form action="" method="post" name="orderby" enctype="multipart/form-data">
      <select class="form-select form-select-sm" name="orderby" onchange="this-form-submit()">
         <?php
            foreach($orders as $order){
               $key = array_search($order, $orders);
               ?>
               <option value="<?=$key ?>" <?=$key==$_SESSION['orderby']?"selected":""?> > <?=$orders[$key] ?></option>
            <?php
         } ?>
      </select>
</form>
   </span></h6>
</div>

<?php
if ($category_id>0) {
   $category = get_category_by_id($category_id)[0];
   $latest_recipe_in_category = get_latest_recipes_by_category($category_id);
   if (count($latest_recipe_in_category)>0) {
      $latest_recipe_in_category = date_format(date_create($latest_recipe_in_category[0]['created']), "Y/m/d");
   } else {
      $latest_recipe_in_category = "Még nem érkezett recept ebben a kategóriában";
   }
   ?>
   <div class="card text-center p-2 mb-3">
      <div class="card-header">
         Kategóriák
      </div>
      <div class="card-body">
         <h5 class="card-title"><?=$category['title']?></h5>
         <p class="card-text"><?=$category['description']?></p>
         <img alt="<?= $category['title'] ?>" caption="<?= $category['title'] ?>" onClick="reply_click(this)" class="mx-auto d-block w-75" src="<?=DIR_ADMIN_UPLOAD.$category['image'] ?>" />
      </div>
      <div class="card-footer text-muted">
         Utolsó recept: <?=$latest_recipe_in_category ?>
      </div>
   </div>


   <?php
}
if(!is_null($recipes) && !empty($recipes)){
   foreach($recipes as $recipe){
      $recipe_category = get_category_by_id($recipe["category_id"])[0];
      ?>
      <div class="card mb-3">
         <div class="card-body">
            <div class="row">
               <div class="col-md-4">
                  <a href="index.php?f=details<?php echo "&rid=".$recipe['id']; echo $category_id>0?"&catid=".$category_id:""; ?>"
                     title="<?php echo $recipe['title']; ?>">
                     <img alt="<?php echo $recipe['title']; ?>" class="mx-auto d-block w-100" src="<?=DIR_ADMIN_UPLOAD.$recipe['img'] ?>" />
                  </a>
               </div>
               <div class="col-md-8">
                  <small>
                     <a class="link-secondary" href="index.php?f=list&catid=<?php echo $recipe_category['id']; ?>">
                        <?php echo $recipe_category['title']; ?>
                     </a>
                  </small>
                  <h4><a href="index.php?f=details<?php echo "&rid=".$recipe['id']; echo $category_id>0?"&catid=".$category_id:"" ?>"
                     title="<?php echo $recipe['title']; ?>"><?php echo $recipe['title']; ?></a></h4>

                     <p class="margin-top5">
                        <?php echo $recipe['description']; ?>
                     </p>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <div class="row">
                  <div class="col-md-3"><i class="fa fa-eye"></i>&nbsp;<?php echo $recipe['views']; ?></div>
                  <div class="col-md-3"><i class="fa fa-calendar"></i>&nbsp;<?php echo date_format(date_create($recipe['created']), "Y/m/d"); ?></div>
                  <div class="col-md-6">
                     <a href="index.php?f=details<?php echo "&rid=".$recipe['id']; echo $category_id>0?"&catid=".$category_id:"" ?>" class="text-primary">Részletek</a>
                  </div>
               </div>
            </div>
         </div>
         <?php
      }
   }
   ?>
   <ul class="pagination">
      <?php
      $links = ceil($totalRecipes/$limit);

      for($i=1; $i<=$links; $i++){
         if(isset($_GET['page']) && $_GET['page']==$i){
            $class='active';
         }else{
            if(!isset($_GET['page']) && $i==1){
               $class='active';
            }else{
               $class='';
            }
         }
         ?>
         <li class="<?php echo $class; ?> page-item">
            <a class="page-link" href="?f=list<?php echo isset($_GET['catid'])?"&catid=".$_GET['catid']:"";echo isset($_GET['q'])?"&q=".$_GET['q']:""; ?>&page=<?php echo $i; ?>"><?php echo $i;
            ?>
         </a></li>
         <?php
      }
      ?>
   </ul>
