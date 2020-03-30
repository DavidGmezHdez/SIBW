<?php
    include("bd.php");


    $idEvento = (int)$_POST['idevento'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $coment = $_POST['coment'];

    loadComentario($idEvento,$name,$email,$coment);

    $host  = $_SERVER['HTTP_HOST'];
    $extra = 'evento.php';
    header("Location: http://localhost/$extra?ev=$idEvento");
    exit;

?>