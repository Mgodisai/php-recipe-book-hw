<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/config/constants.php');
require_once(DIR_CLASS.'/func.php');

if (!isset($_POST['email']) || strlen($_POST['email'])==0 ) {
   $_SESSION['error'] = "Nem adtál meg email címet!";
   header('Location: index.php');
   exit();
} else if (!isset($_POST['password']) || strlen($_POST['password'])==0) {
   $_SESSION['error'] = "Írd be a jelszót";
   $_SESSION['email'] = $_POST['email'];
   header('Location: index.php');
   exit();
}

$user = check_user($_POST['email']);

if (is_null($user) || empty($user)) {
   $_SESSION['error'] = "Nincs ilyen felhasználó!";
   header('Location: index.php');
   exit();
} else {
   $user = $user[0];
}

if (password_verify($_POST['password'], $user['password'])) {
   $auth_user = get_user_by_id($user['id']);
   session_regenerate_id();
   echo $auth_user['username'];
   $_SESSION['loggedin'] = true;
   $_SESSION['user'] = $auth_user;
   $_SESSION['role'] = $auth_user['role'];
   header('Location: index.php');

} else {
   $_SESSION['error'] = "Hibás jelszó!";
   header('Location: index.php');
}
