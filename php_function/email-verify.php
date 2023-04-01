<?php 
    include_once "./conexion.php";
    $email=$_POST["email"];   
    // $username = $_POST['username'];

    foreach ($conexion->query('SELECT * from cuentas') as $row){

        
            
        if( $row['email'] == $email){
            echo "'El email ya existe";
            }else{
                echo "El mail no esta en uso";
            }

    }
?>