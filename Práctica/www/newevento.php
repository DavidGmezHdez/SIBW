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


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

        if(isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['fecha']) && isset($_POST['descripcion'])){
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $fecha = preg_replace("([^0-9/])", "", $_POST['fecha']);
            $descripcion = $_POST['descripcion'];
        }

        $eventos = $con->getAllEventos();
        $neventos = count($eventos);
        
        $ultimoEvento = end($eventos);
        $idNuevoEvento = $ultimoEvento['idEvento'] + 1;


        $carpeta = "img/eventos/evento".$idNuevoEvento;
        if(!is_dir($carpeta)){
            mkdir($carpeta);
        }

        if(isset($_FILES['portada'])){
            $errors = array();
            $file_name = $_FILES['portada']['name'];
            $file_size = $_FILES['portada']['size'];
            $file_tmp = $_FILES['portada']['tmp_name'];
            $file_type = $_FILES['portada']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['portada']['name'])));

            $extensiones = array("png","jpg","jpeg");

            if(empty($errors)===true){
                move_uploaded_file($file_tmp,"img/eventos/evento".$idNuevoEvento."/portada-evento".$idNuevoEvento.".png");
                $portada = strval("img/eventos/evento".$idNuevoEvento."/portada-evento".$idNuevoEvento.".png");
            }
        }
        else{
            $portada = null;
        }



        if(isset($_FILES['imagen1'])){
            $errors = array();
            $file_name = $_FILES['imagen1']['name'];
            $file_size = $_FILES['imagen1']['size'];
            $file_tmp = $_FILES['imagen1']['tmp_name'];
            $file_type = $_FILES['imagen1']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagen1']['name'])));

            $extensiones = array("png","jpg","jpeg");

            if(in_array($file_ext,$extensiones) && $file_size < 2097152){
                move_uploaded_file($file_tmp,"img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-1.png");
                $imagen1 = strval("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-1.png");
            }
        }
        else{
            $imagen1 = null;
        }

        if(isset($_FILES['imagen2'])){
            $errors = array();
            $file_name = $_FILES['imagen2']['name'];
            $file_size = $_FILES['imagen2']['size'];
            $file_tmp = $_FILES['imagen2']['tmp_name'];
            $file_type = $_FILES['imagen2']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagen2']['name'])));

            $extensiones = array("png","jpg","jpeg");

            if(in_array($file_ext,$extensiones) && $file_size < 2097152){
                move_uploaded_file($file_tmp,"img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-2.png");
                $imagen2 = strval("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-2.png");
            }
        }
        else{
            $imagen2 = null;
        }

        if($con->loadEvento($idNuevoEvento,$titulo,$autor,$fecha,$descripcion,$portada,$imagen1,$imagen2)){
                header("refresh:2;url=index.php");
                echo "Evento creado" ;
        }
        else{
            header("Location: index.php");
        }
        exit;
    }


    echo $twig->render('newevento.html',['logueado'=>$logueado,'usuario'=>$usuario,'evento'=>$evento]);

?>