<?php
  class roles {
      private $_conexion;
      private $_idroles;
      private $_nombreroles;
      private $_arbolroles;
      private $_fincaroles;
      private $_podasroles;
      private $_produccionroles;
      private $_foliacionroles;
      private $_floracionroles;
      private $_enfermedadesroles;
      private $_ataqueroles;
      private $_variedadesroles;
      private $_terrenoroles;
      private $_aplicacionesroles;
      private $_tipoaplicacionroles;
      private $_usuarioroles;
      private $_auditoriaroles;
      private $_paginacion =10;

      function __construct ($_conexion,$idroles,$nombreroles,$arbolroles,$fincaroles,$podasroles,$produccionroles,$foliacionroles,$floracionroles,$enfermedadesroles,$ataqueroles,$variedadesroles,$terrenoroles,$aplicacionesroles,$tipoaplicacionroles,$usuarioroles,$auditoriaroles){
          $this->_conexion=$_conexion;
          $this->_idroles=$idroles;
          $this->_nombreroles=$nombreroles;
          $this->_arbolroles=$arbolroles;
          $this->_fincaroles=$fincaroles;
          $this->_podasroles=$podasroles;
          $this->_produccionroles=$produccionroles;
          $this->_foliacionroles=$foliacionroles;
          $this->_floracionroles=$floracionroles;
          $this->_enfermedadesroles=$enfermedadesroles;
          $this->_ataqueroles=$ataqueroles;
          $this->_variedadesroles=$variedadesroles;
          $this->_terrenoroles=$terrenoroles;
          $this->_aplicacionesroles=$aplicacionesroles;
          $this->_tipoaplicacionroles=$tipoaplicacionroles;
          $this->_usuarioroles=$usuarioroles;
          $this->_auditoriaroles=$auditoriaroles;
      }

      function _get($k){
          return $this->$k;
      }

      function _set($k,$v){
         $this->$k =$v;
      }

    function insertar (){
        $insercion= mysqli_query($this->_conexion,"INSERT INTO roles (idroles,nombreroles, arbolroles, fincaroles,podasroles,produccionroles, foliacionroles,floracionroles,enfermedadesroles,ataqueroles,variedadesroles,terrenoroles,aplicacionesroles,tipoaplicacionroles,usuarioroles,auditoriaroles) VALUES (NULL,'$this->_nombreroles','$this->_arbolroles','$this->_fincaroles','$this->_podasroles','$this->_produccionroles','$this->_foliacionroles','$this->_floracionroles','$this->_enfermedadesroles','$this->_ataqueroles','$this->_variedadesroles','$this->_terrenoroles','$this->_aplicacionesroles','$this->_tipoaplicacionroles','$this->_usuarioroles','$this->_auditoriaroles')")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES  (null, 'inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
        return $insercion;
    }

    function modificar(){
        $modificacion=mysqli_query($this->_conexion,"UPDATE roles SET nombreroles='$this->_nombreroles',arbolroles='$this->_arbolroles', fincaroles='$this->_fincaroles', podasroles='$this->_podasroles', produccionroles='$this->_produccionroles',foliacionroles='$this->_foliacionroles',floracionroles='$this->_floracionroles',enfermedadesroles='$this->_enfermedadesroles',ataqueroles='$this->_ataqueroles',variedadesroles='$this->_variedadesroles',terrenoroles='$this->_terrenoroles',aplicacionesroles='$this->_aplicacionesroles',tipoaplicacionroles='$this->_tipoaplicacionroles',usuarioroles='$this->_usuarioroles',auditoriaroles='$this->_auditoriaroles' WHERE idroles=$this->_idroles")or die (mysqli_error($this->_conexion));
       session_start();
       $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));

        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM roles WHERE idroles=$this->_idroles");
        session_start();
        $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,descripcionauditoria,idusuarioauditorias,fechaauditoria) VALUES(NULL,'elimino ".static::class."',".$_session['id'].",CURDATE())");
        return $eliminacion; 
    }

   function cantPaginas(){
        $cantidaddebloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idroles)/$this->_paginacion) AS cantidad FROM roles") or die (mysqli_error($this->_conexion));
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
            $listado=mysqli_query($this->_conexion,"SELECT * FROM roles ORDER BY idroles") or die (mysqli_error($this->_conexion)); 
        }else{
            $paginacionMax = $pagina *$this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado=mysqli_query($this->_conexion,"SELECT* FROM roles ORDER BY idroles LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        }
        return $listado;
    } 
 }
 ?>