<?php

session_start();

if(!isset($_SESSION['usuario'])){

header("Location: /ips_almavida/app/auth/login.php");

exit;

}