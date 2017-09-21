<?php
  class auditoria {
      private $_conexion;
      private $_idauditoria;
      private $_fechaauditoria;
      private $_idusuarioauditorias;
      private $_descripcionauditoria;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idauditoria,$fechaauditoria,$idusuarioauditorias,$descripcionauditoria){
          $this->_conexion=$conexion;
          $this->_idauditoria=$idauditoria;
          $this->_fechaauditoria=$fechaauditoria;
          $this->_idusuarioauditorias=$idusuarioauditorias;
          $this->_descripcionauditoria=$descripcionauditoria;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO auditoria (idusuarioauditoria, fechaauditoria, idusuarioauditorias, descripciionuditoria) VALUES (NULL,'$this->_fechaauditoria','$this->_idusuarioauditorias','$this->_descripcionauditoria')")or die (mysqli_error($this->_conexion));
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES  (null, 'inserto ".static::class."',1,CURDATE())");
        return $insercion;
    }

    function modificar(){

        $modificacion=mysqli_query($this->_conexion," UPDATE auditoria SET fechaauditoria='$this->_fechaauditoria', idusuarioauditorias='$this->_idusuarioauditorias', descripcionauditoria='$this->_descripcionauditoria' WHERE idauditoria=$this->_idauditoria")or die (mysqli_error($this->_conexion));
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['idusuario'].",CURDATE())");
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM auditoria WHERE idauditoria=$this->_idauditoria");
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'elimino ".static::class.",".$_session['idusuario']."','CURDATE()')");
        return $eliminacion; 
    }

     function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idauditoria)/$this->_paginacion) AS cantidad FROM auditoria") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($cantidaddebloques);
        return $unregistro['cantidad'];
    }

    function listar ($pagina){
        if ($pagina<=0){
            $listado=mysqli_query($this->_conexion,"SELECT * FROM auditoria ORDER BY idauditoria") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM auditoria ORDER BY idauditoria  LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        }
        return $listado;
    } 
 }
 ?>