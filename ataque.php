<?php
  class ataque {
      private $_conexion;
      private $_idataque;
      private $_fechadeataque;
      private $_idenfermedadesataque;
      private $_idarbolataque;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idataque,$fechadeataque,$idenfermedadesataque,$idarbolataque){
          $this->_conexion=$conexion;
          $this->_idataque=$idataque;
          $this->_fechadeataque=$fechadeataque;
          $this->_idenfermedadesataque=$idenfermedadesataque;
          $this->_idarbolataque=$idarbolataque;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO ataque (idataque, fechadeataque, idenfermedadesataque, idarbolataque) VALUES (NULL,'$this->_fechadeataque','$this->_idenfermedadesataque','$this->_idarbolataque')")or die (mysqli_error($this->_conexion));
      session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){

        $modificacion=mysqli_query($this->_conexion," UPDATE ataque SET fechadeataque='$this->_fechadeataque', idenfermedadesataque='$this->_idenfermedadesataque', idarbolataque='$this->_idarbolataque' WHERE idataque=$this->_idataque")or die (mysqli_error($this->_conexion));
     session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM ataque WHERE idataque=$this->_idataque");
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

     function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idataque)/$this->_paginacion) AS cantidad FROM ataque") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM ataque ORDER BY idataque") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM ataque ORDER BY idataque LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        }
        return $listado;
    } 
 }
 ?>