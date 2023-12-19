<?php
require_once "AuxPHP/BaseDatos.php";

function numeros($cadena) {
    for($i = 0; $i < strlen($cadena); $i++){
        if(($cadena[$i] < '0' || $cadena[$i] > '9') && $cadena[$i]!="" && $cadena[$i]!="+" ){
            return "No es numero";
        }
    }
    return "Pertenece";
    
}

function recibirDatos(){
    
	$nombre="";
	$password="";
    $telefono="";
	$nombreArchivo="";
	$mensajeArchivo="";
	$estadoSubida="";
    $result="*No se ha logrado subir";
    $mail="";
    $id="";
    $resultsql="";


    
    
    if (isset($_REQUEST['mail']) && $_REQUEST['mail']!=""){
        $mail=$_REQUEST['mail'];
        $sql = "SELECT * FROM `usuarios` WHERE `mail` LIKE '{$mail}'";
        $resultsql = consultarBD($sql);
        $id = $resultsql[0]["id"];
        $usuario = $resultsql[0]["nombre"];

    }

	if (isset($_REQUEST['usuario']) && $_REQUEST['usuario']!=""){
		$nombre=$_REQUEST['usuario'];
        $sql= "UPDATE `usuarios` SET `nombre` = '{$nombre}' WHERE `usuarios`.`id` = '{$id}'";
        cambiar($sql);
        $result = "*Se logro cambiar el nombre";
	}
    
	if (isset($_REQUEST['password']) && $_REQUEST['password']!=""){
		$password=$_REQUEST['password'];
        $sql = "UPDATE `usuarios` SET `contraseña` = '{$password}' WHERE `usuarios`.`id` = '{$id}'";
        cambiar($sql);
        if($result == "*Se logro cambiar el nombre"){
            $result = $result . " y la contraseña";  
        }else{
            $result = "*Se logro cambiar la contraseña";
        }
        
	}

    if (isset($_REQUEST['telefono']) && $_REQUEST['telefono']!="" && numeros($_REQUEST['telefono']) == "Pertenece"){
		$telefono=$_REQUEST['telefono'];
        $sql = " UPDATE `usuarios` SET `telefono` = '{$telefono}' WHERE `usuarios`.`id` = '{$id}'";
        cambiar($sql);
        if($result == "*Se logro cambiar el nombre" || $result == "*Se logro cambiar la contraseña" ){
            $result = $result . " y el numero de telefono";  
        }else if($result == "*Se logro cambiar el nombre y la contraseña"){
            $result = $result. " y el numero de telefono";
        }else{
            $result = "*Se logro cambiar el numero de telefono";
        }
	}

	// * * * * A R C H I V O * * * * * *
	// 'fileToUpload' es el name del input html tipo file (cuando se envía por fecth)
	// 'fileToUpload' es el name del input html tipo submit 'del boton' (cuando se envía por form)

	if(isset($_REQUEST['fileToUpload']) || isset($_FILES['fileToUpload'])){
		if (isset($_FILES['fileToUpload'])){
			$res = recibirArchivo($usuario);
			if ($res!=null ){
				$url=$res['filename'];
				$result =$res['message'];
			}
            if($res['uploadOk'] != 0){
                $sql = "INSERT INTO `fotoperfil` (`id`, `idusuario`, `url`) VALUES (NULL, '{$id}', '{$url}')";
                cambiar($sql);
            }
            	
		}
	}		
	// * * * * * * * * * * * * * * * * * 
    
	$txt=<<<TXT
	<a>$result</a>
TXT;
return $txt;

}


function recibirArchivo($userName){
	$target_dir = "Archivos/perfiles/perfil ";
	$nomArch= basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($nomArch,PATHINFO_EXTENSION));
    $target_file = $target_dir .$userName.".".$imageFileType;
	$result=null;
	$msj="";
    
	if ($userName == null) {
		$msj= ", no estas registrado";
		$uploadOk = 0;
	}

	if (file_exists($target_file)) {
		$msj= ", ya se encuentra subido.";
		$uploadOk = 0;
	}

	if ($_FILES["fileToUpload"]["size"] > 500000 && $uploadOk ) {
		$msj= ", el tamaño es mayor a la capasidad limite.";
		$uploadOk = 0;
	}

	
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $uploadOk ) {
        $msj= ", only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
	
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$msj= "El archivo no ha sido subido,".$msj;
		$uploadOk = 0;
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			   $msj= "The file ".$nomArch. " has been uploaded.";
			} else {
			   $msj= "Sorry, there was an error uploading your file.";
			   $uploadOk = 0;
			}
            
	}
	
	$result=['filename'=>$target_file,'message'=>$msj,'uploadOk'=>$uploadOk];
    
    return $result;
}

function main(){
	print_r(recibirDatos());
}
main();
?>
