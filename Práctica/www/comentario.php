<?php
    include("bd.php");

    $con = new SIBWBD();
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        

        $idEvento = (int)$_POST['idevento'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $coment = $_POST['coment'];

        loadComentario($idEvento,$name,$email,$coment);
        $extra = 'evento.php';
        header("Location: http://localhost/$extra?ev=$idEvento");

    }

    exit;

?>