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

    if(isset($_GET['ev'])){
        $idEvento = (int) $_GET['ev'];
        $evento = $con->getEvento($idEvento);
    }

    if(isset($_GET['coment'])){
        $idComentario = (int) $_GET['coment'];
        $comentario = $con->getComentario($idComentario,$idEvento);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($usuario['rol']>=1 && $logueado){
            if(isset($_POST['nuevoComentario'])){
                $nuevoComentario = $_POST['nuevoComentario'];
                $con->modificarComentario($idComentario,$idEvento,htmlspecialchars($nuevoComentario));
                header("Location: http://localhost/evento.php?ev=$idEvento");
                echo "Comentario modificado";
            }
        }
    }




    echo $twig->render('modify.html',['logueado'=>$logueado,'usuario'=>$usuario,'evento'=>$evento,'comentario'=>$comentario]);

?>