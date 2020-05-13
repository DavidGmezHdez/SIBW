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
    $con = new SIBWBD();


    if(isset($_SESSION['logueado'])){
        $logueado = true;
    }

    if(isset($_SESSION['usuario'])) {
        $usuario = $con->loadUsuario($_SESSION['usuario']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $idEvento = (int)$_POST['idevento'];
        $name = $usuario['nick'];
        $email = $_SESSION['usuario'];
        $coment = $_POST['coment'];

        $con->loadComentario($idEvento,$name,$email,$coment);   
        header("Location: http://localhost/evento.php?ev=$idEvento");

    }

    if(isset($_GET['ev'])){
        $idEvento = (int) $_GET['ev'];
    }else {
        $idEvento = -1;
    }

    if($idEvento!=-1 && $logueado && $usuario['rol'] >= 1){
        if(isset($_GET['coment']) && isset($_GET['borrar']) && $_GET['borrar'] == true){
            $idComentario = $_GET['coment'];
            $con->borrarComentario($idComentario, $idEvento);
            header("Location: http://localhost/evento.php?ev=$idEvento");
        }
    }


    $evento = $con->getEvento($idEvento);
    $censuradas = $con->loadCensuradas();
    $galeria = $con->loadGaleria();
    $comentarios = $con->getComentarios($idEvento);
    $etiquetas = $con->getEtiquetasPorEvento($idEvento);

    echo $twig->render('evento.html',['evento'=>$evento,'censuradas'=>$censuradas, 'galeria'=>$galeria, 'logueado'=>$logueado, 'usuario'=>$usuario, 'comentarios'=>$comentarios,'etiquetas'=>$etiquetas]);

?>