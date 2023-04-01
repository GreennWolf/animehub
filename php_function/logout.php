<?php 
 require_once './login.php';
 unset($_SESSION['username']);
 $_SESSION['username'] = '';
 header("Location:../index.php");
 session_destroy();


?>