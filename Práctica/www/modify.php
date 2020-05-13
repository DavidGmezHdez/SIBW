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

    if(isset($_GET['tipo'])){
        $tipoMod = $_GET['tipo'];
    }
    if(isset($_GET['coment'])){
        $idComentario = (int) $_GET['coment'];
        $comentario = $con->getComentario($idComentario,$idEvento);
    }

    //Formulario para el comentario
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($usuario['rol']>=1 && $logueado && $tipoMod == 1){
            if(isset($_POST['nuevoComentario'])){
                $nuevoComentario = $_POST['nuevoComentario'];
                $con->modificarComentario($idComentario,$idEvento,htmlspecialchars($nuevoComentario));
                header("Location: http://localhost/evento.php?ev=" . $idEvento);
                echo "Comentario modificado";
            }
        }
    }

    //Formulario para el evento
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($usuario['rol']>=2 && $logueado && $tipoMod == 2){
            
            if(isset($_POST['titulo']) && is_string($_POST['titulo']) && !empty($_POST['titulo'])){
                $nuevoTitulo = $_POST['titulo'];
            }

            if(isset($_POST['autor']) && is_string($_POST['autor']) && !empty($_POST['autor'])){
                $nuevoAutor = $_POST['autor'];
            }

            if(isset($_POST['fecha']) && is_string($_POST['fecha']) && !empty($_POST['fecha'])){
                $nuevaFecha = preg_replace("([^0-9/])", "", $_POST['fecha']);
            }

            if(isset($_POST['descripcion']) && is_string($_POST['descripcion']) && !empty($_POST['descripcion'])){
                $nuevaDescripcion =  $_POST['descripcion'];
            }


            if(isset($_FILES['portada'])){
                $errors = array();
                $file_name = $_FILES['portada']['name'];
                $file_size = $_FILES['portada']['size'];
                $file_tmp = $_FILES['portada']['tmp_name'];
                $file_type = $_FILES['portada']['type'];
                $file_ext = strtolower(end(explode('.',$_FILES['portada']['name'])));
    
                $extensiones = array("png","jpg","jpeg");
                if(in_array($file_ext,$extensiones) && $file_size < 2097152){
                    array_map('unlink', glob("img/eventos/evento".$idNuevoEvento."/portada-evento".$idNuevoEvento.".png"));
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
                    if(file_exists("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-1.png")) unlink("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-1.png");
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
                    if(file_exists("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-2.png")) unlink("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-2.png");
                    move_uploaded_file($file_tmp,"img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-2.png");
                    $imagen2 = strval("img/eventos/evento".$idNuevoEvento."/imagen-evento".$idNuevoEvento."-2.png");
                }
            }
            else{
                $imagen2 = null;
            }

            $con->modificarInformacionEvento($idEvento,$nuevoTitulo,$nuevoAutor,$nuevaFecha,$nuevaDescripcion,$portada,$imagen1,$imagen2);
            header("Location: http://localhost/evento.php?ev=" . $idEvento);
            echo "Evento modificado";
        }
    }




    echo $twig->render('modify.html',['logueado'=>$logueado,'usuario'=>$usuario,'evento'=>$evento,'comentario'=>$comentario, 'tipoMod'=>$tipoMod]);

?>