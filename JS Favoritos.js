

function conectAjax() {
	var httpRequest = false;        		 
    if (window.XMLHttpRequest) {            //window.XMLHttpRequest chequea si el objeto httpRequest puede ser creado sin error
		httpRequest = new XMLHttpRequest();  
    } else if (window.ActiveXObject) {       // -> IE mas vieja (5 o 6)
		httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return httpRequest;
}

function loadAjax(str, idusuario, idL, idB, method="GET") { 
    //str es el nombre de la foto, idusuario es el id de la persona registrada
    //idL es el nombre del like, idB es el nombre del boton y despues esta el metodo que se va a ejecuta
    url = document.getElementById(idL).src;
    if(url.localeCompare("http://localhost/inicio/QuickPic/Pagina/Php/archivos/Pagina/Like.png") == 0){
        tipo = "Like";
    }else{
        tipo = "LikeActivo";
    }
    var xhr = conectAjax();                                     
    if(xhr) {
        xhr.open(method, "Funciones Favoritos.php?tipo="+tipo+"&usuario="+idusuario+"&publicacion="+str+"&idLike="+idL[4], true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState!=1) {
                document.body.style.cursor = 'wait';            // SET ESPERA Cursor mouse en espera
                //Otra opción sería: agregar una imagen de espera
                //  en el div (o elemento) donde serán cargado los datos
                //  y así liberar el puntero del mouse
            }
            if (xhr.readyState==4 && xhr.status==200) { 
                console.log(xhr.responseText)                              
                document.body.style.cursor = 'default';
                document.getElementById(idB).innerHTML = xhr.responseText;
            }
        }
        xhr.send();
    }
    else{
        console.log('No se pudo instanciar el objeto AJAX!');
    }
}

console.log("Se establecio la conexion con AJAX favoritos");
