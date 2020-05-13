<?php

class SIBWBD{

    private  $con;

    public function __construct(){
        $this->$con = new mysqli("mysql","davidgmezhdez","tigre","SIBW");
        if($con->connect_errno)
        {
            echo("Fallo al conectar: ". $con->connect_error);
        }
    }
/*
*       EVENTOS
*/


    //Función para incorporar un evento a la BD (WIP)
    function loadEvento($idNuevoEvento,$titulo,$autor,$fecha,$descripcion,$portada,$imagen1,$imagen2,$etiquetas){
        $resultado = $this->$con->query("SELECT * FROM eventos WHERE titulo='" . $titulo . "'");

        if($resultado->num_rows > 0){
            return false;
        }

        if(is_string($titulo) && is_string($autor) && is_string($fecha) && is_string($descripcion) && is_string($portada)){
            if(isset($imagen1) && is_string($imagen1) && isset($imagen2) && is_string($imagen2)){
                $añadido = $this->$con->query("INSERT INTO eventos (idEvento,titulo,autor,fecha,descripcion,portada,imagen1,imagen2) VALUES ('$idNuevoEvento','$titulo','$autor','$fecha','$descripcion','$portada','$imagen1','$imagen2')");
                return true;
            }
            else{
                $añadido = $this->$con->query("INSERT INTO eventos (idEvento,titulo,autor,fecha,descripcion,portada,imagen1,imagen2) VALUES ('$idNuevoEvento','$titulo','$autor','$fecha','$descripcion','$portada','','')");
                return true;
            }
        }
        return false;
    }

    //Función para obtener un evento en base a un id
    function getEvento($idEvento){
        //$evento = array('idEvento' => -1,'titulo'=>'Titulo Evento', 'autor' => 'Autor Evento', 'fecha' => date("Y-m-d"), 'descripcion' => 'Descricion Evento', 'imagen1' => 'Ruta imagen 1', 'imagen2' => 'Ruta imagen 2');
        if(is_int($idEvento)){
            $resultado = $this->$con->query("SELECT idEvento, titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                $evento = array('idEvento' => $row['idEvento'],'titulo'=>$row['titulo'], 'autor' => $row['autor'], 'fecha' => $row['fecha'], 'descripcion' => $row['descripcion'], 'imagen1' => $row['imagen1'], 'imagen2' => $row['imagen2']);
            }
        }
        return $evento;
    }

