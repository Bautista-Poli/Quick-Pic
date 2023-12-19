<?php
include 'AuxPHP/Generar-Pag/Head.php';
include 'AuxPHP/Generar-Pag/Pagina.php';

function GenerarPag(){
    $head = $body = Null;
    $head = fun_head("quick-pic.com/inicio",'../CSS/Iniciar sesion.css',"NULL");
    $body = <<<BODY
        <body>
            <section id="Secccion 1">
                <header>
                    <img src="Archivos/Inicio/01LogoLargo.png" alt="Logo" class="logos" id="log01" width=165 height=41>
                    <div>
                        <a type="button" class="button" id="b01" href="login.php">Iniciar sesion</a>
                        <a type="button" class="button" id="b02" href="Registro.php">Registro</a>
                    </div>
                </header>
                <div class="portada">
                    <img src="Archivos/Inicio/gif de inicio.gif" id="imgi00">
                    <div class="titulo01">
                        <h1 id="t01"  > Encuentra lo que </h1>
                        <h1 id="t02" > estabas buscando </h1>  
                    </div>
                </div>
                <div id ="container">
                    <a href="#Secccion 2" class="redirector"><img src="Archivos/Inicio/flecha.png" width=100% id="imgi01" class="flecha"></a>
                </div>
            </section>



            <section id="sec2">
                <p id="Secccion 2"></p>
                <div id="infoi">
                    <div id="izq_inicio">
                        <img src="Archivos/Inicio/info-foto.jpeg" id="imgi02">
                    </div>
                    <div id="der_inicio">
                        <div>
                            <h1 >Que somos?</h1>
                            <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores dolorem expedita sequi animi est vero tempore nesciunt architecto odit. Blanditiis animi laudantium veritatis eveniet nihil obcaecati dolorum suscipit nulla maiores!</p>
                        </div>
                        <div class="parrafo" id="parrafo02">
                            <h1 id="tituloi03">Busca una idea</h1>
                            <p id="p2text01">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet voluptatum natus itaque accusamus! Voluptatum facere aspernatur possimus labore dolor! Ducimus expedita deleniti voluptatem sunt quibusdam animi praesentium. Sapiente, adipisci expedita?</p>
                            <p id="p2text02">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores dolorem expedita sequi animi est vero tempore nesciunt architecto odit. </p>
                        </div>
                    </div>
                    <a href="#Secccion 1" class="redirector"><img src="Archivos/Inicio/flecha-arriba.png" width=100% id="imgi03" class="flecha"></a>
                </div>
            </section>
        </body>
        BODY;
    $pagina = fun_pag($head,$body);
    return$pagina;

}


function main(){
    session_start(); 
    if(isset($_SESSION['usuario'])){
        header("Location: Pagina principal.php");
    }
    
    echo(GenerarPag());
}
main();
?>
