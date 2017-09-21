<?php
  class foliacion {
      private $_conexion;
      private $_idfoliacion;
      private $_fechadeanalicisfoliacion;
      private $_areadehojafoliacion;
      private $_numerodehojasfoliacion;
      private $_idarbolfoliacion;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idfoliacion,$fechadeanalicisfoliacion,$areadehojafoliacion,$numerodehojasfoliacion,$idarbolfoliacion){
          $this->_conexion=$conexion;
          $this->_idfoliacion=$idfoliacion;
          $this->_fechadeanalicisfoliacion=$fechadeanalicisfoliacion;
          $this->_areadehojafoliacion=$areadehojafoliacion;
          $this->_numerodehojasfoliacion=$numerodehojasfoliacion;
          $this->_idarbolfoliacion=$idarbolfoliacion;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO foliacion (idfoliacion, fechadeanalicisfoliacion, areadehojafoliacion,numerodehojasfoliacion,idarbolfoliacion) VALUES (NULL,'$this->_fechadeanalicisfoliacion','$this->_areadehojafoliacion','$this->_numerodehojasfoliacion','$this->_idarbolfoliacion')")or die (mysqli_error($this->_conexion));
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){

        $modificacion=mysqli_query($this->_conexion," UPDATE foliacion SET fechadeanalicisfoliacion='$this->_fechadeanalicisfoliacion', areadehojafoliacion='$this->_areadehojafoliacion',numerodehojasfoliacion='$this->_numerodehojasfoliacion', idarbolfoliacion='$this->_idarbolfoliacion' WHERE idfoliacion=$this->_idfoliacion")or die (mysqli_error($this->_conexion));
      $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM foliacion WHERE idfoliacion=$this->_idfoliacion");
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

   function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idfoliacion)/$this->_paginacion) AS cantidad FROM foliacion") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM foliacion ORDER BY idfoliacion") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM foliacion ORDER BY idfoliacion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        }
        return $listado;
    } 
 }
 ?>