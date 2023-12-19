<?php
require 'AuxPHP/Generar-Pag/Head.php';
require 'AuxPHP/Generar-Pag/Pagina.php';
require 'AuxPHP/Generar-Pag/CardA.php';

function GenerarPag(){
  $head = $body = Null;
  $head = fun_head("quick-pic.com/Favoritos",'../CSS/Programa4.css',"JS Perfil.js");


  $Admin = "";
  if($_SESSION['admin']==1){
    $Admin = '<a class="options" href="Categorias.php" >Administrar Categorías</a>';
  }

  $nombre = "Nuevo usuario";
  if(isset($_SESSION['nombre'])){
    $nombre = $_SESSION['nombre'];
  }

  $mail = "Nuevo usuario@";
  if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];
  }
  
  $fotoU = "Archivos/Pagina/foto perfil.png";
  if(isset($_SESSION['usuario'])){
    $fotoUsuario = fotoUsuario($_SESSION['usuario']);
    if($fotoUsuario != NULL){
      $fotoU = $fotoUsuario[0];
    }
  }

  
  $sql = "SELECT * FROM `usuarios` WHERE `mail` LIKE '{$mail}'";
  $result = consultarBD($sql);

  $telefono = "No hay telefono";
  if($result != NULL){
    $telefono = $result[0]["telefono"];
  }
  

  $fecha = "No hay fecha";
  if($result != NULL){
    $fecha = $result[0]["nacimiento"];
  }

  $cards = CargarCards();

  $body = <<<BODY
  <body class="bodyprofile">
    <div class="menu" id="menu_profile">
      <div class="dropdown">
        <button class="dropbtn"><img src="archivos/Pagina/Menu.png" class="menu_img" style="max-width:100%"></button>
        <div class="dropdown-content">
            <a class="active options" href="Pagina Principal.php">Inicio</a> 
            <a class="options" href="Favoritos.php">Favoritos</a>
            <a class="options" href="AuxPHP/Logout.php">Cerrar sesión</a>
            $Admin
        </div>
      </div>
    </div>
    
    <div class="profile-header">
      <div class="profile-imgdiv">
        <img src="$fotoU" width="200" alt="Profile Image" id="profile-img">
      </div>
      <div class="profile-nav-info">
        <i id="username-profile">$nombre</i>
        <div class="address">
          <p id="state" >Buenos Aires,</p>
          <p id="country" >Argentina.</p>
        </div>
      </div>
      <div class="profile-option" id="profile-option">
        <div class="ajustes">
          <a><img src="archivos/Pagina/tuerca ajustes.png" id="ajustes_perfil" onclick="openForm()"></a>
        </div>
      </div>
    </div>
    <div id="form-profile">
    </div>
  
  
    <div class="main-bd">
      <div class="left-side">
        <div class="profile_side">
          <p id="titulod-profile">Mis datos</p>
          <p id="number-profile" class="datos-profile"> Numero de telefono: $telefono </p>
          <p id="mail-profile" class="datos-profile"> Mail: $mail</p>
          <p id="name-profile" class="datos-profile"> Fecha de nacimiento: $fecha</p>
          <div class="user-bio">
            <h3>Bio</h3>
            <p class="bio">
              Lorem ipsum dolor sit amet, hello how consectetur adipisicing elit. Sint consectetur provident magni yohoho consequuntur, voluptatibus ghdfff exercitationem at quis similique. Optio, amet!
            </p>
          </div>
          <div class="profile-btn">
            <a class="logo" href="https://www.instagram.com"> <img src="archivos/Pagina/instagram.jpeg" width="100%"> </a>
            <a class="logo" href="https://twitter.com/?lang=es"> <img src="archivos/Pagina/twiter.jpeg" width="100%"> </a>
            <a class="logo" href="https://www.tiktok.com/es/"> <img src="archivos/Pagina/tiktok.jpeg" width="100%"> </a>
          </div>
        </div>
      </div>
      <div class="right-side">
        <h1 class="publicaciones-titulo">PUBLICACIONES</h1>
        <div id="cardcontainer-profile">
          $cards
        </div>
      </div>
    </div>
  </body>
BODY;
  $pagina = fun_pag($head,$body);
  return $pagina;
}
  
 
function main(){
  session_start();
  if(!isset($_SESSION["mail"])){
    header("Location: login.php");
  }
  print(GenerarPag());
}

main();

?>
