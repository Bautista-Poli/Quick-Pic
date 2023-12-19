<?php
require 'AuxPHP/Generar-Pag/Head.php';
require 'AuxPHP/Generar-Pag/Pagina.php';
require 'AuxPHP/BaseDatos.php';

function GenerarPag(){
  $head = $body = Null;
  $head = fun_head("Categoria",'../CSS/Programa4.css',"JS2.js");

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



  $body = <<<BODY
  <body id="body_categorias">
    <div class="menu" >
      <div class="dropdown" id="menu_cat_php">
        <button class="dropbtn"><img src="archivos/Pagina/Menu.png" class="menu_img" id="img01" style="max-width:100%"></button>
        <div class="dropdown-content">
            <a  href="Perfil.php"><img src={$fotoU} class="perfil" ></a>
            <div class="nombreusuario">
                <i>$nombre</i>
            </div>
            <a class="active options" href="Pagina Principal.php">Inicio</a> 
            <a class="options" href="Favoritos.php">Favoritos</a>
            <a class="options" href="AuxPHP/Logout.php">Cerrar sesión</a>
            <a class="options" href="">Categorias</a>
        </div>
      </div>
    </div>
    <hr>
    <br>
    <br>
    <br>
    <div class="form-cat"> 
      <form id="nuevaCat" action="" method="" >
        <div class="CategoriasPagina">
          <a type="Boton" class="botonCat" id="b06" >Nueva Categoria</a> 
          <input  type="text" class="imputCat" id="imputCat1" name="nuevo" placeholder="#"><br>
          <br>
          <a type="Boton" class="botonCat" id="b07" >Eliminar Categoria</a> 
          <input  type="text" class="imputCat" id="imputCat2" name="elimino" placeholder="#" > 
          <br>
          <input type="button" class="CatBoton" id="b14" value= "Enviar" onclick="Categorias('nuevaCat')">
          <br>
        </div>
      </form>
    </div>
  </body>
BODY;
  $pagina = fun_pag($head,$body);
  return $pagina;
}
  
 
function main(){
  session_start();
  if(!isset($_SESSION["usuario"]) && 1 != $_SESSION["usuario"]){
    header("Location: login.php");
  }
  print(GenerarPag());
}

main();

?>
