<?php
session_start();
require_once '../php_function/conexion.php';
mysqli_query($conexion, "SET CHARACTER SET utf8");

$idcapitulo = $_GET['idcap'];
$consulta = mysqli_query($conexion, "SELECT * FROM capitulos WHERE idcapitulo='$idcapitulo'");
$capitulos = mysqli_fetch_array($consulta);
$idanime = $capitulos[1];
$url = $capitulos[6];
$temporada = $capitulos[4];
$capnum = $capitulos[5];
$nextcap = $capnum + 1;
$pregunta = mysqli_query($conexion, "SELECT * FROM animes WHERE idanime='$idanime'");
$animes = mysqli_fetch_array($pregunta);
$query = mysqli_query($conexion, "SELECT * FROM capitulos WHERE idanime='$idanime' AND temporada = '$temporada' AND numcapitulo = '$nextcap'");
$next = mysqli_fetch_array($query);


if(!isset($next)){
  $nextcap = $capnum - $capnum + 1 ;
  $query = mysqli_query($conexion, "SELECT * FROM capitulos WHERE idanime='$idanime' AND temporada = '$temporada' AND numcapitulo = '$nextcap'");
  $next = mysqli_fetch_array($query);
  $query2 = mysqli_query($conexion, "SELECT * FROM portadas WHERE idportada = '$next[7]'");
  $portadas = mysqli_fetch_array($query2);
}else{
  $query2 = mysqli_query($conexion, "SELECT * FROM portadas WHERE idportada = '$next[7]'");
  $portadas = mysqli_fetch_array($query2);
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <title>Animes</title>
  <link rel="stylesheet" href="../css/reproductor.css">
</head>

<body>
  <div class="general">
    <header>
      <a class="logo" href="../index.php"><img src="../img/Logo.png"></a>
      <div class="buscador">
        <input id="search" type="text" placeholder="Buscar Anime">
      </div>


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
    <section>
      <div class="container">a
        <div id="video_player">
          <div class="loader"></div>
          <video preload="metadata" id="main-video">
            <source src="<?php echo $url;?> " size="480" type="video/mp4">
            <source src="<?php echo $url;?> " size="720" type="video/mp4">
            <source src="<?php echo $url;?> " size="1080" type="video/mp4">
            <track id="track1" label="Español" kind="subtitles" src="../../subtitulos/kimetsu/español/01.vtt" srclang="es">
            <track id="track2" label="Urdu" kind="subtitles" src="./test.vtt" srclang="en">
          </video>
          <p class="caption_text"></p>
          <div class="thumbnail"></div>
          <div class="progressAreaTime">0:00</div>

          <div class="controls">
            <div class="progress-area">
              <canvas class="bufferedBar"></canvas>
              <div class="progress-bar">
                <span></span>
              </div>
            </div>

            <div class="controls-list">
              <div class="controls-left">
                <span class="icon">
                  <i class="material-icons fast-rewind">replay_10</i>
                </span>

                <span class="icon">
                  <i class="material-icons play_pause">play_arrow</i>
                </span>

                <span class="icon">
                  <i class="material-icons fast-forward">forward_10</i>
                </span>

                <span class="icon">
                  <i class="material-icons volume">volume_up</i>

                  <input type="range" min="0" max="100" class="volume_range" />
                </span>

                <div class="timer">
                  <span class="current">0:00</span> /
                  <span class="duration">0:00</span>
                </div>
              </div>

              <div class="controls-right">
                <span class="icon">
                  <i class="material-icons auto-play"></i>
                </span>

                <span class="icon">
                  <i class="material-icons captionsBtn">closed_caption</i>
                </span>

                <span class="icon">
                  <i class="material-icons settingsBtn">settings</i>
                </span>

                <span class="icon">
                  <i class="material-icons picture_in_picutre">picture_in_picture_alt</i>
                </span>

                <span class="icon">
                  <i class="material-icons fullscreen">fullscreen</i>
                </span>
              </div>
            </div>
          </div>

          <div id="settings">
            <div data-label="settingHome">
              <ul>
                <li data-label="speed">
                  <span> Speed </span>
                  <span class="material-symbols-outlined icon">
                    arrow_forward_ios
                  </span>
                </li>
                <li data-label="quality">
                  <span> Quality </span>
                  <span class="material-symbols-outlined icon">
                    arrow_forward_ios
                  </span>
                </li>
              </ul>
            </div>
            <div class="playback" data-label="speed" hidden>
              <span>
                <i class="material-symbols-outlined icon back_arrow" data-label="settingHome">
                  arrow_back
                </i>
                <span>Playback Speed </span>
              </span>
              <ul>
                <li data-speed="0.25">0.25</li>

                <li data-speed="0.5">0.5</li>

                <li data-speed="0.75">0.75</li>

                <li data-speed="1" class="active">Normal</li>

                <li data-speed="1.25">1.25</li>

                <li data-speed="1.5">1.5</li>

                <li data-speed="1.75">1.75</li>

                <li data-speed="2">2</li>
              </ul>
            </div>
            <div data-label="quality" hidden>
              <span>
                <i class="material-symbols-outlined icon back_arrow" data-label="settingHome">
                  arrow_back
                </i>
                <span>Playback Quality </span>
              </span>
              <ul>
                <li data-quality="auto" class="active">auto</li>
              </ul>
            </div>
          </div>
          <div id="captions">
            <div class="caption">
              <span>Select Subtitle</span>
              <ul>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <div id="backPag">
    <a class="anime-title" href=""><p>Estas viendo:</p><?php echo  $animes[1]; ?></a>
    <div class="info">
      <h1 class="title"><?php echo "E". $capnum . "-" .$capitulos[2] ; ?></h1><br>
      <p class="resu"><?php echo $capitulos[3] ; ?></p>
    </div>
    <div class="comment-container">
      <h3>Comentarios</h3>
      <div>
        <form id='coment-form' method="post" data-cap='<?php echo $capitulos[0]; ?>'>
          <div class="comment-inp">
            <?php 
              if(isset($username)){
                echo "<img class='icon-comment' src='data:image/jpeg;base64,".base64_encode($icon[1])."'/>" ; 
              }else{
                
              }
              ?>
            <textarea placeholder="Escribe tu comentario" type="text" id='comentario'></textarea>
          </div>
          <?php 
            if(isset($username)){
              echo "<div class='comment-info'><p class='coment-user'>Comentando como: </p><p class='username-comment'>$username</p></div>";
            }else{
              echo "<p class='error'>Debes iniciar sesion para comentar</p>";
            }
          ?>
          <input class="btn-submit" type="submit" placeholder="Comentar" value="Comentar">
        </form>
      </div>
      <?php
      $q = mysqli_query($conexion, "SELECT * FROM comentarios WHERE idcapitulo='$idcapitulo'");
      while ($comentario = mysqli_fetch_array($q)) {
        $idcuenta = $comentario[1];
        $sql = mysqli_query($conexion, "SELECT * FROM cuentas WHERE idcuenta = '$idcuenta'");
        $cuenta = mysqli_fetch_array($sql);
        $iq = mysqli_query($conexion, "SELECT * FROM icons WHERE idicono = '$cuenta[6]'");
        $iconC = mysqli_fetch_array($iq);
        echo "
            <p id='enviado'></p>
            <div class='coment-card'>
            <div class='coment-content'>
              <div class='user-info'>
                <img class='user-logo' src='data:image/jpeg;base64,".base64_encode($iconC[1])."'/>
                <h2>$cuenta[2]</h2>
                <div class='likes'>
                  <p id='$comentario[0]'  class='likes-num'>$comentario[4]</p>
                  <img class='likeBtn' id='$comentario[0]' data-value='$comentario[4]' src='../img/icons/like.svg'/>
                  <img class='reportBtn' id='$comentario[0]' data-cap='$capitulos[0]' data-value='$comentario[5]' src='../img/icons/report.svg'/>
                </div>
              </div>
              <div class='coment'>
                <p class='comento'>Comento:</p>
                <p>$comentario[3].</p>
              </div>
            </div>
          </div>";
      }
      
      ?>
      <div id='new'></div>
    </div>

    <div class="next-container">
      <h4>Siguiente capitulo</h4>
        <?php echo "<a id='next-cap' href='./reproductor.php?idcap=$next[0]'>" ; ?>
        <div class="ep">
          <h5 class="ep-title"><?php echo "E" . $nextcap . "-" .  $next[2]; ?></h5>
          <p class="ep-descri"><?php echo $next[3]; ?></p>
          <?php echo "<img src='data:image/jpeg;base64,".base64_encode($portadas[1])."'/>" ; ?>
        </div>
      </a>
    </div>

  </div>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/reproductor.js"></script>
  <script src="../index.js"></script>
  <script src="../js/comentarios.js"></script>
  <script>
      var vid = document.getElementById("main-video");
      vid.autoplay = true;
      vid.load();
  </script>
</body>

</html>