<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $logueado = false;

    $con = new SIBWBD();

    $errors = [];
    
    if(isset($_SESSION['usuario'])){
        $usuario = $con->loadUsuario($_SESSION['usuario']);
    }
    
    if(isset($_SESSION['logueado'])){
        $logueado = true;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(!empty($_POST['nuevoNick']) && is_string($_POST['nuevoNick']) && isset($_POST['nuevoNick'])){
            $nuevoNick = $_POST['nuevoNick'];
        }

        if(!empty($_POST['nuevoEmail']) && is_string($_POST['nuevoEmail']) && isset($_POST['nuevoEmail'])){
            $nuevoEmail = $_POST['nuevoEmail'];
        }

        if(!empty($_POST['nuevaPass'])  && !empty($_POST['nuevaPassConfirmación']) && is_string($_POST['nuevaPass']) && is_string($_POST['nuevaPassConfirmación'])){
            $nuevaPass = $_POST['nuevaPass'];
            $nuevaPassConfirm = $_POST['nuevaPassConfirmación'];
            if($nuevaPass != $nuevaPassConfirm){
                $errors[] = "Las contraseñas no son iguales";
            }
        }

        
        if(empty($errors)){
            $con->modificarInformacionUsuario($usuario['email'],$nuevoNick,$nuevaPass,$nuevoEmail);
            header("Location:profile.php");
        }
        else{
            echo $twig->render('profile.html',['usuario'=>$usuario,'logueado'=>$logueado,'errors'=>$errors]);
        }
    }


    
    echo $twig->render('profile.html',['usuario'=>$usuario,'logueado'=>$logueado,'errors'=>$errors]);
    
?>