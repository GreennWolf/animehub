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
$actualReports = $_POST['actualReports'];

$newReport = $actualReports + 1;

$sql = "SELECT * FROM cuentas WHERE username = '$username'";
$result = $conexion ->query($sql);
$campo = mysqli_fetch_assoc($result);

$idcuenta = $campo['idcuenta'];

$sql2 = "SELECT * FROM reportes WHERE idcuenta = '$idcuenta'";
$result2 = $conexion ->query($sql2);
$campo2 = mysqli_fetch_assoc($result2);


$sql3 = "SELECT * FROM comentarios WHERE idcomentario = '$idcomentario'";
$result3 = $conexion ->query($sql3);
$campo3 = mysqli_fetch_assoc($result3);

$newReport = $campo3['reportes'] + 1;
$unReport = $campo3['reportes'] - 1;

if($username != ''){
    
    if ($idcuenta == $campo2['idcuenta']) {
        $query = "DELETE FROM reportes WHERE idcomentario = '$idcomentario' AND idcuenta = '$idcuenta'";
        $result = mysqli_query($conexion,$query);

        $q = "UPDATE comentarios SET reportes='$unReport' WHERE idcomentario = '$idcomentario'";
        $resultado = mysqli_query($conexion,$q);

        if ($resultado)
        {
            echo 'Tu reporte fue eliminado';
        } else 
        {
            echo 'Hubo un error al eliminar tu reporte';
        }
    } else {
        
    $query = "INSERT INTO reportes (idcomentario,idcuenta)  VALUES ('$idcomentario' , '$idcuenta') ";
    $result = mysqli_query($conexion,$query);

    $q = "UPDATE comentarios SET reportes='$newReport' WHERE idcomentario = '$idcomentario'";
    $resultado = mysqli_query($conexion,$q);

    if ($resultado)
    {
        echo 'Se envio tu reporte con exito';
    } else 
    {
        echo 'Hubo un error al enviar tu reporte';
    }
    }



}else{
    echo "Debes iniciar sesion para reportar";
}













?>