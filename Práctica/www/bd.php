<?php

function conectarBD()
{
    $conexion = new mysqli("mysql","davidgmezhdez","tigre","SIBW");
    if($conexion->connect_errno)
    {
        echo("Fallo al conectar: ". $conexion->connect_error);
    }

    return  $conexion;
}


function loadEvento($idEvento){
    $conexion = conectarBD();
    if(is_int($idEvento)){

        $resultado = $conexion->query("SELECT titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            $titulo = $row['titulo'];
            $autor = $row['autor'];
            $fecha = $row['fecha'];
            $descripcion = $row['descripcion'];
            $imagen1 = $row['imagen1'];
            $imagen2 = $row['imagen2'];
        }


        $resultado = $conexion->query("SELECT usuario,fecha,comentario FROM comentarios WHERE idEvento =". $idEvento);
        
        if($resultado->num_rows > 0){
            $contador = 0;
            while($row = $resultado->fetch_assoc()){
                $comentarios [$contador] = [$row['usuario'],$row['fecha'],$row['comentario']];
                $contador = $contador + 1;
            }
        }

    }

    $conexion->close();
    $evento = array('idEvento'=>$idEvento, 'titulo'=>$titulo, 'autor'=>$autor, 'fecha'=>$fecha, 'descripcion'=>$descripcion, 'imagen1'=>$imagen1, 'imagen2'=>$imagen2,'comentarios'=>$comentarios);
    return $evento;
}



function loadCensuradas(){
    $conexion = conectarBD();
    $resultado = $conexion->query("SELECT palabra FROM palabrascensuradas");

    
    
    if($resultado->num_rows > 0){
        $contador = 0;
        while($row = $resultado->fetch_assoc()){
            $palabras[$contador] = [$row['palabra']];
            $contador = $contador + 1;
        }
    }

    $conexion->close();
    return $palabras;
}


function loadGaleria(){
    $conexion = conectarBD();
    $resultado = $conexion->query("SELECT titulo,imagen FROM galeria");
    if($resultado->num_rows > 0){
        $contador = 0;
        while($row = $resultado->fetch_assoc()){
            $imagenes [$contador] = [$row['titulo'],$row['imagen']];
            $contador = $contador + 1;
        }
    }

    $conexion->close();
    return $imagenes;
}



function loadComentario($idevento,$name,$email,$coment){
    $conexion = conectarBD();

    if(is_int($idevento) && is_string($name) && is_string($email) && is_string($coment)){
        $resultado = $conexion->query("SELECT idComentario FROM comentarios WHERE idEvento= ". $idevento);

        if($resultado->num_rows > 0){
            while($row=$resultado->fetch_assoc()){
                $idCom = $row['idComentario'];
            }
        }

        $nuevoIdComentario = $idCom + 1;

        $date = date('Y-m-d');
        $resultado = $conexion->query("INSERT INTO comentarios VALUES('$idevento','$nuevoIdComentario','$name','$date','$coment')");

        $conexion->close();

    }





    
}

?>