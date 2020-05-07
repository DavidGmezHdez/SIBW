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


    function loadEvento($idEvento){
        if(is_int($idEvento)){
    
            $resultado = $this->$con->query("SELECT titulo, autor, fecha, descripcion, imagen1, imagen2 FROM eventos WHERE idEvento =". $idEvento);
            if($resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                $titulo = $row['titulo'];
                $autor = $row['autor'];
                $fecha = $row['fecha'];
                $descripcion = $row['descripcion'];
                $imagen1 = $row['imagen1'];
                $imagen2 = $row['imagen2'];
            }
    
    
            $resultado = $this->$con->query("SELECT usuario,fecha,comentario FROM comentarios WHERE idEvento =". $idEvento);
            
            if($resultado->num_rows > 0){
                $contador = 0;
                while($row = $resultado->fetch_assoc()){
                    $comentarios [$contador] = [$row['usuario'],$row['fecha'],$row['comentario']];
                    $contador = $contador + 1;
                }
            }
    
        }
    
        $evento = array('idEvento'=>$idEvento, 'titulo'=>$titulo, 'autor'=>$autor, 'fecha'=>$fecha, 'descripcion'=>$descripcion, 'imagen1'=>$imagen1, 'imagen2'=>$imagen2,'comentarios'=>$comentarios);
        return $evento;
    }
    
    
    
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
            $resultado = $this->$con->query("INSERT INTO comentarios VALUES('$idevento','$nuevoIdComentario','$name','$date','$coment')");
        }
    }


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

    function loadUsuario($email){
        $resultado = $this->$con->query("SELECT * FROM usuarios WHERE email='" . $email . "'");
        $usuario = array();

        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            $usuario = array('idUsuario'=>$row['idUsuario'],'nick'=>$row['nick'],'email'=>$row['email'],'pass'=>$row['pass'],'avatar'=>$row['avatar'],'rol'=>$row['rol']);
        }
        return $usuario;
    }

    function cambiarNick($email, $nuevoNick){
        $resultado = $this->$con->query("UPDATE usuarios SET nick='$nuevoNick' WHERE email='" . $email . "'");
    }

    function cambiarEmail($email, $nuevoEmail){
        $resultado = $this->$con->query("UPDATE usuarios SET email='$nuevoEmail' WHERE email='" . $email . "'");
    }

    function cambiarPass($email, $pass){
        $nuevaPass = password_hash($pass,PASSWORD_DEFAULT);
        $resultado = $this->$con->query("UPDATE usuarios SET pass='$nuevaPass' WHERE email='" . $email . "'");
    }


}

?>