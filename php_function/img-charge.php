<?php 
    require_once './conexion.php';
    echo 'Welcome';

    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if($revisar !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));
        
        $accion = "INSERT INTO icons (img) VALUES ('$imgContenido')";

        $resultado = mysqli_query($conexion,$accion);


        if ($resultado)
        {
            header("location:../index.php");
        } else 
        {
                echo "<script> alert('Hubo un problema'); </script>";
                header("location:../index.php");
        }
        
    }else{
        echo 'Lolo';
    }
    
?>
