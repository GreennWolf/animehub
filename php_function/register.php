<?php 
    require_once './conexion.php';

    if (isset($_POST["submit"]))
	{
		$email = $_POST["email"];
		$username = $_POST["username"];
		$pw = $_POST["pw"];
		$birthday = $_POST["birthday"];
		$mobile = $_POST["mobile"];
        $idicono = $_POST["idicono"];
		$hash = password_hash($pw, PASSWORD_DEFAULT,['cost'=> 15]);

		$accion = "INSERT INTO cuentas (email,username,pw,birthday,mobile,idicono) VALUES ('$email','$username','$hash','$birthday','$mobile','$idicono')";

		$resultado = mysqli_query($conexion,$accion);


		if ($resultado)
		{
			 header("location:../index.php");
		} else 
		{
			 echo "<script> alert('Hubo un problema'); </script>";
			 header("location:../php/register.php");
		}


	}
?>