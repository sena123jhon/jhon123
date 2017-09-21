<?php
  class usuario {
      private $_conexion;
      private $_idusuario;
      private $_nombreusuario;
      private $_correousuario;
      private $_claveusuario;
      private $_fecharegistrousuario;
      private $_fechaultimaclave;
      private $_celularusuario;
      private $_idrolusuario;
     
      private $_paginacion =10;

      function __construct ($conexion,$idusuario,$nombreusuario,$correousuario,$claveusuario,$fecharegistrousuario,$fechaultimaclave,$celularusuario,$idrolusuario){
          $this->_conexion=$conexion;
          $this->_idusuario=$idusuario;
          $this->_nombreusuario=$nombreusuario;
          $this->_correousuario=$correousuario;
          $this->_claveusuario= $claveusuario;
          $this->_fecharegistrousuario=$fecharegistrousuario;
          $this->_fechaultimaclave=$fechaultimaclave;
          $this->_celularusuario=$celularusuario;
          $this->_idrolusuario=$idrolusuario;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        
        $insercion= mysqli_query($this->_conexion,"INSERT INTO usuario (idusuario, nombreusuario, correousuario, claveusuario ,fecharegistrousuario,fechaultimaclave, celularusuario,idrolusuario) VALUES (NULL,'$this->_nombreusuario','$this->_correousuario','".hash('sha256',$this->_claveusuario)."','$this->_fecharegistrousuario','$this->_fechaultimaclave','$this->_celularusuario','$this->_idrolusuario')")or die (mysqli_error($this->_conexion));
       // $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditoria,fechaauditoria) VALUES  (null, 'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
        return $insercion;

        echo "INSERT INTO usuario (idusuario, nombreusuario, correousuario, claveusuario ,fecharegistrousuario,fechaultimaclave, celularusuario,idrolusuario) VALUES (NULL,'$this->_nombreusuario','$this->_correousuario','".hash('sha256',$this->_claveusuario)."',$this->_fecharegistrousuario','$this->_fechaultimaclave','$this->_celularusuario','$this->_idrolusuario')";
    }

    function modificar(){
        $consultaClave=mysqli_query($this->_conexion,"SELECT CONVERT(claveusuario, CHAR(100)) AS claveOriginal FROM usuario WHERE idusuario = $this->_idusuario");
        $unregistro=mysqli_fetch_array($consultaClave);
        $claveOriginal = $unregistro['claveOriginal'];
        
        if ($this->_claveusuario==$claveOriginal){
            $modificacion=mysqli_query($this->_conexion,"UPDATE usuario SET nombreusuario='$this->_nombreusuario', correousuario='$this->_correousuario', claveusuario='$this->_claveusuario', fecharegistrousuario='$this->_fecharegistrousuario', fechaultimaclave='$this->_fechaultimaclave',celularusuario='$this->_celularusuario',idrolusuario='$this->_idrolusuario' WHERE idusuario=$this->_idusuario")or die (mysqli_error($this->_conexion));
          
          echo "UPDATE usuario SET nombreusuario='$this->_nombreusuario', correousuario='$this->_correousuario', claveusuario='$this->_claveusuario', fecharegistrousuario='$this->_fecharegistrousuario', fechaultimaclave='$this->_fechaultimaclave',celularusuario='$this->_celularusuario',idrolusuario='$this->_idrolusuario' WHERE idusuario=$this->_idusuario";
        }
       else{
            $modificacion=mysqli_query($this->_conexion,"UPDATE usuario SET nombreusuario='$this->_nombreusuario', correousuario='$this->_correousuario', claveusuario='".hash('sha256',$this->_claveusuario)."', fecharegistrousuario='$this->_fecharegistrousuario', fechaultimaclave='$this->_fechaultimaclave',celularusuario='$this->_celularusuario',idrolusuario='$this->_idrolusuario' WHERE idusuario=$this->_idusuario")or die (mysqli_error($this->_conexion));
           
            echo "UPDATE usuario SET nombreusuario='$this->_nombreusuario', correousuario='$this->_correousuario', claveusuario='".hash('sha256',$this->_claveusuario)."', fecharegistrousuario='$this->_fecharegistrousuario', fechaultimaclave='$this->_fechaultimaclave',celularusuario='$this->_celularusuario',idrolusuario='$this->_idrolusuario' WHERE idusuario=$this->_idusuario";
        }
session_start();
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM usuario WHERE idusuario=$this->_idusuario");
        session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

   function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idusuario)/$this->_paginacion) AS cantidad FROM usuario") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($cantidaddebloques);
        return $unregistro['cantidad'];
    }

      function getRol($idusuario){
        $roles=mysqli_query($this->_conexion, "SELECT ".static::class."roles AS elpermiso FROM roles WHERE idRoles IN(SELECT idrolUsuario FROM usuario WHERE idusuario =$idusuario)") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }


    function listar ($pagina){
        if ($pagina<=0){
            $listado=mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idusuario") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idusuario LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>
