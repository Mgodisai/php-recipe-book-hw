<div class="card border-warning p-2">
   <img src="<?= DIR_IMAGES ?>/cook-book.png" class="mx-auto d-block w-75"/>
   <div class="card-body">
      <h5 class="card-title">Kategóriák</h5>
      <p class="card-text">Jelenleg az alábbi kategóriákból választhatsz</p>
   </div>
   <ul class="list-group list-group-flush">
      <?php
      $categories=get_all_category();
      if(true){
         foreach($categories as $category){
            ?>
            <li class="list-group-item">
               <a href="index.php?f=list&catid=<?php echo $category['id']; ?>" >
                  <?php
                     echo $category['title']." (";
                     echo count_recipe_by_cat($category['id']);
                     echo ")";
                  ?>
               </a>
            </li>
            <?php
         }
      }
      ?>
   </ul>
</div>
