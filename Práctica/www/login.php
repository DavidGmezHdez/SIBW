<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        

        if($con->checkLogin($email,$pass)){
            session_start();
            
            $_SESSION['usuario'] = $email;
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