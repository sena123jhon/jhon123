<?php
  class finca {
      private $_conexion;
      private $_idfinca;
      private $_areafinca;
      private $_msnmfinca;
      private $_nombrefinca;
      private $_ubicacionfinca;
      private $_propietariofinca;
      private $_paginacion =10;

      function __construct ($conexion,$idfinca,$areafinca,$msnmfinca,$nombrefinca,$ubicacionfinca,$propietariofinca){
          $this->_conexion=$conexion;
          $this->_idfinca=$idfinca;
          $this->_areafinca=$areafinca;
          $this->_msnmfinca=$msnmfinca;
          $this->_nombrefinca=$nombrefinca;
          $this->_ubicacionfinca=$ubicacionfinca;
          $this->_propietariofinca=$propietariofinca;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
         
        $insercion= mysqli_query($this->_conexion,"INSERT INTO finca (idfinca, areafinca, msnmfinca,nombrefinca,ubicacionfinca, propietariofinca) VALUES (NULL,'$this->_areafinca','$this->_msnmfinca','$this->_nombrefinca',ST_GeomFromText('$this->_ubicacionfinca'),'$this->_propietariofinca')")or die (mysqli_error($this->_conexion));
        session_start();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){
        $modificacion=mysqli_query($this->_conexion," UPDATE finca SET areafinca='$this->_areafinca', msnmfinca='$this->_msnmfinca', nombrefinca='$this->_nombrefinca', ubicacionfinca=ST_GeomFromText('$this->_ubicacionfinca'),propietariofinca='$this->_propietariofinca' WHERE idfinca=$this->_idfinca") or die (mysqli_error($this->_conexion));
        session_start();
       $auditoria=mysqli_query($this->conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM finca WHERE idfinca=$this->_idfinca");
     session_start();
      $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

   function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idfinca)/$this->_paginacion) AS cantidad FROM finca") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT idfinca, areafinca, msnmfinca, nombrefinca, ST_AsText(ubicacionfinca) AS ubicacionfinca, propietariofinca FROM finca ORDER BY idfinca") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT idfinca, areafinca, msnmfinca, nombrefinca, ST_AsText(ubicacionfinca) AS ubicacionfinca, propietariofinca FROM finca ORDER BY idfinca LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>