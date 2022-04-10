<?php
$users=get_all_user();
$totalUser = count($users);
$columns = array_keys($users[0]);
$column = $column = isset($_GET['col']) && in_array($_GET['col'], $columns) ? $_GET['col'] : $columns[0];
$sort_order = isset($_GET['ord']) && strtolower($_GET['ord']) == 'desc' ? 'DESC' : 'ASC';

$direction = white_list($sort_order, ["ASC","DESC"], "Invalid ORDER BY direction");
$orderby = white_list($column, $columns, "Invalid field name");

$users = get_all_user_order_by($orderby, $direction);

$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $direction);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = 'class="highlight"';
?>

<div class="card card-default p-2 pt-4">
   <div class="card-heading row">
      <div class="col-md-6">
         <h5>Felhasználók&nbsp;<span class="badge bg-secondary"><?=$totalUser?></span></h5>
      </div>
   </div>
   <table class="table table-bordered table-hover">
      <thead class="bg-dark text-light">
         <tr>
            <th><a href="?f=<?=$_GET['f']?>&col=id&ord=<?=$asc_or_desc?>">Id<i class="<?=($column == 'id')?'fas fa-sort-'. $up_or_down:''?>"></i></a></th>
            <th><a href="?f=<?=$_GET['f']?>&col=username&ord=<?=$asc_or_desc?>">Felhasználónév<i class="<?=($column == 'username')?'fas fa-sort-'. $up_or_down:''?>"></i></a></th>
            <th><a href="?f=<?=$_GET['f']?>&col=email&ord=<?=$asc_or_desc?>">Email<i class="<?=($column == 'email')?'fas fa-sort-'. $up_or_down:''?>"></i></a></th>
            <th><a href="?f=<?=$_GET['f']?>&col=lastname&ord=<?=$asc_or_desc?>">Név<i class="<?=($column == 'lastname')?'fas fa-sort-'. $up_or_down:''?>"></i></a></th>
            <th><a href="?f=<?=$_GET['f']?>&col=role&ord=<?=$asc_or_desc?>">Szerepkör<i class="<?=($column == 'role')?'fas fa-sort-'. $up_or_down:''?>"></i></a></th>
            <th>Kép</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if(!is_null($users) && !empty($users)){
            foreach($users as $user){

               ?>
               <tr>
                  <td <?=$orderby=='id' ? $add_class : '' ?>><?php echo $user['id']; ?></td>
                  <td <?=$orderby=='username' ? $add_class : '' ?>><?php echo $user['username']; ?></td>
                  <td <?=$orderby=='email' ? $add_class : '' ?>><?php echo $user['email']; ?></td>
                  <td <?=$orderby=='lastname' ? $add_class : '' ?>><?php echo $user['lastname']." ".$user['firstname']; ?></td>
                  <td <?=$orderby=='role' ? $add_class : '' ?>><?php echo $user['role']; ?></td>
                  <td><img src="<?php echo DIR_ADMIN_UPLOAD.$user['img']; ?>" width="50" /></td>
               </tr>
               <?php
            }
         }else{
            $_SESSION['error'] = "Nincs adat";
         }
         unset($_SESSION["message"]);
         unset($_SESSION["error"]);
         ?>
      </tbody>
   </table>
</div>
