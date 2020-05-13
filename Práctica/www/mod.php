<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
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


    if ($usuario['rol']>=1){
        $comentarios = $con->getComentariosPorEventos();
    }

    echo $twig->render('mod.html',['logueado'=>$logueado,'usuario'=>$usuario,'comentarios'=>$comentarios]);

?>