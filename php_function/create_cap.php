<?php
session_start();
require_once "./conexion.php";

$idanime = $_POST['idanime'];
$name = $_POST['name'];
$description = $_POST['description'];
$numcapitulo = $_POST['numcapitulo'];
$temporada = $_POST['temporada'];
$url = $_POST['url'];
$idportada = $_POST['idportada'];


$q = "INSERT INTO capitulos (idanime,name,description,numcapitulo,temporada,url,idportada) VALUES ($idanime,'$name','$description','$numcapitulo','$temporada','$url','$idportada')";
$resultado = mysqli_query($conexion,$q);


if ($resultado)
{
    echo "<script> alert('Se subio con exito'); window.location = '../php/my-account.php' </script>";
} else 
{
    echo "<script> alert('ERROR'); window.location = '../php/my-account.php' </script>";
}

?>