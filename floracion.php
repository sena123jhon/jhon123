<?php
  class floracion {
      private $_conexion;
      private $_idfloracion;
      private $_cantidadflores;
      private $_fechafloracion;
      private $_idarbolfloracion;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idfloracion,$cantidadflores,$fechafloracion,$idarbolfloracion){
          $this->_conexion=$conexion;
          $this->_idfloracion=$idfloracion;
          $this->_cantidadflores=$cantidadflores;
          $this->_fechafloracion=$fechafloracion;
          $this->_idarbolfloracion=$idarbolfloracion;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO floracion (idfloracion, cantidadflores, fechafloracion, idarbolfloracion) VALUES (NULL,'$this->_cantidadflores','$this->_fechafloracion','$this->_idarbolfloracion')")or die (mysqli_error($this->_conexion));
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){

        $modificacion=mysqli_query($this->_conexion," UPDATE floracion SET cantidadflores='$this->_cantidadflores', fechafloracion='$this->_fechafloracion', idarbolfloracion='$this->_idarbolfloracion' WHERE idfloracion=$this->_idfloracion")or die (mysqli_error($this->conexion));
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM floracion WHERE idfloracion=$this->_idfloracion");
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

    function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idfloracion)/$this->_paginacion) AS cantidad FROM floracion") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM floracion ORDER BY idfloracion") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM floracion ORDER BY idfloracion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>