    //Función para obtener todos los eventos
    function getAllEventos(){
        $resultado = $this->$con->query("SELECT * FROM eventos");
        $eventos = array();

        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()){
                $eventos[] = $row;
            }
        }

        return $eventos;
    }

    //Función que borra un comentario de la BD
    function borrarEvento($idEvento){
        $resultado = $this->$con->query("DELETE FROM eventos WHERE idEvento='" . $idEvento . "'");
        $carpeta = "img/eventos/evento".$idEvento;
        //echo var_dump(is_dir($carpeta));
        if(is_dir($carpeta)){
            //echo var_dump($files);
            array_map('unlink', glob("$carpeta/*.*"));
            rmdir($carpeta);
        }
    }

    //Funcion que modifica los datos del evento en función del modify
    function modificarInformacionEvento($idEvento,$nuevoTitulo,$nuevoAutor,$nuevaFecha,$nuevaDescripcion,$portada,$imagen1,$imagen2){
        $resultado = $this->$con->query("SELECT idEvento, titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
        if($resultado->num_rows > 0){
            if(isset($nuevoTitulo) && is_string($nuevoTitulo) && !empty($nuevoTitulo)){
                $res = $this->$con->query("UPDATE eventos SET titulo='$nuevoTitulo' WHERE idEvento='" . $idEvento . "'" );
            }

            if(isset($nuevoAutor) && is_string($nuevoAutor) && !empty($nuevoAutor)){
                $res = $this->$con->query("UPDATE eventos SET autor='$nuevoAutor' WHERE idEvento='" . $idEvento . "'" );
            }

            if(isset($nuevaFecha) && is_string($nuevaFecha) && !empty($nuevaFecha)){
                $res = $this->$con->query("UPDATE eventos SET fecha='$nuevaFecha' WHERE idEvento='" . $idEvento . "'" );
            }

            if(isset($nuevaDescripcion) && is_string($nuevaDescripcion) && !empty($nuevaDescripcion)){
                $res = $this->$con->query("UPDATE eventos SET descripcion='$nuevaDescripcion' WHERE idEvento='" . $idEvento . "'" );
            }

            if(isset($portada) && is_string($portada) && !empty($portada)){
                $res = $this->$con->query("UPDATE eventos SET portada='$portada' WHERE idEvento='" . $idEvento . "'" );
            }

            if(isset($imagen1) && is_string($imagen1) && !empty($imagen1)){
                $res = $this->$con->query("UPDATE eventos SET imagen1='$imagen1' WHERE idEvento='" . $idEvento . "'" );
            }

            if(isset($imagen2) && is_string($imagen2) && !empty($imagen2)){
                $res = $this->$con->query("UPDATE eventos SET imagen2='$imagen2' WHERE idEvento='" . $idEvento . "'" );
            }
        }
    }


    
/*
*   PALABRAS CENSURADAS
*/
    
    //Función para obtener las palabras censuradas de la BD (cambiar nombre en el futuro)
    function loadCensuradas(){
        $resultado = $this->$con->query("SELECT palabra FROM palabrascensuradas");
    
        
        
        if($resultado->num_rows > 0){
            $contador = 0;
            while($row = $resultado->fetch_assoc()){
                $palabras[$contador] = [$row['palabra']];
                $contador = $contador + 1;
            }
        }
    
        return $palabras;
    }
    
/*
*   GALERIA
*/
    //Función para obtener las palabras censuradas de la BD (cambiar nombre en el futuro)
    function loadGaleria(){
        $resultado = $this->$con->query("SELECT titulo,imagen FROM galeria");
        if($resultado->num_rows > 0){
            $contador = 0;
            while($row = $resultado->fetch_assoc()){
                $imagenes [$contador] = [$row['titulo'],$row['imagen']];
                $contador = $contador + 1;
            }
        }
    
        return $imagenes;
    }



/*
*   COMENTARIOS
*/
    
    //Función para cargar un comentario en la BD
    function loadComentario($idevento,$name,$email,$coment){
    
        if(is_int($idevento) && is_string($name) && is_string($email) && is_string($coment)){
            $resultado = $this->$con->query("SELECT idComentario FROM comentarios WHERE idEvento= ". $idevento);
            
            if($resultado->num_rows > 0){
                while($row=$resultado->fetch_assoc()){
                    $idCom = $row['idComentario'];
                }
            }
    
            $nuevoIdComentario = $idCom + 1;
    
            $date = date('Y-m-d');
            $res = $this->$con->query("INSERT INTO comentarios (idEvento,idComentario,usuario,fecha,comentario,moderado) VALUES('$idevento','$nuevoIdComentario','$name','$date','$coment',0)");
            echo var_dump($res);
        }
    }

    //Función para obtener un comentario desde la BD en base a su ID y a la ID del evento
    function getComentario($idComentario, $idEvento){
        $resultado = $this->$con->query("SELECT idComentario, idEvento, usuario, fecha, comentario, moderado FROM comentarios WHERE idComentario='" . $idComentario . "' and idEvento='" . $idEvento . "'");
        $comentario = array();

        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            $comentario = array('idComentario' => $row['idComentario'],'idEvento' => $row['idEvento'], 'usuario' => $row['usuario'], 'fecha' => $row['fecha'], 'comentario' => $row['comentario'], 'moderado' => $row['moderado']);           
        }
        return $comentario;
    }

    //FUnción para obtener todos los comentarios de un evento desde la BD
    function getComentarios($idEvento){
        $resultado = $this->$con->query("SELECT idComentario,usuario,fecha,comentario,moderado FROM comentarios WHERE idEvento =". $idEvento);
        
        if($resultado->num_rows > 0){
            $contador = 0;
            while($row = $resultado->fetch_assoc()){
                $comentarios [$contador] = $row;
                $contador = $contador + 1;
            }
        }
        return $comentarios;
    }

    //Función para obtener todos los eventos
    function getComentariosPorEventos(){
        $resultado = $this->$con->query("SELECT idEvento, titulo FROM eventos");
        
        $comentarios = array();

        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $idEvento = $row['idEvento'];
                $resultado2 = $this->$con->query("SELECT idComentario, usuario,fecha,comentario,moderado FROM comentarios WHERE idEvento =". $idEvento);
                if($resultado2->num_rows > 0){
                    while($fila = $resultado2->fetch_assoc())
                        $comentarios[] = ['idEvento'=>$idEvento,'titulo'=>$row['titulo'], 'idComentario'=>$fila['idComentario'],'usuario'=>$fila['usuario'],'fecha'=>$fila['fecha'],'comentario'=>$fila['comentario'],'moderado'=>$fila['moderado']];
                }
            }
        }

        return $comentarios;
    }

    //Función que modifica un comentario en la BD
    function modificarComentario($idComentario,$idEvento,$texto){
        $resultado = $this->$con->query("UPDATE comentarios SET comentario='$texto', moderado = '1' WHERE idComentario='" . $idComentario . "' and idEvento='" . $idEvento . "'" );
    }

    //Función que borra un comentario de la BD
    function borrarComentario($idComentario, $idEvento){
        $resultado = $this->$con->query("DELETE FROM comentarios WHERE idComentario='" . $idComentario . "' and idEvento='" . $idEvento . "'" );
    }

