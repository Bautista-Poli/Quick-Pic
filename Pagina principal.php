<?php
require 'AuxPHP/Generar-Pag/Head.php';
require 'AuxPHP/Generar-Pag/Pagina.php';
require 'AuxPHP/Generar-Pag/CardP.php';

function GenerarPag(){
  $head = fun_head("quick-pic.com/Pagina principal",'../CSS/Programa4.css',"JS.js");


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



  $cards = CargarCards();

  $body = <<<BODY
<body>
<div>
    <div class="menu" id="menu_pagp">
        <div class="dropdown">
            <button class="dropbtn"><img src="Archivos/Pagina/Menu.png" class="menu_img" style="max-width:100%"></button>
            <div class="dropdown-content">
                <a  href="Perfil.php"><img src="$fotoU" class="perfil" ></a>
                <div class="nombreusuario">
                <i>$nombre</i>
                </div>
                <a class="active options" href="Pagina principal.php">Inicio</a> 
                <a class="options" href="Favoritos.php">Favoritos</a>
                <a class="options" href="AuxPHP/Logout.php">Cerrar sesión</a>
                $Admin
            </div>
        </div>
    </div>
    <a href="Ampliacion.php"><img src="Archivos/Pagina/agregarfoto.png" class="fixedbutton"></a>
    <div class="cardcontainer" id="cardcontainer_pagp">
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
