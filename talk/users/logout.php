<?php
session_start();
session_destroy();
unset($_SESSION);
setcookie('Auth', md5($username) , time() -3600);
setcookie('admin', md5($username) , time() -3600);
header('Location:../index.php');
?>