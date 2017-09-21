<?php
  class podas {
      private $_conexion;
      private $_idpodas;
      private $_tipopodas;
      private $_fechapodas;
      private $_idarbolpodas;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idpodas,$tipopodas,$fechapodas,$idarbolpodas){
          $this->_conexion=$conexion;
          $this->_idpodas=$idpodas;
          $this->_tipopodas=$tipopodas;
          $this->_fechapodas=$fechapodas;
          $this->_idarbolpodas=$idarbolpodas;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO podas (idpodas, tipopodas, fechapodas, idarbolpodas) VALUES (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (NULL, 'inserto ".static::class."',1,CURDATE())");
        return $insercion;
    }

    function modificar(){

        $modificacion=mysqli_query($this->_conexion," UPDATE podas SET tipopodas='$this->_tipopodas', fechapodas='$this->_fechapodas', idarbolpodas='$this->_idarbolpodas' WHERE idpodas=$this->_idpodas")or die (mysqli_error($this->conexion));
       session_start();
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM podas WHERE idpodas=$this->_idpodas");
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }
   function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idpodas)/$this->_paginacion) AS cantidad FROM podas") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM podas ORDER BY idpodas") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM podas ORDER BY idpodas LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>