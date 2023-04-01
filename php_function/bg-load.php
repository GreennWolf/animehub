<?php 
    require_once './conexion.php';


    $idbg = $_POST['idbg'];
    $idcuenta = $_POST['idcuenta'];

    $q = "UPDATE cuentas SET idbg='$idbg' WHERE idcuenta = '$idcuenta'";
    $resultado = mysqli_query($conexion,$q);

    if ($resultado)
    {
        echo 'funct';
    } else 
    {
        echo 'dont funct';
    }

?>