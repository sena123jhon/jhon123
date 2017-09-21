<?php
  class produccion {
      private $_conexion;
      private $_idproduccion;
      private $_kilosdesechosproduccion;
      private $_kilosterceraproduccion;
      private $_kilossegundaproduccion;
      private $_kilosprimeraproduccion;
       private $_idarbolproduccion;
      
      private $_paginacion =10;

      function __construct ($conexion, $idproduccion, $kilosdesechosproduccion, $kilosterceraproduccion, $kilossegundaproduccion, $kilosprimeraproduccion, $idarbolproduccion){
          $this->_conexion=$conexion;
          $this->_idproduccion=$idproduccion;
          $this->_kilosdesechosproduccion=$kilosdesechosproduccion;
          $this->_kilosterceraproduccion=$kilosterceraproduccion;
          $this->_kilossegundaproduccion=$kilossegundaproduccion;
          $this->_kilosprimeraproduccion=$kilosprimeraproduccion;
          $this->_idarbolproduccion=$idarbolproduccion;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO produccion (idproduccion,kilosdesechosproduccion, kilosterceraproduccion, kilossegundaproduccion, kilosprimeraproduccion, idarbolproduccion) VALUES (NULL,'$this->_kilosdesechosproduccion','$this->_kilosterceraproduccion','$this->_kilossegundaproduccion','$this->_kilosprimeraproduccion','$this->_idarbolproduccion')")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  ((null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $insercion;
    }

    function modificar(){

        $modificacion=mysqli_query($this->_conexion," UPDATE produccion SET  kilosdesechosproduccion='$this->_kilosdesechosproduccion', kilosterceraproduccion='$this->_kilosterceraproduccion', kilossegundaproduccion='$this->_kilossegundaproduccion',kilosprimeraproduccion='$this->_kilosprimeraproduccion', idarbolproduccion='$this->_idarbolproduccion' WHERE idproduccion=$this->_idproduccion")or die (mysqli_error($this->conexion));
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM produccion WHERE idproduccion=$this->_idproduccion");
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES((NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

    function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idproduccion)/$this->_paginacion) AS cantidad FROM produccion") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM produccion ORDER BY idproduccion") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM produccion ORDER BY idproduccion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>