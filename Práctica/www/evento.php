<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $tituloEvento ="Titulo por defecto";
    $fechaEvento ="Fecha por defecto";
    $autorEvento = "Autor por defecto";

    if(isset($_GET['ev'])){
        $idEvento = (int) $_GET['ev'];
    }else {
        $idEvento = -1;
    }


    $evento = loadEvento($idEvento);
    $censuradas = loadCensuradas();
    $galeria = loadGaleria();

    echo $twig->render('evento.html',['evento'=>$evento,'censuradas'=>$censuradas, 'galeria'=>$galeria]);

?>