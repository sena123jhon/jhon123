<?php
  class terreno {
      private $_conexion;
      private $_idterreno;
      private $_presentaerocion;
      private $_phterreno;
      private $_idtiposuelo;
      
      
      private $_paginacion =10;

      function __construct ($conexion,$idterreno,$presentaerocion,$phterreno,$idtiposuelo){
          $this->_conexion=$conexion;
          $this->_idterreno=$idterreno;
          $this->_presentaerocion=$presentaerocion;
          $this->_phterreno=$phterreno;
          $this->_idtiposuelo=$idtiposuelo;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO terreno (idterreno, presentaerocion, phterreno, idtiposuelo) VALUES (NULL,'$this->_presentaerocion','$this->_phterreno','$this->_idtiposuelo')")or die (mysqli_error($this->_conexion));
       session_start();

       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){
        $modificacion=mysqli_query($this->_conexion," UPDATE terreno SET presentaerocion='$this->_presentaerocion', phterreno='$this->_phterreno', idtiposuelo='$this->_idtiposuelo' WHERE idterreno=$this->_idterreno");
       session_start();

       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM terreno WHERE idterreno=$this->_idterreno");
       session_start();

       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

    function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idterreno)/$this->_paginacion) AS cantidad FROM terreno") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM terreno INNER JOIN tiposuelos ON idtiposuelo = idtiposuelos ORDER BY idterreno") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM terreno ORDER BY idterreno LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>