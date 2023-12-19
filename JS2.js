

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

function Categorias(idForm, method="POST") { 

    var formData =getDataForm(idForm);

    var xhr = conectAjax();                                     
    if(xhr) {
        xhr.open(method, "CambiarCat.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState!=1) {
                document.body.style.cursor = 'wait';            
            }
            if (xhr.readyState==4 && xhr.status==200) { 
                console.log(xhr.responseText);                              
                document.body.style.cursor = 'default';
                document.getElementById("imputCat1").innerHTML = " ";
            }
        }
        xhr.send(formData);
    }
    else{
        console.log('No se pudo instanciar el objeto AJAX!');
    }
}

function getDataForm(idForm){
    // obtiene los name y los value de los elementos de un formulario.
    // y retorna un objeto FormData()
    var formData = new FormData();

    data=document.forms[idForm].getElementsByTagName("input");
    for (let i=0; i<data.length;i++) {
        if (data[i].name!=undefined && data[i].value!=undefined)
            if (data[i].type=='text'){
                //console.log(data[i].value);
                formData.append(data[i].name, data[i].value);
            }
    }
return formData;
}

console.log("Se establecio la conexion con AJAX 2");
