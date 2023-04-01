<?php 
    require_once './conexion.php';


    $idicono = $_POST['idicono'];
    $idcuenta = $_POST['idcuenta'];

    $q = "UPDATE cuentas SET idicono='$idicono' WHERE idcuenta = '$idcuenta'";
    $resultado = mysqli_query($conexion,$q);

    if ($resultado)
    {
        echo 'funct';
    } else 
    {
        echo 'dont funct';
    }

?>