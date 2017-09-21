<!DOCTYPE html>
 <?php
   session_start();
   if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>formulario aplicaciones</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>
 
  
<?php
   $formulario = "aplicaciones";  
   include_once("menu.php");
   $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container">
<header>
    <h1>Formulario Aplicaciones</h1>
</header>
    <table class="table table-striped">
  <thead class="thead-inverse">
    <tbody>
        <tr>
       
         
         <th scope="col">fecha aplicacion</th>
         <th scope="col">marca empleada  </th>
        <th scope="col">tipo aplicacion  </th>
         <th scope="col">arbol  </th>
          <th scope="col"></th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/aplicaciones.php");
$objetoaplicaciones = new aplicaciones($conexion,0,'idaplicaciones','fechaaplicaciones','marcaempleadaaplicaciones','idtipoaplicacion','idarbolaplicaciones');
$listaaplicacioness = $objetoaplicaciones->listar($pagina);
$permiso = $objetoaplicaciones->getRol($_SESSION['id']);

include_once("../modelo/tipoaplicacion.php");
$objetotipoaplicacion = new tipoaplicacion($conexion,0,'nombretipoaplicacion','tipohervicida','tipofungicida','tipoabono','nombrefungicida','nombreherviida','nombreabono');
$listatipoaplicaciones = $objetotipoaplicacion->listar(0);

include_once("../modelo/arbol.php");
$objetoarbol = new arbol ($conexion,0,'alturaarbol','cantidadderamasarbol','idfincaarbol','idterrenoarbol','idvariedades');
$listaarboles = $objetoarbol->listar(0);

if (stripos($permiso,"r")!==false){
while($unregistro =mysqli_fetch_array($listaaplicacioness)){
    echo '<tr><form id="fmodificaraplicaciones'.$unregistro["idaplicaciones"].'" action="../controlador/controladoraplicaciones.php" method="post">';

    echo '<td><input type="hidden" name="fidaplicaciones"   value="'.$unregistro['idaplicaciones'].'">';
    echo ' <input type="date" name="ffechaaplicaciones"  value="'.$unregistro['fechaaplicaciones'].'"></td>';
    echo '<td><input type="text" name="fmarcaempleadaaplicaciones"  value="'.$unregistro['marcaempleadaaplicaciones'].'"></td>';
        echo '<td><select name="fidtipoaplicacion">';

        while($otroregistro =mysqli_fetch_array($listatipoaplicaciones)){
           echo "<option value=".$otroregistro['idtipoaplicacion']."";
           if ($unregistro['idtipoaplicacion'] == $otroregistro['idtipoaplicacion']){
               echo " selected ";
           }
           echo ">{$otroregistro['nombretipoaplicacion']}</option>";
        }
        mysqli_data_seek($listatipoaplicaciones,0);
            
     echo '</select></td>';

        echo '<td><select name="fidarbolaplicaciones">';
        while($otroregistro =mysqli_fetch_array($listaarboles)){
           echo "<option value=".$otroregistro['idarbol']."";
           if ($unregistro['idarbolaplicaciones'] == $otroregistro['idarbol']){
               echo " selected ";
           }
           echo ">{$otroregistro['idarbol']}</option>";
        }
        mysqli_data_seek($listaarboles,0);
            
     echo '</select></td>';
                 
    echo '<td>';
 if (stripos($permiso,"u")!==false){
    echo '<button type="submit" class="btn-primary btn-sm" name="fenviar" value="modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
    }  //fin permiso u
    if (stripos($permiso,"d")!==false){
   echo '<button type="submit"  class="btn btn-danger" name="fenviar" value="eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
   } //fin permiso d
    echo '</form></tr>';

 } //fin while
}//fin permiso r
?>

<?php
    
    if (stripos($permiso,"c")!==false){  
?>

<tr><form id="fingresaraplicaciones" action="../controlador/controladoraplicaciones.php" method="post">
<td><input type="hidden" name="fidaplicaciones" value="0">
   <input type="date" name="ffechaaplicaciones"></td>
<td><input type="text" name="fmarcaempleadaaplicaciones"></td>
<td><select name="fidtipoaplicacion">
<?php
       while($otroregistro =mysqli_fetch_array($listatipoaplicaciones)){
           echo "<option value=".$otroregistro['idtipoaplicacion'].">{$otroregistro['nombretipoaplicacion']}</option>";
       }
    ?>
    </select>
    </td>

<td><select name="fidarbolaplicaciones">
<?php
       while($otroregistro =mysqli_fetch_array($listaarboles)){
           echo "<option value=".$otroregistro['idarbol'].">{$otroregistro['idarbol']}</option>";
       }
    ?>
    </select>
    </td>




<td><button type="submit" class="btn btn-success" name="fenviar" value="ingresar">agregar</button>
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
$cantPaginas=$objetoaplicaciones->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formularioaplicaciones.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formularioaplicaciones.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formularioaplicaciones.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
mysqli_free_result($listaaplicacioness);
mysqli_free_result($listaarboles);
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