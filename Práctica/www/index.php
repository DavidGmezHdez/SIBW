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

    $eventos = $con->getAllEventos();
    $neventos = count($eventos);

    if($logueado && $usuario['rol'] >= 2){
        if(isset($_GET['ev']) && isset($_GET['borrar']) && $_GET['borrar'] == true){
            $idEvento = $_GET['ev'];
            $con->borrarEvento($idEvento);
            header("Location: http://localhost/index.php");
        }
    }

    echo $twig->render('index.html',['logueado'=>$logueado,'usuario'=>$usuario,'eventos'=>$eventos,'neventos'=>$neventos]);

?>