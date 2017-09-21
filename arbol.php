<?php
  class arbol {
      
      private $_conexion;
      private $_idarbol;
      private $_alturaarbol; 
      private $_cantidadderamasarbol;
      private $_idfincaarbol;
      private $_idterrenoarbol;
       private $_idvariedadesarbol;
      private $_paginacion =10;

      function __construct ($conexion,$idarbol,$alturaarbol,$cantidadderamasarbol,$idfincaarbol,$idterrenoarbol,$idvariedadesarbol){
          $this->_conexion=$conexion;
          $this->_idarbol=$idarbol;
          $this->_alturaarbol=$alturaarbol;
          $this->_cantidadderamasarbol=$cantidadderamasarbol;
          $this->_idfincaarbol=$idfincaarbol;
          $this->_idterrenoarbol=$idterrenoarbol;
          $this->_idvariedadesarbol=$idvariedadesarbol;

          
          
        }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }
     function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO arbol (idarbol, alturaarbol, cantidadderamasarbol, idfincaarbol, idterrenoarbol, idvariedadesarbol) VALUES (NULL,'$this->_alturaarbol','$this->_cantidadderamasarbol','$this->_idfincaarbol','$this->_idterrenoarbol','$this->_idvariedadesarbol')")or die (mysqli_error($this->_conexion));
        session_start();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

   function modificar(){
        echo "UPDATE arbol SET alturaarbol='$this->_alturaarbol',cantidadderamasarbol='$this->_cantidadderamasarbol', idfincaarbol='$this->_idfincaarbol', idterrenoarbol='$this->_idterrenoarbol',idvariedadesarbol='$this->_idvariedadesarbol' WHERE idarbol=$this->_idarbol";
        $modificacion=mysqli_query($this->_conexion,"UPDATE arbol SET alturaarbol='$this->_alturaarbol',cantidadderamasarbol='$this->_cantidadderamasarbol', idfincaarbol='$this->_idfincaarbol', idterrenoarbol='$this->_idterrenoarbol',idvariedadesarbol='$this->_idvariedadesarbol' WHERE idarbol=$this->_idarbol")or die (mysqli_error($this->_conexion));
        session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $modificacion;
    }
    

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM arbol WHERE idarbol=$this->_idarbol");
        session_start();
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion;
    }

    function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idarbol)/$this->_paginacion) AS cantidad FROM arbol") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM arbol ORDER BY idarbol") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM arbol ORDER BY idarbol LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    }
  }
 
 ?>
 