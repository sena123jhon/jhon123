<?php
  class aplicaciones {
      private $_conexion;
      private $_idaplicaciones;
      private $_fechaaplicacion;
      private $_marcaempleadaaplicacion;
      private $_idtipoaplicacion;
      private $_idarbolaplicaciones;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idaplicaciones,$fechaaplicaciones,$marcaempleadaaplicaciones,$idtipoaplicacion,$idarbolaplicaciones){
          $this->_conexion=$conexion;
          $this->_idaplicaciones=$idaplicaciones;
          $this->_fechaaplicaciones=$fechaaplicaciones;
          $this->_marcaempleadaaplicacion=$marcaempleadaaplicaciones;
          $this->_idtipoaplicacion=$idtipoaplicacion;
          $this->_idarbolaplicaciones=$idarbolaplicaciones;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO aplicaciones (idaplicaciones, fechaaplicaciones, marcaempleadaaplicaciones,idtipoaplicacion,idarbolaplicaciones) VALUES (NULL,'$this->_fechaaplicaciones','$this->_marcaempleadaaplicacion','$this->_idtipoaplicacion','$this->_idarbolaplicaciones')")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){
        $modificacion=mysqli_query($this->_conexion,"UPDATE aplicaciones SET fechaaplicaciones='$this->_fechaaplicaciones', marcaempleadaaplicaciones='$this->_marcaempleadaaplicacion',idtipoaplicacion='$this->_idtipoaplicacion', idarbolaplicaciones='$this->_idarbolaplicaciones' WHERE 
        idaplicaciones=$this->_idaplicaciones")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM aplicaciones WHERE idaplicaciones=$this->_idaplicaciones");
       session_start();
      $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

    function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idaplicaciones)/$this->_paginacion) AS cantidad FROM aplicaciones") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM aplicaciones ORDER BY idaplicaciones") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM aplicaciones ORDER BY idaplicaciones LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        }
        return $listado;
    } 
 }
 ?>