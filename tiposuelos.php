<?php
  class tiposuelos {
      
      private $_conexion;
      private $_idtiposuelos;
      private $_nombrestiposuelos; 
      private $_paginacion =10;

      function __construct ($conexion,$idtiposuelos,$nombrestiposuelos){
          $this->_conexion=$conexion;
          $this->_idtiposuelos=$idtiposuelos;
          $this->_nombrestiposuelos=$nombrestiposuelos;
          
        }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }
      
    function insertar (){
        $insercion=mysqli_query($this->_conexion,"INSERT INTO tiposuelos (idtiposuelos, nombrestiposuelos) VALUES (NULL,'$this->_nombrestiposuelos')");
        session_start();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

   function modificar(){
        $modificacion=mysqli_query($this->_conexion,"UPDATE tiposuelos SET nombrestiposuelos='$this->_nombrestiposuelos' WHERE idtiposuelos=$this->_idtiposuelos")or die (mysqli_error($this->_conexion));
        session_start();
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }
    

   function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM tiposuelos WHERE idtiposuelos=$this->_idtiposuelos");
        session_start();
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion;
    }

     function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idtiposuelos)/$this->_paginacion) AS cantidad FROM tiposuelos") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM tiposuelos ORDER BY idtiposuelos") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM tiposuelos ORDER BY idtiposuelos LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    }
  }
 
 ?>