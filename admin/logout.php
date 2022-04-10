<?php
session_start();
session_destroy();
session_start();
$_SESSION['message'] = "Sikeres kilépés!";
header('Location: index.php');
?>
