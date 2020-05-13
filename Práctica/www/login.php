<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        

        if(!$con->checkLogin($email,$pass)){
            $errors[] = "Los datos no coinciden";
        }

        if(empty($errors)){
            session_start();
            
            $_SESSION['usuario'] = $email;
            $_SESSION['logueado'] = true;
            header("Location:index.php");
        }
        else{
            echo $twig->render('login.html',['errors'=>$errors]);
        }
    }

    echo $twig->render('login.html',['errors'=>$errors]);
?>