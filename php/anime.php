<?php
session_start();
require_once '../php_function/conexion.php';
$contadores = mysqli_query($conexion, "SELECT COUNT(*) FROM animes");
$counter = mysqli_fetch_array($contadores);
$resultado= $counter['COUNT(*)'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
    <link rel="stylesheet" href="../css/anime_style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="general">
        <header>
            <a class="logo" href="../index.php"><img src="../img/Logo.png"></a>
            <div class="buscador">
                <input id="search" type="text" placeholder="Buscar Anime">
            </div>

            <!-- Iniciar Sesion -->
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $pregunta = mysqli_query($conexion, "SELECT * FROM cuentas WHERE username='$username'");
                $user = mysqli_fetch_array($pregunta);
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
            } else {
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




        <section id="main_section">
            <div id="main_slider">
                <div class="slider-container">
                    <div class="slider" id="slider">
                        <!-- <?php 
                            
                            // $pregunta = mysqli_query($conexion, "SELECT * FROM animes");
                            // while($animes = mysqli_fetch_array($pregunta)){
                            //     $quest = mysqli_query($conexion, "SELECT * FROM banners WHERE idbanner='$animes[6]'");
                            //     $banners = mysqli_fetch_array($quest);
                            //     echo "
                            //         <div class='slider__section' id='slider-section' data-num='$resultado' >
                            //             <img data-value='$banners[0]' class='slider__img' id='icons' src='data:image/jpeg;base64,".base64_encode($banners[1])."'/>
                            //             <a href='./anime_page.php?idanime=$animes[0]'>
                            //                 <div id='titu'>
                            //                     <p>$animes[1]</p>
                            //                 </div>
                            //             </a>
                            //         </div>
                            //     "; 
                            // }
                        ?> -->
                        <div class="slider__section">
                            <img src="../img/carrousel8.jpg" alt="" class="slider__img">
                            <a href="#">
                                <div id="titu">
                                    <p>Jujutsu Kaisen</p>
                                </div>
                            </a>
                        </div>
                        <div class="slider__section">
                            <img src="../img/carrousel3.jpg" alt="" class="slider__img">
                            <a href="#">
                                <div id="titu">
                                    <p>Sword Art Online</p>
                                </div>
                            </a>
                        </div>
                        <div class="slider__section">
                            <img src="../img/carrousel4.jpg" alt="" class="slider__img">
                            <a href="./anime_page.php">
                                <div id="titu">
                                    <p>Kill La Kill</p>
                                </div>
                            </a>
                        </div>
                        <div class="slider__section">
                            <img src="../img/carrousel5.jpg" alt="" class="slider__img">
                            <a href="#">
                                <div id="titu">
                                    <p>Fullmetal Alchemist</p>
                                </div>
                            </a>
                            
                        </div>
                        <div class="slider__section">
                            <img src="../img/carrousel6.jpg" alt="" class="slider__img">
                            <a href="#">
                                <div id="titu">
                                    <p>Kimetsu No Yaiba</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
                    <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
                </div>
            </div>
    
            <div class="flex" style="background-color: #1b1b1b; align-items: flex-end;">
                <div class="cuadro">
                    <h2>ANIMES</h2>
                </div>
            </div>
        </section>


        

        <section id="tendencias_section">
            <!-- nuevos animes -->
            <div>
                <h2>Tendencias</h2> 
            </div>
            <div class="grilla">
            <?php 
                    $pregunta = mysqli_query($conexion, "SELECT * FROM animes");
                    while($animes = mysqli_fetch_array($pregunta)){
                        $quest = mysqli_query($conexion, "SELECT * FROM banners WHERE idbanner='$animes[6]'");
                        $banners = mysqli_fetch_array($quest);
                        echo "
                        <div class='marco'>
                            <article>
                                <a href='./anime_page.php?idanime=$animes[0]'>
                                    <img data-value='$banners[0]' class='icons-view' id='icons' src='data:image/jpeg;base64,".base64_encode($banners[1])."'/>
                                    <div class='titulo_anime'>
                                        <div class='nombre_anime'>
                                            <p id='titu'>$animes[1]</p>
                                            <p id='desc'>$animes[2]</p>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>"; 
                    }
                ?>
            </div>
        </section>

        <section>
            
        </section>


        

        <footer><p>footer</p></footer>
    </div>
    <script src="../js/slider.js"></script>
    <script src="../index.js"></script>
</body>

</html>