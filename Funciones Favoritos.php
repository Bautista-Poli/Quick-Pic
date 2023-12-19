<?php
require_once "AuxPHP/BaseDatos.php";
$tipo = null;
$usuario = null;
$publicacion = null;
$m = null;
$idP = null;

if(isset($_REQUEST["usuario"])){
    $usuario = $_REQUEST["usuario"];
}
if(isset($_REQUEST["tipo"])){
    $tipo = $_REQUEST["tipo"];
}
if(isset($_REQUEST["publicacion"])){
    $publicacion = $_REQUEST["publicacion"];
}
if(isset($_REQUEST["idLike"])){
    $idP = $_REQUEST["idLike"];
}


$sql_Busqueda1 = "SELECT `id` FROM `imagen` WHERE `url` LIKE '{$publicacion}'";
$busqueda = Buscar($sql_Busqueda1);




$sql_Busqueda2 = "SELECT * FROM `favoritos` WHERE `idusuario` = $usuario AND `id-publicacion` = $idP";
$encontrar = Buscar($sql_Busqueda2);


if($tipo == "Like"){
    if($encontrar == null){
        $sql_LIKE = "INSERT INTO `favoritos` (`id`, `idusuario`, `id-publicacion`) VALUES (null, '{$usuario}', '{$idP}')";
        Like($sql_LIKE);
    }

    $m = "<img src='archivos/Pagina/LikeActivo.png' style='width:100%' id='like{$idP}' >";

}else{
    if($tipo == "LikeActivo"){
        if($encontrar != null){
            $sql_DISLIKE = "DELETE FROM `favoritos` WHERE `idusuario` = $usuario AND `id-publicacion` = $idP";
            Like($sql_DISLIKE);
        }
        $m = "<img src='archivos/Pagina/Like.png' style='width:100%' id='like{$idP}' >";
    }
}


echo $m;
?>
