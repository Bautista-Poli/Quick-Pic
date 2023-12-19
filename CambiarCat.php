<?php
require_once "AuxPHP/BaseDatos.php";
$nuevo="";
$eliminar = "";

if (isset($_REQUEST['nuevo']) && $_REQUEST['nuevo'] != null){
    $nuevo=$_REQUEST['nuevo'];
    $Busqueda = "SELECT * FROM `categorías` WHERE `categorias` = '{$nuevo}'";
    $result = consultarBD($Busqueda);
    if($result == null){
        $sqlNuevo = "INSERT INTO `categorías` (`id`, `categorias`) VALUES (NULL, '{$nuevo}')";
        pub($sqlNuevo);
    }
}
if (isset($_REQUEST['elimino']) && $_REQUEST['elimino'] != null){
    $eliminar=$_REQUEST['elimino'];
    $sqlElimino = "DELETE FROM `categorías` WHERE `categorias` = '{$eliminar}'";
    pub($sqlElimino);
}
echo "hecho";


?>
