
<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start(); // COmprueba si se ha inicializado una sesion con anterioridad
                     // EN caso afirmativo rrellena $_SESSION con la información que tenia

    if(!isset($_SESSION['count'])){
        $_SESSION['count'] = 1;
    }
    else{
        $_SESSION['count']++;
    }

    echo $twig->render('evento.html',['evento'=>$evento,'censuradas'=>$censuradas, 'galeria'=>$galeria]);



?>

