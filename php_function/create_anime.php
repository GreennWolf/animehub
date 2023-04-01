<?php
session_start();
require_once "./conexion.php";

$name = $_POST['name'];
$description = $_POST['description'];
$sinopsis = $_POST['sinopsis'];
$genero = $_POST['genero'];
$url = $_POST['url'];
$idbanner = $_POST['idbanner'];


$q = "INSERT INTO animes (name,description,sinopsis,genero,url,idbanner) VALUES ('$name','$description','$sinopsis','$genero','$url','$idbanner')";
$resultado = mysqli_query($conexion,$q);


if ($resultado)
{
    echo "<script> alert('Se subio con exito'); window.location = '../php/my-account.php' </script>";
} else 
{
    echo "<script> alert('Error'); window.location = '../php/my-account.php' </script>";
}

?>