/*
*   USUARIOS
*/

    //Función que comprueba que el email y la contraseña que el introduce el usuario son correctos y corresponde a un usuario
    function checkLogin($email,$pass){
        $resultado = $this->$con->query("SELECT * FROM usuarios WHERE email='" . $email . "'");
        if($resultado->num_rows > 0){
            $row=$resultado->fetch_assoc();
        }

        if(password_verify($pass,$row['pass'])){
            return true;
        }

        return false;
    }

    //Función que registra un usuario en la BD en base a su nick, contraseña, email y avatar (añadir avatar por defecto si el usuario no ha añadido alguno)
    function register($nick,$pass,$avatar,$email){
        $resultado = $this->$con->query("SELECT * FROM usuarios WHERE email='" . $email . "'");

        if($resultado->num_rows > 0){
            return false;
        }

        if(is_string($nick) && is_string($pass) && is_string($avatar) && is_string($email)){
            $pass = password_hash($pass,PASSWORD_DEFAULT);
            $rol = 0;
            
            $registro = $this->$con->query("INSERT INTO usuarios (nick,email,pass,avatar,rol) VALUES ('$nick','$email','$pass','$avatar',$rol)");
            return true;
        }

        return false;
    }

    //Función para obtener un usuario de la BD en base a su email (cambiar nombre en un futuro)
    function loadUsuario($email){
        $resultado = $this->$con->query("SELECT * FROM usuarios WHERE email='" . $email . "'");
        $usuario = array();

        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            $usuario = array('idUsuario'=>$row['idUsuario'],'nick'=>$row['nick'],'email'=>$row['email'],'pass'=>$row['pass'],'avatar'=>$row['avatar'],'rol'=>$row['rol']);
        }
        return $usuario;
    }

    function modificarInformacionUsuario($email,$nick,$pass,$email2){
        $resultado = $this->$con->query("SELECT  nick, pass, email FROM usuarios WHERE email ='". $email . "'");
        if($resultado->num_rows > 0){
            
            if(isset($nick) && is_string($nick) && !empty($nick)){
                $res = $this->$con->query("UPDATE usuarios SET nick='$nick' WHERE email='" . $email . "'");
            }
            
            if(isset($pass) && is_string($pass) && !empty($pass)){
                $nuevaPass = password_hash($pass,PASSWORD_DEFAULT);
                $res = $this->$con->query("UPDATE usuarios SET pass='$nuevaPass' WHERE email='" . $email . "'");
            }

            if(isset($email2) && is_string($email2) && !empty($email2)){
                $res = $this->$con->query("UPDATE usuarios SET email='$email2' WHERE email='" . $email . "'");
            }


        }
    }

    //Función que cambia el nombre de un usuario de la BD
    function cambiarNick($email, $nuevoNick){
        $resultado = $this->$con->query("UPDATE usuarios SET nick='$nuevoNick' WHERE email='" . $email . "'");
    }

    //Función que cambia el email de un usuario de la BD
    function cambiarEmail($email, $nuevoEmail){
        $resultado = $this->$con->query("UPDATE usuarios SET email='$nuevoEmail' WHERE email='" . $email . "'");
    }

    //Función que cambia la contraseña de un usuario de la BD
    function cambiarPass($email, $pass){
        $nuevaPass = password_hash($pass,PASSWORD_DEFAULT);
        $resultado = $this->$con->query("UPDATE usuarios SET pass='$nuevaPass' WHERE email='" . $email . "'");
    }

    function getAllUsuarios(){
        $resultado = $this->$con->query("SELECT * FROM usuarios");
        $usuarios = array();

        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()){
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    function cambiarRol($idUsuario,$rol){
        $resultado = $this->$con->query("UPDATE usuarios SET rol='$rol' WHERE idUsuario='" . $idUsuario . "'");
    }

/*
*   ETIQUETAS
*/

    function addEtiqueta($idEvento,$etiquetas){
        foreach($etiquetas as $etiqueta) {
            $this->$con->query("INSERT INTO etiquetas (idEvento,etiqueta) VALUES ('$idEvento','$etiqueta')");
        }
    }

    function getEtiquetasPorEvento($idEvento){
        $resultado = $this->$con->query("SELECT etiqueta FROM etiquetas WHERE idEvento= " . $idEvento);
        $etiquetas = array();
        
        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()){
                $etiquetas[] = $row['etiqueta'];    
            }
        }

        return $etiquetas;
        
    }


}

?>