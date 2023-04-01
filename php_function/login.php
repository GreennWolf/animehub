<?php
session_start();
require_once "./conexion.php";
$username = $_POST['username'];
$pw = $_POST['pw'];

$sql = "SELECT * FROM cuentas WHERE username = '$username'";
$result = $conexion ->query($sql);
$fila = mysqli_fetch_assoc($result);

$pwhash = $fila['pw'];

if(password_verify($pw,$pwhash)){
    $_SESSION['username'] = $username;
    header("location:../index.php");
}else{
    unset($_SESSION['username']);
    $_SESSION['username'] = '';
    session_destroy();
    header("location:../index.php");
}




?>