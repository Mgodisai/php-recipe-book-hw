<?php $recipes=get_popular_recipes(1); ?>
<div class="card border-primary mb-3 p-2">
   <div class="card-header bg-warning text-light">Legnézettebb recept</div>
   <div class="card-body">
      <h6 class="card-title">
         <a class="link-success" href="index.php?f=details&catid=<?= $recipes[0]['category_id'] ?>&rid=<?= $recipes[0]['id'] ?>">
            <?= $recipes[0]['title'] ?>
         </a>
      </h6>
      <p class="card-text">
         <?= $recipes[0]['description'] ?>
      </p>
      <p>
         <img src="<?= DIR_ADMIN_UPLOAD.$recipes[0]['img'] ?>" class="mx-auto d-block w-100"/>
      </p>
      <p class="card-text text-secondary">
         <small>
            <i class="fa fa-eye"> </i>
            <?= $recipes[0]['views'] ?>
         </small>
         <br>
         <small>
            <i class="fa fa-calendar"> </i>
            <?= date_format(date_create($recipes[0]['created']), "Y/m/d") ?>
         </small>
         <br>
         <small>
            <i class="fa fa-clock"> </i>
            <?= $recipes[0]['cooking_time']." perc" ?>
         </small>
      </p>
   </div>
</div>
