<?php
include 'AuxPHP/Generar-Pag/Head.php';
include 'AuxPHP/Generar-Pag/Pagina.php';

function GenerarPag(){
    $head = $body = Null;
    $head = fun_head("quick-pic.com/Registro",'../CSS/Iniciar sesion.css',"../Javascript_php.js");
    $body = <<<BODY
    <body>     
        <header>
            <div id="encabezado">
                <a href="Inicio.php">
                    <img src="Archivos/Inicio/01LogoLargo.png" alt="Logo" id="log04" class="logos log" width=165 height=41>
                </a>
                <a type="button" class="button  btn" id="b06" href="login.php">Iniciar sesion</a>
            </div>
        </header>
        <div class="form-registro"> 
            <form name="form-registro" onsubmit="return valRegistro()" action='auxPHP/Creacion Usuario.php' method="post" name="usuario"> 
                <h1 id="titulo03">Registro</h1>
                <hr class="corte">
                <label> Nombre de usuario </label>
                <input class="text02" type="text" id="input03" name="nombre" placeholder="Ingrese un nombre" maxlength="30"> <br>
                <label> Email </label>
                <input class="text02" type="email" id="input04" name="mail" placeholder="example@gmail.com" maxlength="130"> <br>
                <label> Contraseña </label>
                <input class="text02" type="password" id="input05" name="pass1" placeholder="contraseña" maxlength="50"> <br>
                <label> Confirmar contraseña </label>
                <input class="text02" type="password" id="input06" name="pass2" placeholder="contraseña" maxlength="50"> <br>
                <label> Fecha de nacimiento </label>
                <input class="text02" type="date" id="input07" name="fecha" /> <br>
                <label> Numero de telefono </label> 
                <input class="text02" type=" tel" id="input08" name="telefono" placeholder="+11 2233 4455" maxlength="15"> <br>
                <input type="submit" class="boton" href="" value= "Crear Cuenta">
                <div class="marcoImputs">
                    <p> <a href="login.php" class="b07"> Ya tengo cuenta </a>  </p> 
                </div>
            </form>
        </div>
    </body>

    BODY;
    $pagina = fun_pag($head,$body);
    return $pagina;

}

function main(){
    session_start();//Si no se escribe esta linea de codigo, no se puede usar $_SESSION
    if(isset($_SESSION['mail'])){
        header("Location: Pagina principal.php");
    } 
    echo(GenerarPag());
}
main();
?>

