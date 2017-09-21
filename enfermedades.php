<?php
  class enfermedades {
      
      private $_conexion;
      private $_idenfermedades;
      private $_nombreenfermedades; 
      private $_paginacion =10;

      function __construct ($conexion,$idenfermedades,$nombreenfermedades){
          $this->_conexion=$conexion;
          $this->_idenfermedades=$idenfermedades;
          $this->_nombreenfermedades=$nombreenfermedades;
          
        }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }
      
    function insertar (){
        $insercion=mysqli_query($this->_conexion,"INSERT INTO enfermedades (idenfermedades, nombreenfermedades) VALUES (NULL,'$this->_nombreenfermedades')")or die (mysqli_error($this->_conexion));
        session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

   function modificar(){
        $modificacion=mysqli_query($this->_conexion,"UPDATE enfermedades SET nombreenfermedades='$this->_nombreenfermedades' WHERE idenfermedades=$this->_idenfermedades")or die (mysqli_error($this->_conexion));
        session_start();
      $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }
    

   function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM enfermedades WHERE idenfermedades=$this->_idenfermedades");
       session_start();
     $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion;
    }

   function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idenfermedades)/$this->_paginacion) AS cantidad FROM enfermedades") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM enfermedades ORDER BY idenfermedades") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM enfermedades ORDER BY idenfermedades LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    }
  }
 
 ?>