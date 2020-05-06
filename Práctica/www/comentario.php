<?php
    include("bd.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $con = new SIBWBD();

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