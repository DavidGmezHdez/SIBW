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
    function loadEvento($idEvento){
        if(is_int($idEvento)){
    
            $resultado = $this->$con->query("SELECT titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
            $evento = array('id' => -1,'titulo'=>'Titulo Evento', 'autor' => 'Autor Evento', 'fecha' => date("Y-m-d"), 'descripcion' => 'Descricion Evento', 'image1' => 'Ruta imagen 1', 'imagen2' => 'Ruta imagen 2');
            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                $titulo = $row['titulo'];
                $autor = $row['autor'];
                $fecha = $row['fecha'];
                $descripcion = $row['descripcion'];
                $imagen1 = $row['imagen1'];
                $imagen2 = $row['imagen2'];
            }
    
    

    
        }
    
        $evento = array('idEvento'=>$idEvento, 'titulo'=>$titulo, 'autor'=>$autor, 'fecha'=>$fecha, 'descripcion'=>$descripcion, 'imagen1'=>$imagen1, 'imagen2'=>$imagen2,'comentarios'=>$comentarios);
        return $evento;
    }

    //Función para obtener un evento en base a un id
    function getEvento($idEvento){
        $evento = array('idEvento' => -1,'titulo'=>'Titulo Evento', 'autor' => 'Autor Evento', 'fecha' => date("Y-m-d"), 'descripcion' => 'Descricion Evento', 'imagen1' => 'Ruta imagen 1', 'imagen2' => 'Ruta imagen 2');
        if(is_int($idEvento)){
            $resultado = $this->$con->query("SELECT idEvento, titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                $evento = array('idEvento' => $row['idEvento'],'titulo'=>$row['titulo'], 'autor' => $row['autor'], 'fecha' => $row['fecha'], 'descripcion' => $row['descripcion'], 'imagen1' => $row['imagen1'], 'imagen2' => $row['imagen2']);
            }
        }
        return $evento;
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
        $resultado = $this->$con->query("SELECT idComentario,usuario,fecha,comentario FROM comentarios WHERE idEvento =". $idEvento);
        
        if($resultado->num_rows > 0){
            $contador = 0;
            while($row = $resultado->fetch_assoc()){
                $comentarios [$contador] = $row;
                $contador = $contador + 1;
            }
        }
        return $comentarios;
    }

    //Función que modifica un comentario en la BD
    function modificarComentario($idComentario,$idEvento,$texto){
        $resultado = $this->$con->query("UPDATE comentarios SET comentario='$texto', moderado = 1 WHERE idComentario='" . $idComentario . "' and idEvento='" . $idEvento . "'" );
        
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


}

?>