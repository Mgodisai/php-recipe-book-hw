<?php
	if(isset($_GET['catid'])){
		$catid=(int)$_GET['catid'];
		$res=delete_category($catid);
		if($res){
			$_SESSION['message']='A törlés sikerült!';
		}else{
			$_SESSION['error']='A törlés nem sikerült';
		}
      header("location:index.php?f=category-list");
	}
?>
