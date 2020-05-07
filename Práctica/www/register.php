<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];

        if(isset($_FILES['imagen'])){
            $errors = array();
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

        if(empty($errors)===true){
            move_uploaded_file($file_tmp,"img/avatares/" . $file_name);
            $path = strval("img/avatares/" . $file_name);
            
            if($con->register($nick,$pass,$path,$email)){
                header("refresh:2;url=login.php");
                echo "Usuario registrado" ;
            }
            else{
                header("Location: index.php");
            }
        }
        else{
            echo $errors;
        }
        


        exit;
    }

    echo $twig->render('register.html',[]);
?>