<?php
class login{
    private $_conexion;
    private $_idusuario;
    private $_correousuario;
    private $_hashedclaveusuario;
    private $_nombreusuario;
    private $_idrolusuario;
    
    function __construct($conexion, $correo, $clave){
        $this->_conexion  = $conexion;
        $this->_correousuario  = $correo;
        $this->_hashedclaveusuario  = hash('sha256',$clave);
    }

    function verificarusuario(){
        $verificacion = mysqli_query($this->_conexion,"SELECT idusuario, nombreusuario, idrolusuario FROM usuario WHERE correousuario LIKE '$this->_correousuario' AND CONVERT(claveusuario, CHAR(100)) LIKE '$this->_hashedclaveusuario'") or die(mysqli_error($this->_conexion));
       // echo "SELECT idusuario, nombreusuario, idrolusuario FROM usuario WHERE correousuario LIKE '$this->_correousuario' AND CONVERT(claveusuario, CHAR(100)) LIKE '$this->_hashedclaveusuario'"; 

        if(mysqli_num_rows($verificacion)){
            $unusuario = mysqli_fetch_array($verificacion);
            $this->_idusuario = $unusuario["idusuario"];
            $this->_nombreusuario = $unusuario["nombreusuario"];
            $this->_idrolusuario = $unusuario["idrolusuario"];
            return true;
        }
        return false;
    }
    function getidusuario(){
        return $this->_idusuario;
    }
    function getnombreusuario(){
        return $this->_nombreusuario;
    }
    function getidrolusuario(){
        return $this->_idrolusuario;
      }
    }
    ?>