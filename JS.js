

function conectAjax() {
	var httpRequest = false;        		 //	CREA EL OBJETO "AJAX".Que es una instancia de XMLHttpRequest.
    										 // Esta funcion es generica para cualquier utilidad 
    if (window.XMLHttpRequest) {             // -> Mozilla, Safari, ...
		httpRequest = new XMLHttpRequest();  
    } else if (window.ActiveXObject) {       // -> IE
		httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return httpRequest;
}

/*
function loadAjax(str, id){
    url = document.getElementById("like1").src;
    console.log(url);
    
    if(url == "http://localhost/inicio/Borrar/Pruebas/Like.png"){
        var theObject = new XMLHttpRequest();
        theObject.open("GET", "Funciones.php?q=likeActivo", true);
        theObject.onreadystatechange = function(){
            document.getElementById("boton1").innerHTML = theObject.responseText;          
        }
        theObject.send();
        
    }else{
        if(url == "http://localhost/inicio/Borrar/Pruebas/LikeActivo.png"){
            
            document.getElementById("boton1").innerHTML = "<img src='Like.png' style='width:100%' id='like1' >"; 
        }
        
    }
} */

function loadAjax(str, idusuario, idL, idB, method="GET") { 
    //str es el nombre de la foto, idusuario es el id de la persona registrada
    //idL es el nombre del like, idB es el nombre del boton y despues esta el metodo que se va a ejecuta
    console.log(document.getElementById(idB));
    url = document.getElementById(idL).src;
    console.log(url);
    if(url.localeCompare("http://localhost/inicio/QuickPic/Pagina/Php/archivos/Pagina/Like.png") == 0){
        tipo = "Like";
    }else{
        tipo = "LikeActivo";
    }
    var xhr = conectAjax();                                     
    if(xhr) {
        console.log(tipo);
        console.log(idusuario);
        console.log(str);
        xhr.open(method, "Funciones.php?tipo="+tipo+"&usuario="+idusuario+"&publicacion="+str+"&idLike"+idL, true);
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

console.log("Se establecio la conexion con AJAX");
