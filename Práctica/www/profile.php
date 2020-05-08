<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $logueado = false;

    $con = new SIBWBD();


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(!empty($_POST['nuevoNick']) && is_string($_POST['nuevoNick'])){
            $nuevoNick = $_POST['nuevoNick'];

            $con->cambiarNick($_SESSION['usuario'],$nuevoNick);
            header("refresh:2;url=profile.php");
            echo "Nick cambiado";
        }

        if(!empty($_POST['nuevoEmail']) && is_string($_POST['nuevoEmail'])){
            $nuevoEmail = $_POST['nuevoEmail'];

            $con->cambiarEmail($_SESSION['usuario'],$nuevoEmail);
            $_SESSION['usuario'] = $nuevoEmail;
            header("refresh:2;url=profile.php");
            echo "Email cambiado";
        }

        if(!empty($_POST['nuevaPass'])  && !empty($_POST['nuevaPassConfirmación'])){
            if( is_string($_POST['nuevaPass']) && is_string($_POST['nuevaPassConfirmación']) && $_POST['nuevaPass'] == $_POST['nuevaPassConfirmación'] ){
                $nuevaPass = $_POST['nuevaPass'];

                $con->cambiarPass($_SESSION['usuario'],$nuevaPass);
                session_destroy();
                header("refresh:3;url=login.php");
                echo "Contraseña cambiada | Inicia sesión con la nueva contraseña";
            }
            else{
                header("refresh:3;url=profile.php");
                echo "Error las contraseñas no coinciden";
            }
        }
    }

    if(isset($_SESSION['usuario'])){
        $usuario = $con->loadUsuario($_SESSION['usuario']);
    }
    
    if(isset($_SESSION['logueado'])){
        $logueado = true;
    }
    
    echo $twig->render('profile.html',['usuario'=>$usuario,'logueado'=>$logueado]);
    
?>