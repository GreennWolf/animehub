<?php 
    include '../php_function/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/register.css">
    

</head>
<body>
    <div class="general">
        <header>
            <a href="../index.php"><img id="logo" src="../img/Logo.png"></a>
        </header>
        <main>
            <div class="contenedor" id="contenedor">
                <div class="tarjeta centrar" id="tarjeta"> 
                    <div class="formulario_register">
                        <form action="../php_function/register.php" method="POST">
                            <h2>Registrarse</h2>
                            <div class="input_box">
                                <input type="text" class="inp" name="username" id="username" placeholder="Usuario" required>
                                <input type="text" class="inp" name="email" id="email" placeholder="Email" required><div id="data"></div>
                            </div>
                            <div class="input_box">
                                <input type="password" class="inp" name="pw" id="password" placeholder="Contraseña" required>
                                <input type="date" class="inp" name="date" id="date" required>
                            </div>
                            
                            
                            <div class="contenedor_img">
                                <div class="img_selector">
                                    <img class='icons' id="icon" src="../img/user-icon.jpg" alt="">
                                    <input hidden type="text" name='idicono' id="idicono">
                                    <dialog id="icon-modal">
                                        <h2>Seleccionar Icono</h2>
                                        <div class="icon-container">
                                             <?php 
                                                $q = mysqli_query($conexion,"SELECT * FROM icons");
                                                while ($icon = mysqli_fetch_array($q)){
                                                    echo "<img data-value='$icon[0]' class='icons' id='icons' src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>";
                                                }
                                            ?>
                                        </div>
                                        <div class="btns">
                                            <button id="select">Seleccionar</button>
                                            <button id="cancel">Cancelar</button>
                                        </div>
                                    </dialog>
                                </div>
                            </div>
                            <input type="submit" id="submit" name="submit" value="E n v i a r">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/login.js"></script>
<script src="../js/register.js"></script>


</body>
</html>