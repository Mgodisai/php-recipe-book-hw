<?php
include(DIR_INCLUDE."/breadcrumb.php");
if(isset($_GET['rid'])) {
   $recipe_id = $_GET['rid'];
   $recipe = get_recipe_by_id($recipe_id);
   $recipe_category = get_category_by_id($recipe["category_id"])[0];
   $category_id = $recipe_category['id'];
   $recipe_views = $recipe['views']+1;
   update_recipe_views($recipe_id, $recipe_views);
} else {
   $recipe_id = -1;
}
?>
<div class="card mb-3">
   <div class="card-body">
      <div class="row p-2">
         <small>
            <a class="link-secondary" href="index.php?f=list&catid=<?= $recipe['category_id'] ?>">
               <?= $recipe_category['title'] ?>
            </a>
         </small>
         <h3><a href="index.php?f=details<?php echo "&rid=".$recipe['id']; echo $category_id>0?"&catid=".$category_id:"" ?>"
            title="<?= $recipe['title'] ?>"><?= $recipe['title'] ?></a></h3>

            <p class="margin-top5"><strong>
               <?= $recipe['description'] ?>
            </strong>
         </p>
      </div>
      <div class="row p-2">
         <div class="accordion" id="instruction">
            <div class="accordion-item">
               <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     Instrukciók, hozzávalók
                  </button>
               </h2>
               <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#instruction">
                  <div class="accordion-body">
                     <?= $Parsedown->text($recipe['instruction']) ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row p-2">
         <!---
         <a href="index.php?f=details&rid=<?= $recipe['id'] ?>" title="<?= $recipe['title'] ?>">
         -->
            <img alt="<?= $recipe['title'] ?>" onClick="reply_click(this)" class="mx-auto d-block w-75" src="<?= DIR_ADMIN_UPLOAD.$recipe['img'] ?>" />
         <!--</a>-->
      </div>
      <?php if (strlen($recipe['video_url'])>0) { ?>

      <div class="row p-2">
         <p class="mt-1">
            <iframe class="mx-auto d-block" width="400" height="270"  src="<?= $recipe['video_url']; ?>" gesture="media" allow="encrypted-media" allowfullscreen>></iframe>
         </p>
      </div>
   <?php } ?>
   </div>
   <div class="card-footer">
      <div class="row p-3">

         <div class="col-md-3"><i class="fa fa-eye"></i>&nbsp;<?= $recipe_views ?></div>
         <div class="col-md-3"><i class="fa fa-clock"></i>&nbsp;<?= $recipe['cooking_time']." " ?>perc</div>
         <div class="col-md-3"><i class="fa fa-utensils"></i>&nbsp;<?= $recipe['servings'] ?></div>
         <div class="col-md-3"><i class="fa fa-calendar"></i>&nbsp;<?= date_format(date_create($recipe['created']), "Y/m/d") ?></div>

      </div>
   </div>
</div>
