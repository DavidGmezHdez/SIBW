<?php


    include("bd.php");

    $con = new SIBWBD();
    session_start();
    $logueado = false;

    if(isset($_SESSION['logueado'])){
        $logueado = true;
    }

    if(isset($_SESSION['usuario'])) {
        $usuario = $con->loadUsuario($_SESSION['usuario']);
    }


    if ($usuario['rol']>=2){
        $eventos = $con->buscarEventoGestor($_GET['titulo']);
    }else{
        $eventos = $con->buscarEvento($_GET['titulo']);
    }
    
    
    
    
    echo (json_encode($eventos));

?>