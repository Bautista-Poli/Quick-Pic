
function showPasswordP() {
    var x = document.getElementById("pass12");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


function openForm(){
    if(document.getElementById("form-profile").innerText == ""){
        document.getElementById("form-profile").innerHTML = formulario;
        //alert("Escriba lo que quiera modificar del perfil");
    }else{
        document.getElementById("form-profile").innerText = ""; 
    }
    
    
}



formulario = 
    '<form id="PerfilFileForm" action="" method="" enctype="multipart/form-data">'+
    '<p class="PerfilTit">Cambiar foto de perfil:</p>'+
    '<input class="PerfilInp" type="file"  name="fileToUpload" id="fileToUpload" >'+ 
    '<br>'+ 
    '<input type="button" value="Subir foto" class="PerfilBtn" onclick="loadContTextAjaxForm(\'Funciones Perfil.php\', \'PerfilArchivoMsj\',\'PerfilFileForm\' )"></input>'+
    '<input type="reset" class="PerfilBtn" value="Borrar"></input>'+
    '<a id="PerfilArchivoMsj"></a>'+
    '</form>'+
    '<form id="f_pass" action="" method="">'+
    '<p class="PerfilTit">Cambiar nombre de usuario:</p>'+
    '<input class="PerfilInp" type="text" name="usuario">'+
    '<br></br>'+
    '<p class="PerfilTit">Cambiar contraseña:</p>'+
    '<input class="PerfilInp" id="pass12" type="password" name="password">'+
    '<br></br>'+
    '<input type="button" id="PerfilMCont" value="Mostrar contraseña" onclick="showPasswordP()" ></input>'+
    '<p class="PerfilTit">Cambiar numero de telefono:</p>'+
    '<input class="PerfilInp" type="text" name="telefono">'+
    '<br></br>'+
    '<input type="button" value="Enviar" class="PerfilBtn" onclick="loadContTextAjaxForm(\'Funciones Perfil.php\', \'PerfilMsj\',\'f_pass\' )"></input>'+
    '<input type="reset" class="PerfilBtn" value="Borrar"></input>'+
    '<a id="PerfilMsj"></a>'+
'</form>';


//AJAX 

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


function loadContTextAjaxForm(url, idDest,idForm,method="POST"){
    var formData =getDataForm(idForm);

    result = document.getElementById("mail-profile").innerText;
    mail=""
    for(i = 0; i< result.length; i++){
        if(i>5){
            mail = mail + result[i];
        }
    }
    formData.append("mail", mail);

    var xhr = conectAjax();   
    if(xhr) {
        xhr.open(method, url, true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                setDataIntoNode(idDest,xhr.responseText)
            }
        }
        xhr.send(formData);
    }
    else{
        console.log('No se pudo instanciar el objeto AJAX!');
    }    
    
}


// ============================================================
// FUNCIONES AUXILIARES
// ============================================================

// ============================================================
// ==== Funciones Auxiliares que no son ajax pero las utilizamos
// ==== para cumplir los objetivos
// ============================================================

function getDataForm(idForm){

    var formData = new FormData();

    //alert("XXX");
    data=document.forms[idForm].getElementsByTagName("input");
    for (let i=0; i<data.length;i++) {
        if (data[i].name!=undefined && data[i].value!=undefined)
            if (data[i].type=='text' || data[i].type=='password'){
                formData.append(data[i].name, data[i].value);
            }
            else if ((data[i].type=='checkbox' || data[i].type=='radio') && data[i].checked){
                formData.append(data[i].name, data[i].value);
            }
            else if (data[i].type=='file'){
                console.log(data[i].name) //fileToUpload
                console.log(data[i].files[0]) //Array con el nombre, el tamaño, el tipo
                formData.append(data[i].name, data[i].files[0]);
            }
    }
return formData;
}

function setDataIntoNode(idDest,textHTML){
    // Esta función se realiza debido a que hay distintas 
    // formas de asginar html a un nodo.
    // idDest: id del nodo que se le cargarán los datos.
    // textHTML: datos a cargar
    let oElement; // objeto
    let sNameTag; // string
    let elementsReadOnlyInnerHTML; // array donde se almacen los tipos de nodos que no tienen innerHTML
    elementsReadOnlyInnerHTML = ["INPUT","COL", "COLGROUP", 
                                 "FRAMESET", "HEAD", "HTML", 
                                 "STYLE", "TABLE", "TBODY", 
                                 "TFOOT", "THEAD", "TITLE", 
                                 "TR"
                                ];
    
    if(document.getElementById(idDest)) {                
        oElement = document.getElementById(idDest);
        sNameTag = oElement.tagName.toUpperCase();
        //console.log("***"+sNameTag);
        if(elementsReadOnlyInnerHTML.indexOf(sNameTag) == -1) {
            oElement.innerHTML = textHTML;
        }
        else if(sNameTag == 'INPUT') {
            oElement.value = textHTML;
        }
        else if(sNameTag.indexOf("TBODY") != -1) {
            setTBodyInnerHTML(oElement, textHTML);
        }
        else {
            console.log('El elemento destino, cuyo id="'+idDest+'", no posee propiedad "innerHTML" ni "value"!');
        }                    
    }
    else {
        console.log('El elemento destino, cuyo id="'+idDest+'", no existe!');
    }    
}

function setTBodyInnerHTML(tbody, html) {
    // agrega el contenido html en tbody
    var temp = tbody.ownerDocument.createElement('div');
    temp.innerHTML = '<table><tbody id="'+tbody.id+'">' + html + '</tbody></table>';
    tbody.parentNode.replaceChild(temp.firstChild.firstChild, tbody);
}



console.log("Se establecio la conexion con AJAX perfil");
