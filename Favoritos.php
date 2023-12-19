<?php
require 'AuxPHP/Generar-Pag/Head.php';
require 'AuxPHP/Generar-Pag/Pagina.php';
require 'AuxPHP/Generar-Pag/CardF.php';

function GenerarPag(){
  $head = fun_head("quick-pic.com/Favoritos",'../CSS/Programa4.css',"JS Favoritos.js");

  $Admin = "";
  if($_SESSION['admin']==1){
    $Admin = '<a class="options" href="Categorias.php" >Administrar Categorías</a>';
  }

  $nombre = "Nuevo usuario";
  if(isset($_SESSION['nombre'])){
    $nombre = $_SESSION['nombre'];
  }
  
  $fotoU = "Archivos/Pagina/foto perfil.png";
  if(isset($_SESSION['usuario'])){
    $fotoUsuario = fotoUsuario($_SESSION['usuario']);
    if($fotoUsuario != NULL){
      $fotoU = $fotoUsuario[0];
    }
    
  }

  $cards = CargarCardsF($_SESSION['usuario']);


  $body = <<<BODY
  <body>
    <div class="menu" id="menu_fav_php">
      <div class="dropdown">
        <button class="dropbtn"><img src="archivos/Pagina/Menu.png" class="menu_img" style="max-width:100%"></button>
        <div class="dropdown-content">
            <a  href="Perfil.php"><img src="$fotoU" class="perfil" ></a>
            <div class="nombreusuario">
                <i>$nombre</i>
            </div>
            <a class="active options" href="Pagina Principal.php">Inicio</a> 
            <a class="options" href="Favoritos.php">Favoritos</a>
            <a class="options" href="AuxPHP/Logout.php">Cerrar sesión</a>
            $Admin
        </div>
      </div>
    <hr>
    </div>
    <a href="Ampliacion.php"><img src="Archivos/Pagina/agregarfoto.png" class="fixedbutton"></a>
    <hr>
    <div class="cardcontainer" id="cardcontainer_fav">
      $cards
    </div>  
  </body>
BODY;
  $pagina = fun_pag($head,$body);
  return $pagina;
}


  
 
function main(){
  session_start();
  if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
  }
  print(GenerarPag());
}

main();

?>
