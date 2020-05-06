<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
        

        if($con->checkLogin($nick,$pass)){
            session_start();
            
            $_SESSION['usuario'] = $nick;
            $_SESSION['logueado'] = true;
            header("refresh:2;url=index.php");
            echo "Usuario logueado" ;
        }
        else{
            header("Location: login.php");
        }
        exit;
    }

    echo $twig->render('login.html',[]);
?>