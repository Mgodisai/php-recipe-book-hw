<?php
	if(isset($_GET['rid'])){
		$rid=(int)$_GET['rid'];
		$res=delete_recipe($rid);
		if($res){
			$_SESSION['message']='A törlés sikerült!';
		}else{
			$_SESSION['error']='A törlés nem sikerült';
		}
      header("location:index.php?f=recipe-list");
	}
?>
