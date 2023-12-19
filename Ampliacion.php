<?php
require 'AuxPHP/Generar-Pag/Head.php';
require 'AuxPHP/Generar-Pag/Pagina.php';
require 'SubirFoto/Opciones.php';



function GenerarPag(){
  $head = fun_head("quick-pic.com/Ampliacion",'../CSS/Programa4.css',null);
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

  $result = opciones();


  echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "<br>";

  $body = <<<BODY
  <body class="body_subir">
      <div class="menu" id="menuAmpliacion">
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
      <div class="form_subir" id="form_amp"> 
        <form   name="FormSubirFoto" action="SubirFoto/RecibirDatos.php" method="post" enctype="multipart/form-data" >
          <div class="img_subir">
            <label id="input_img_subir">
              <h1 id="AmpTit">Cargar la foto:</h1>
              <img src="Archivos/Pagina/archivo_subir.png" id="AmpImg" >
              <input type="file" name="archivo" id="imgs_subir" accept=".jpg, .jpeg, .png">
              <div id="titulo_img_subir">
              </div>
            </label>
            
          </div>
            <div id="hashtg_subir">
              <label > Hashtags disponibles </label>
            </div>
            <div id="catg_hashtg_subir">
              <div id="izq_catg_subir" class="categorias_subir">
                <div>
                  <select id="categoria01" name="hashtag1" class="selector_subir">
                    <option value="None" disabled selected>#</option>
                    $result
                  </select>
                </div>
                <div>
                  <select id="categoria02" name="hashtag2" class="selector_subir">
                    <option value="None" disabled selected>#</option>
                    <option value="" >None</option>
                    $result
                  </select>
                </div>
              </div>
            </div>
            <div class="boton_subir">
              <input type="submit" value="Publicar" id="boton">
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
  if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
  }
  print(GenerarPag());
}

main();

?>
