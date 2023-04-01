<?php 
    include_once "./conexion.php";
    $username=$_POST["username"];   
    // $username = $_POST['username'];

    foreach ($conexion->query('SELECT * from cuentas') as $row){

    
        if($row['username'] == $username){
            echo "si";
        }else{
            echo "no";
        }

    }
?>