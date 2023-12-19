<?php
include 'AuxPHP/Generar-Pag/Head.php';
include 'AuxPHP/Generar-Pag/Pagina.php';

function GenerarPag(){
    $head = $body = Null;
    $head = fun_head("quick-pic.com/login",'../CSS/Iniciar sesion.css',"../Javascript_php.js");
    $body = <<<BODY
        <body>
            <header>
                <div id="encabezado">
                    <a href="Inicio.php">
                        <img src="Archivos/Inicio/01LogoLargo.png" alt="Logo" id="log02" class="logos   log" width=165 height=41>
                    </a>
                    <a type="button" class="button" id="b03" href="Registro.php">Registro</a>
                </div>
            </header>
            <div class="form-inicio"> 
                <form name="form-inicio" onsubmit="return valLogIn()" action='auxPHP/Login Verificacion.php' method="post" name="usuario" > 
                    <h1 id="titulo02">Acceder a la cuenta</h1>
                    <hr>
                    <label> Mail: </label>
                    <input required class="text01" type="text" id="input01" name="mail" placeholder="example@gmail.com"> <br>
                    <label> Contraseña: </label>
                    <input required class="text01" type="password" id="input02" name="pass" placeholder="password"> <br>
                    <input type="checkbox" onclick="showPassword()">Show Password <br>
                    <div>
                        <input type="submit" class="boton, boton_inicio" id="b04" href="login.php" value= "Iniciar sesion">
                        <input type="reset" value="Borrar" class="boton, boton_inicio" id="b05"></input>
                    </div>
                </form>
            </div>
        </body>
        BODY;
    $pagina = fun_pag($head,$body);
    return $pagina;

}

function main(){
    if(isset($_SESSION['usuario'])){
        header("Location: Pagina principal.php");
    }
    echo(GenerarPag());
}
main();
?>

