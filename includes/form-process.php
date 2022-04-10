<?php
$error = "";
$secret = '6Le8N8oUAAAAAOtxV3f1mpMYcRWI_KX-b9gk8xKe';
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=" . $_POST['g-recaptcha-response'];
$verify = json_decode(file_get_contents($url));
if (!$verify->success) {
   $error = "Nem megfelelő a captcha";
   $message = $error;
}

if ($error == "") {
   $mailTo = "mgodisai@gmail.com";
   $mailSubject = "üzenet a kapcsolat űrlapról";
   $mailBody = "";
   foreach ($_POST as $k => $v) {
      if ($k != "g-recaptcha-response") {
         $mailBody .= "$k: $v\r\n";
      }
   }
   if (!@mail($mailTo, $mailSubject, $mailBody)) {
      $error = "Az üzenet elküldése nem sikerült a címzettnek!";
   }

   if ($error == "") {
      $message = "Az üzenet elküldése sikeres, irány a főoldal!";
   } else {
      $message = $error;
   }

}
echo '<script type="text/javascript">';
echo 'alert("' . $message . '");';
echo 'window.location.href = "index.php";';
echo '</script>';
?>
