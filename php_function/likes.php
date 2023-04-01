<?php 
session_start();
require './conexion.php';

error_reporting(0);

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $username = '';
}

$idcomentario = $_POST['idcomentario'];
$actuallikes = $_POST['actuallikes'];



$sql = "SELECT * FROM cuentas WHERE username = '$username'";
$result = $conexion ->query($sql);
$campo = mysqli_fetch_assoc($result);

$idcuenta = $campo['idcuenta'];

$sql2 = "SELECT * FROM likes WHERE idcuenta = '$idcuenta'";
$result2 = $conexion ->query($sql2);
$campo2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT * FROM comentarios WHERE idcomentario = '$idcomentario'";
$result3 = $conexion ->query($sql3);
$campo3 = mysqli_fetch_assoc($result3);

$newLikes = $campo3['likes'] + 1;
$unlike = $campo3['likes'] - 1;

if($username != ''){
    
    if ($idcuenta == $campo2['idcuenta']) {
        $query = "DELETE FROM likes WHERE idcomentario = '$idcomentario' AND idcuenta = '$idcuenta'";
        $result = mysqli_query($conexion,$query);

        $q = "UPDATE comentarios SET likes='$unlike' WHERE idcomentario = '$idcomentario'";
        $resultado = mysqli_query($conexion,$q);

        if ($resultado)
        {
            echo $unlike;
        } else 
        {
            echo $actuallikes;
        }
    } else {
        
        $query = "INSERT INTO likes (idcomentario,idcuenta)  VALUES ('$idcomentario' , '$idcuenta') ";
        $result = mysqli_query($conexion,$query);

        $q = "UPDATE comentarios SET likes='$newLikes' WHERE idcomentario = '$idcomentario'";
        $resultado = mysqli_query($conexion,$q);


        if ($resultado)
        {
            echo $newLikes;
        } else 
        {
            echo $actuallikes;
        }
    }



}else{
    echo "Debes iniciar sesion para dar like";
}











?>