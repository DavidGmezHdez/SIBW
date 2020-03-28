<?php

function conectarBD()
{
    $mysqli = new mysqli("mysql","davidgmezhdez","tigre","SIBW");
    if($mysqli->connect_errno)
    {
        echo("Fallo al conectar: ". $mysqli->connect_error);
    }

    return  $mysqli;
}


function loadEvento($idEvento){
    $mysqli = conectarBD();
    if(is_int($idEvento)){

        $res = $mysqli->query("SELECT titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $titulo = $row['titulo'];
            $autor = $row['autor'];
            $fecha = $row['fecha'];
            $descripcion = $row['descripcion'];
            $imagen1 = $row['imagen1'];
            $imagen2 = $row['imagen2'];
        }


        $res = $mysqli->query("SELECT usuario,fecha,comentario FROM comentarios WHERE idEvento =". $idEvento);
        
        if($res->num_rows > 0){
            $contador = 0;
            while($row = $res->fetch_assoc()){
                $comentarios [$contador] = [$row['usuario'],$row['fecha'],$row['comentario']];
                $contador = $contador + 1;
            }
        }

    }

    $mysqli->close();
    $evento = array('idEvento'=>$idEvento, 'titulo'=>$titulo, 'autor'=>$autor, 'fecha'=>$fecha, 'descripcion'=>$descripcion, 'imagen1'=>$imagen1, 'imagen2'=>$imagen2,'comentarios'=>$comentarios);
    return $evento;
}

?>