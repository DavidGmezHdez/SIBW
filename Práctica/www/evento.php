<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $tituloEvento ="Titulo por defecto";
    $fechaEvento ="Fecha por defecto";
    $autorEvento = "Autor por defecto";

    session_start();
    $logueado = false;


    if(isset($_SESSION['logueado'])){
        $logueado = true;
    }

    if(isset($_GET['ev'])){
        $idEvento = (int) $_GET['ev'];
    }else {
        $idEvento = -1;
    }

    $con = new SIBWBD();

    $evento = $con->loadEvento($idEvento);
    $censuradas = $con->loadCensuradas();
    $galeria = $con->loadGaleria();

    echo $twig->render('evento.html',['evento'=>$evento,'censuradas'=>$censuradas, 'galeria'=>$galeria, 'logueado'=>$logueado]);

?>