<?php
  class tipoaplicacion {
      
      private $_conexion;
      private $_idtipoaplicacion;
      private $_nombretipoaplicacion; 
      private $_tipohervicida;
      private $_tipofungidida;
      private $_tipoabono;
       private $_nombrefungidida;
       private $_nombrehervicida;
      private $_nombreabono;
      private $_paginacion =10;

      function __construct ($conexion,$idtipoaplicacion,$nombretipoaplicacion,$tipohervicida,$tipofungicida,$tipoabono,$nombrefungicida,$nombrehervicida,$nombreabono){
          $this->_conexion=$conexion;
          $this->_idtipoaplicacion=$idtipoaplicacion;
          $this->_nombretipoaplicacion=$nombretipoaplicacion;
          $this->_tipohervicida=$tipohervicida;
          $this->_tipofungicida=$tipofungicida;
          $this->_tipoabono=$tipoabono;
          $this->_nombrefungicida=$nombrefungicida;
          $this->_nombrehervicida=$nombrehervicida;
          $this->_nombreabono=$nombreabono;

          
          
        }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }
     function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO tipoaplicacion (idtipoaplicacion, nombretipoaplicacion, tipohervicida, tipofungicida, tipoabono, nombrefungicida, nombrehervicida, nombreabono) VALUES (NULL,'$this->_nombretipoaplicacion','$this->_tipohervicida','$this->_tipofungicida','$this->_tipoabono','$this->_nombrefungicida','$this->_nombrehervicida','$this->_nombreabono')")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

   function modificar(){
   
        $modificacion=mysqli_query($this->_conexion,"UPDATE tipoaplicacion SET nombretipoaplicacion='$this->_nombretipoaplicacion',tipohervicida='$this->_tipohervicida', tipofungicida='$this->_tipofungicida', tipoabono='$this->_tipoabono',nombrefungicida='$this->_nombrefungicida', nombrehervicida='$this->_nombrehervicida', nombreabono='$this->_nombreabono' WHERE idtipoaplicacion=$this->_idtipoaplicacion")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descrpcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }
    

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM tipoaplicacion WHERE idtipoaplicacion=$this->_idtipoaplicacion");
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion;
    }

     function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idtipoaplicacion)/$this->_paginacion) AS cantidad FROM tipoaplicacion") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM tipoaplicacion ORDER BY idtipoaplicacion") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM tipoaplicacion ORDER BY idtipoaplicacion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    }
  }
 
 ?>