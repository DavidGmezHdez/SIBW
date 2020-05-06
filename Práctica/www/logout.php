<?php


    session_start();

    session_destroy();

    header("refresh:2;url=index.php");
    echo 'Cerrando sesión';

    exit();

?>