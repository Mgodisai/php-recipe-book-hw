<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/private/config.ini");
$dbhost = $config['dbhost'];
$dbname = $config['dbname'];
$username = $config['username'];
$password = $config['password'];
$dbcharset = $config['dbcharset'];
$dbport = $config['dbport'];
$options = [
   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
   PDO::ATTR_EMULATE_PREPARES   => false
];
$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=$dbcharset;port=$dbport";
?>
