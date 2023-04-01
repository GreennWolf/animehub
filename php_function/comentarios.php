<?php
session_start();
require_once "./conexion.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $username = '';
}

$comentario = $_POST['comentario'];
$actualcap = $_POST['actualcap'];


if($username != ''){
    $sql = "SELECT * FROM cuentas WHERE username = '$username'";
    $result = $conexion ->query($sql);
    $campo = mysqli_fetch_assoc($result);

    $idcuenta = $campo['idcuenta'];
    $idicono = $campo['idicono'];
    $username = $campo['username'];    

    $q = "INSERT INTO comentarios (idcuenta,idcapitulo,comentario) VALUES ('$idcuenta','$actualcap','$comentario')";
    $resultado = mysqli_query($conexion,$q);


    $idcomentario =mysqli_insert_id($conexion);

    $q = mysqli_query($conexion,"SELECT * FROM icons WHERE idicono='$idicono'");
    $icon = mysqli_fetch_array($q);

    $comentCard = "<div class='coment-card'>
    <div class='coment-content'>
      <div class='user-info'>
        <img class='user-logo' src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>
        <h2>$username</h2>
        <div class='likes'>
          <p id=''  class='likes-num'>0</p>
          <img class='likeBtn' id='' data-value='0' src='../img/icons/like.svg'/>
        </div>
      </div>
      <div class='coment'>
        <p>$comentario.</p>
      </div>
    </div>
  </div>";

    if ($resultado)
    {   
        echo "$comentCard";
    } else 
    {
        echo "Error al comentar";
    }
}else{
    echo "Debes iniciar sesion para comentar";
}
