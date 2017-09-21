<!DOCTYPE html>
 <?php
   session_start();
   if (isset($_SESSION['id'])){
?>


<html>
<head>
 <title>formulario roles</title>
    </head>
      <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <body>

    <?php
   $formulario = "roles";
   include_once("menu.php");
    $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container-fluid">
<header>
    <h1>Formulario Roles</h1>
    </header>
    <table class="table table-responsive">
      <tbody>
        <tr>
        <th scope="col">Nombres__Rol</th>
         <th scope="col">arbol_Rol</th>
          <th scope="col">finca_Rol</th>
           <th scope="col">podas_Rol</th>
            <th scope="col">produccion</th>
             <th scope="col">foliacion</th>
              <th scope="col">floracion</th>
               <th scope="col">enfermedades</th>
                <th scope="col">ataque</th>
                 <th scope="col">variedades</th>
                  <th scope="col">terreno</th>
                   <th scope="col">aplicaciones</th>
                    <th scope="col">usuario</th>
                     <th scope="col">auditoria</th>
                      <th scope="col">Rol__Rol</th>
                       <th scope="col">tipo suelo</th>
                        <th scope="col">tipo aplicaciones</th>

         <th scope="col"></th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/roles.php");
$objetoroles = new roles($conexion,0,'nombreroles','arbolroles','fincaroles','podasroles','produccionroles','foliacionroles','floracion','enfermedadesroles','ataqueroles','variedadesroles','terrenoroles','aplicacionesroles','tipoaplicacionroles','usuarioroles','auditoriaroles');
$listaroless = $objetoroles->listar($pagina);
$permiso = $objetoroles->getRol($_SESSION['id']);

if (stripos($permiso,"r")!==false){ 
while($unregistro =mysqli_fetch_array($listaroless)){
    echo '<tr><form id="fmodificarroles"'.$unregistro["idroles"].' action="../controlador/controladorroles.php"
    method="post">';
    echo '<td><input type="hidden" name="fidroles"   value="'.$unregistro['idroles'].'">';
    echo '    <input type="text" class="form-control col-lg-20" name="fnombreroles"  value="'.$unregistro['nombreroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="farbolroles"  value="'.$unregistro['arbolroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="ffincaroles"  value="'.$unregistro['fincaroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fpodasroles"  value="'.$unregistro['podasroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fproduccionroles"  value="'.$unregistro['produccionroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="ffoliacionroles"  value="'.$unregistro['foliacionroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="ffloracionroles"  value="'.$unregistro['floracionroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fenfermedadesroles"  value="'.$unregistro['enfermedadesroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fataqueroles"  value="'.$unregistro['ataqueroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fvariedadesroles"  value="'.$unregistro['variedadesroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fterrenoroles"  value="'.$unregistro['terrenoroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="faplicacionesroles"  value="'.$unregistro['aplicacionesroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="ftipoaplicacionroles"  value="'.$unregistro['tipoaplicacionroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fusuarioroles"  value="'.$unregistro['usuarioroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fauditoriaroles"  value="'.$unregistro['auditoriaroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="ftiposuelosroles"  value="'.$unregistro['tiposuelosroles'].'"></td>';
    echo '<td><input type="text" class="form-control" name="ftipoaplicacionroles"  value="'.$unregistro['tipoaplicacionroles'].'"></td>';

  echo '<td>';
            if (stripos($permiso,"u")!==false){
                echo '<button type="submit" class="btn-primary btn-sm" name="fenviar" value="modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
            }  //fin permiso u
            if (stripos($permiso,"d")!==false){
                echo '<button type="submit" class="btn btn-danger" name="fenviar" value="eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
            } //fin permiso d
            echo '</form></tr>';
    } //fin while
}//fin permiso r
?>

<?php
    
    if (stripos($permiso,"c")!==false){  
?>

<tr><form id="fingresarroles" action="../controlador/controladorroles.php" method="post">
<td><input type="hidden" name="fidroles" value="0">
    <input type="text" class="form-control col-lg-40" name="fnombreroles"></td>
<td><input type="text" class="form-control" name="farbolroles"></td>
<td><input type="text" class="form-control" name="ffincaroles"></td>
<td><input type="text" class="form-control" name="fpodasroles"></td>
<td><input type="text" class="form-control" name="fproduccionroles"></td>
<td><input type="text" class="form-control" name="ffoliacionroles"></td>
<td><input type="text" class="form-control" name="ffloracionroles"></td>
<td><input type="text" class="form-control" name="fenfermedadesroles"></td>
<td><input type="text" class="form-control" name="fataqueroles"></td>
<td><input type="text" class="form-control" name="fvariedadesroles"></td>
<td><input type="text" class="form-control" name="fterrenoroles"></td>
<td><input type="text" class="form-control" name="faplicacionesroles"></td>
<td><input type="text" class="form-control" name="ftipoaplicacionroles"></td>
<td><input type="text" class="form-control" name="fusuarioroles"></td>
<td><input type="text" class="form-control" name="fauditoriaroles"></td>
<td><input type="text" class="form-control" name="ftiposuelosroles"></td>

<td><button type="submit" class="btn-primary btn-sm" class="btn btn-success" name="fenviar" value="ingresar">agregar</button>
<button type="reset" class="btn" name="fenviar" value="limpiar">Limpiar</button></td>
</form> </tr>
<?php
   }//fin permiso c
?>
</tbody>
</table>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<nav><ul class="pagination justify-content-center">
<?php
$cantPaginas=$objetoroles->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formularioproduccion.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formularioproduccion.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formularioproducion.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
mysqli_free_result($listaroless);
$objetoconexion->desconectar($conexion);
?>
</div>
</body>
</html>
<?php

}else{
       header("location:../index.php");
   }
?>