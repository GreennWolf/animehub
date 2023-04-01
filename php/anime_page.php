<?php 
    session_start();
    require_once '../php_function/conexion.php';
    mysqli_query($conexion, "SET CHARACTER SET utf8");
    $idanime = $_GET['idanime'];
    $pregunta = mysqli_query($conexion, "SELECT * FROM animes WHERE idanime='$idanime'");
    $animes = mysqli_fetch_array($pregunta);
    $quest = mysqli_query($conexion, "SELECT * FROM banners WHERE idbanner='$animes[6]'");
    $banners = mysqli_fetch_array($quest);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
    <link rel="stylesheet" href="../css/anime_page.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="general">
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
                        echo "
                        <script>
                            var sesion = true;
                        </script>
                        <div class='user' id='user'>
                        <div class='user-card'>
                            <div class='user-icon'>
                                <img src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>
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
                            <a href='../php/register.php'>
                                <button class='sign'><span class='material-icons'>bookmark_added</span>Registrar</button>
                            </a>
                        </div>
                        ";
                    }
                ?>
        </header>
        <main>
            <div class="portada">
                <div class="imagen">
                    <?php echo "<img src='data:image/jpeg;base64,".base64_encode($banners[1])."'/>" ?>
                </div>
            </div>
            <div class="principal">
                <div class="titulo">
                    <p><?php echo $animes[1]; ?></p>
                </div>

                <div class="sinopsis">
                    <h2>Sinopsis</h2>
                    <p><?php echo $animes[2]; ?></p>
                </div>


                <div class="descripcion">
                    <div class="t_episodios"><p>Episodios</p></div>

                    <div class="episodios">
                        <div class="temporada">Temporada 1</div>
                        <?php 
                            $consulta = mysqli_query($conexion, "SELECT * FROM capitulos WHERE idanime='$idanime'");
                            while($capitulos = mysqli_fetch_array($consulta)){
                                $query = mysqli_query($conexion, "SELECT * FROM portadas WHERE idportada='$capitulos[7]'");
                                $portadas = mysqli_fetch_array($query);
                                echo "
                                    <div class='capitulo inactive'>
                                        <a href='./reproductor.php?idcap=$capitulos[0]'>
                                            <div class='caratula'>
                                                <img src='data:image/jpeg;base64,".base64_encode($portadas[1])."'/>
                                            </div>
                                            <div class='informacion'>
                                                <div class='datos'>
                                                    <p id='titu'>$capitulos[2]</p>
                                                    <div>
                                                        <p id='n_episodio'>Episodio $capitulos[5]</p>
                                                        <p id='n_temporada'>Temporada $capitulos[4]</p>
                                                    </div>
                                                </div>
                                                <div class='desplegable'>
                                                    <img src='../img/play.png' alt=''>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                ";
                            }
                        ?>  
                        

                    </div>
                </div>
            </div>
            




        </main>
    </div>
<script src="https://kit.fontawesome.com/2e013aabe0.js" crossorigin="anonymous"></script>
<script src="../index.js"></script>
<script src="../js/anime.js"></script>
</body>
</html>