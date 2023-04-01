<?php
session_start();
require_once '../php_function/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="../css/myaccount.css">
</head>

<body>
<header>
            <a class="logo" href="../index.php"><img src="../img/Logo.png"></a>
            <div class="buscador">
                <input id="search" type="text" placeholder="Buscar Anime">
            </div>


            <?php 
                if( isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                        $pregunta = mysqli_query($conexion,"SELECT * FROM cuentas WHERE username='$username'");
                        $user=mysqli_fetch_array($pregunta);
                        $q = mysqli_query($conexion,"SELECT * FROM icons WHERE idicono='$user[6]'");
                        $icon = mysqli_fetch_array($q);
                        $bgq = mysqli_query($conexion,"SELECT * FROM backgrounds WHERE idbg='$user[7]'");
                        $bg = mysqli_fetch_array($bgq);
                        echo "
                        <script>
                            var sesion = true;
                        </script>
                        <div class='user' id='user'>
                        <div class='user-card'>
                            <div class='user-icon'>
                                <img id='icon-user' src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>
                            </div>
                            <div class='user-name'>$user[2]</div>
                            <img class='arrow' id='arrow' src='../img/arrow.png'>
                        </div>
                        <div class='user-submenu inactive' id='user-submenu'>
                        <a href='./my-account.php'><li>My Account</li></a>
                        <a><li>Settings</li></a>
                        <a href='../php_function/logout.php'><li>LogOut</li></a>
                        </div>
                    </div>";
                    } else{
                        //<!-- Botones -->  
                        echo "
                        <script>
                            var sesion = false;
                        </script>   
                        <div class='buttons'>
                            <a href='../html/login.html'>
                                <button class='login'><span class='material-icons'>input</span>Iniciar</button>
                            </a>
                            <a href='../html/register.html'>
                                <button class='sign'><span class='material-icons'>bookmark_added</span>Registrar</button>
                            </a>
                        </div>
                        ";
                    }
                ?>
        </header>
    <div class="chest">
        <div class="perfil-info">
            <div class="img-port">
                <?php echo "<img id='background' src='data:image/jpeg;base64,".base64_encode($bg[1])."'/>" ?>
            </div>
            <img class="edit-bg" id="edit-bg" src="../img/icons/background-edit-icon.svg" alt="">
            <div class="perfil-container">
                <div class="perfil-img">
                    <?php echo "<img class='icon-img' id='icon' src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>" ?>
                    <img class="edit-icons" id="edit-icon" src="../img/icons/icon-edit.svg" alt="">
                </div>
                <div class="perfil-name">
                    <h2><?php echo $_SESSION['username']; ?></h2>
                </div>
            </div>
        </div>
        <dialog id="bg-modal">
            <div class="bg-preview">
                <img src="" alt="" id="bg-preview">
            </div>
            <h2>Seleccionar Background</h2>
            <div class="bg-container">
                    <?php 
                    $q = mysqli_query($conexion,"SELECT * FROM backgrounds");
                    while ($bg = mysqli_fetch_array($q)){
                        echo "<img data-value='$bg[0]' class='backgrounds' id='backgrounds' src='data:image/jpeg;base64,".base64_encode($bg[1])."'/>";
                    }
                ?>
            </div>
            <input hidden name="idbg" type="text" id="idbg">
            <?php echo "<input hidden name='idcuenta' type='text' id='idcuenta' value='$user[0]'>" ?>
            <div class="btns">
                <button id="select">Seleccionar</button>
                <button id="cancel">Cancelar</button>
            </div>
        </dialog>
        <dialog id="icon-modal">
            <div class="icon-preview">
                <img src="" alt="" id="icon-preview">
            </div>
            <h2>Seleccionar Icono</h2>
            <div class="icon-container">
                    <?php 
                    $q = mysqli_query($conexion,"SELECT * FROM icons");
                    while ($icon = mysqli_fetch_array($q)){
                        echo "<img data-value='$icon[0]' class='icons-view' id='icons' src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>";
                    }
                ?>
            </div>
            <input hidden name="idicono" type="text" id="idicono">
            <?php echo "<input hidden name='idcuenta' type='text' id='idcuenta' value='$user[0]'>" ?>
            <div class="btns">
                <button id="selectIcon">Seleccionar</button>
                <button id="cancelIcon">Cancelar</button>
            </div>
        </dialog>

        <div class="setting-container">
            <div class="menu-container">
                <div class="options-container">
                    <h2 class="setting-section">General</h2>
                    <div class="options" id="options">Preferencias</div>
                    <div class="options" id="options">Notificaciones por correo</div>
                    <div class="options" id="options">Cambiar Usuario</div>
                    <div class="options" id="options">Cambiar Email</div>
                    <div class="options" id="options">Cambiar Contraseña</div>
                    <?php if($user[8] == '1'){
                        echo "<div class='options active' id='options'>Admin Mode</div>";
                    } ?>
                </div>
                <div class="settings">
                    <div class="tabs">
                        <div class="preferencias">
                            <h2>Preferencias</h2>
                            <div class="idioma">
                                <h3>Idioma</h3>
                                <label for="page-lenguage"><p>Idioma de la pagina</p></label><br>
                                <select class="select-inp" name="page-lenguage" id="page-lenguage">
                                    <option value="español">Español</option>
                                    <option value="ingles">Ingles</option>
                                </select>
                                <label for="email-lenguage"><p>Idioma de los correos que recibiras</p></label><br>
                                <select class="select-inp" name="email-lenguage" id="email-lenguage">
                                    <option value="español">Español</option>
                                    <option value="ingles">Ingles</option>
                                </select>
                            </div>
                            <div class="video">
                                <h3>Video</h3>
                                <label for="sub-lenguage"><p>Idioma de los subtitulos</p></label><br>
                                <select class="select-inp" name="sub-lenguage" id="sub-lenguage">
                                    <option value="español">Español</option>
                                    <option value="ingles">Ingles</option>
                                </select>
                            </div>
                            <div class="manga"></div>
                        </div>
                    </div>
                    <div class="tabs">
                        <div class="preferencias">
                            <h2>Notificacion por correo</h2>
                        </div>
                    </div>
                    <div class="tabs">
                        <div class="preferencias">
                            <h2>Cambiar usuario</h2>
                        </div>
                    </div>
                    <div class="tabs">
                        <div class="preferencias">
                            <h2>Cambiar Email</h2>
                        </div>
                    </div>
                    <div class="tabs">
                        <div class="preferencias">
                            <h2>Cambiar Contraseña</h2>
                        </div>
                    </div>
                    <?php 
            if($user[8] == '1'){
                echo "<div class='tabs active'>
                    <div class='admin'>
                    <div class='btn'>
                    <form action='../php_function/create_anime.php' method='post'>
                        <h2>Cargar Anime</h2>
                        <input type='text' placeholder='name' name='name'>
                        <textarea name='description' placeholder='description'></textarea>
                        <textarea name='sinopsis' placeholder='sinopsis'></textarea>
                        <select name='genero' id='genero'>
                            <option value='accion'>Accion</option>
                            <option value='aventura'>Aventura</option>
                            <option value='comedia'>Comedia</option>
                            <option value='drama'>Drama</option>
                            <option value='fantasia'>fantasia</option>
                            <option value='musical'>musical</option>
                            <option value='romance'>romance</option>
                            <option value='scifi'>ciencia ficcion</option>
                            <option value='seinen'>seinen</option>
                            <option value='shoujo'>shoujo</option>
                            <option value='shounen'>shounen</option>
                            <option value='deportes'>deportes</option>
                            <option value='sobrenatural'>sobrenatural</option>
                            <option value='thriller'>thriller</option>
                            <option value='pol'>piece of life</option>
                        </select>
                        <input type='text' placeholder='url' name='url'>
                        <input type='text' placeholder='idbanner' name='idbanner'>
                        <button>Cargar</button>
                    </form><br></br>
                    
                    <form action='../php_function/create_cap.php' method='post'>
                    <h2>Cargar Capitulo</h2>
                    <input type='text' placeholder='name' name='name'>
                    <textarea name='description' placeholder='description'></textarea>
                    <input list='idanime' type='text' name='idanime'/>
                    <input type='number' placeholder='temporada' name='temporada'>
                    <input type='text' placeholder='nºcap' name='numcapitulo'>
                    <input type='text' placeholder='url' name='url'>
                    <input type='text' placeholder='idportada' name='idportada'>
                    <button>Cargar</button>
                </form>
                </div>";
                echo "<datalist id='idanime'>";
                    $q = mysqli_query($conexion,"SELECT * FROM animes ORDER BY idanime");
                    while($anime=mysqli_fetch_array($q)){
                        echo"<option value='$anime[0]'>$anime[1]</option>";
                    }
                echo "</datalist>";
                echo "<h2>CARGAR ICONOS DE USUARIO</h2>
                <form action='../php_function/img-charge.php' method='POST' enctype='multipart/form-data'>
                    <input type='file' class='inp' name='image' id='image' required>
                    <input type='submit' value='Enviar'>
                </form>
        
                <h2>CARGAR BACKGROUNDS DE USUARIO</h2>
                <form action='../php_function/bg-charge.php' method='POST' enctype='multipart/form-data'>
                    <input type='file' class='inp' name='image' id='image' required>
                    <input type='submit' value='Enviar' >
                </form>
                <h2>CARGAR BANNER DE ANIME</h2>
                <form action='../php_function/banner-charge.php' method='POST' enctype='multipart/form-data'>
                    <input type='file' class='inp' name='image' id='image' required>
                    <input type='submit' value='Enviar' >
                </form>
                <h2>CARGAR PORTADA DE CAPITULO</h2>
                <form action='../php_function/portada-charge.php' method='POST' enctype='multipart/form-data'>
                    <input type='file' class='inp' name='image' id='image' required>
                    <input type='submit' value='Enviar' >
                </form>
                    </div>
                </div>";
            }
        ?>
                </div>
            </div>
        </div>
    </div>
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../index.js"></script>
<script src="../js/my-account.js"></script>
</body>
</html>