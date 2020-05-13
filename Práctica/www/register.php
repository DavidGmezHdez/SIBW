<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $pass2 = $_POST['pass2'];

        if(isset($_FILES['imagen'])){
            $file_name = $_FILES['imagen']['name'];
            $file_size = $_FILES['imagen']['size'];
            $file_tmp = $_FILES['imagen']['tmp_name'];
            $file_type = $_FILES['imagen']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
        }

        $extensiones = array("png","jpg","jpeg");

        if(in_array($file_ext,$extensiones)===false){
            $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
        }

        if($file_size > 2097152){
            $errors[] = "Tamaño del fichero demasiado grande";
        }

        if($pass != $pass2){
            $errors[] = "Las contraseñas no son iguales";
        }
            
        if(empty($errors)){
            move_uploaded_file($file_tmp,"img/avatares/imagenPerfil" . $nick);
            $path = strval("img/avatares/imagenPerfil" . $nick);
            
            if($con->register($nick,$pass,$path,$email)){
                header("Location:login.php");
            }
        }
        else{
            echo $twig->render('register.html',['errors'=>$errors]);
        }
    }

    echo $twig->render('register.html',$errors);
?>