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
    
    if($usuario['rol'] >= 3 && $logueado){
        $usuarios = $con->getAllUsuarios();
    }



    if($_SERVER['REQUEST_METHOD'] === 'POST') {        
        if($usuario['rol'] >= 3 && $logueado){
            if(isset($_POST['id']) && isset($_POST['rol'])){
                $rol = $_POST['rol'];
                $usu = $_POST['id'];


                switch($rol){
                    case 'Normal':
                        $con->cambiarRol($usu,0);
                    break;
                    
                    case 'Moderador':
                        $con->cambiarRol($usu,1);
                    break;

                    case 'Gestor':
                        $con->cambiarRol($usu,2);
                    break;

                    case 'Superusuario':
                        $con->cambiarRol($usu,3);
                    break;
                }
                header("Location:usu.php");
            }
        }    
    }



    echo $twig->render('usu.html',['logueado'=>$logueado,'usuario'=>$usuario,'usuarios'=>$usuarios]);

?>