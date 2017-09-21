 <?php
   session_start();
   if (isset($_SESSION['id'])){
?>

<html>
<head>
    <meta charset="utf-8">
    <title>formulario produccion</title>
 <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>

<?php
   $formulario = "produccion";  
   include_once("menu.php");
    $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container">
<header>
    <h1>formulario produccion</h1>
</header>
    <table  class="table table-striped">
    <tbody>
        <tr>
       
       <th scope="col">kilos desechos </th>
         <th scope="col">kilos tercera </th>
         <th scope="col">kilos segunda </th>
         <th scope="col">kilos primera </th>
         <th scope="col"> arbol </th>
          <th scope="col"></th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/arbol.php");
$objetoarbol = new arbol ($conexion,0,'alturaarbol','cantidadderamasarbol','idfincaarbol','idterrenoarbol','idvariedades');
$listaarboles = $objetoarbol->listar(0);

include_once("../modelo/produccion.php");
$objetoproduccion = new produccion($conexion,0,'idproduccion','kilosdesechosproduccion','kilosterceraproduccion','kilossegundaproduccion','kilosprimeraproduccion','idarbolproduccion');
$listaproduccions = $objetoproduccion->listar($pagina);
$permiso = $objetoproduccion->getRol($_SESSION['id']);

if (stripos($permiso,"r")!==false){ 
while($unregistro =mysqli_fetch_array($listaproduccions)){

    echo '<tr><form id="fmodificarproduccion"'.$unregistro["idproduccion"].' action="../controlador/controladorproduccion.php" method="post">';
    echo '<td><input type="hidden" name="fidproduccion"   value="'.$unregistro['idproduccion'].'">';
    echo '    <input type="number" name="fkilosdesechosproduccion"  value="'.$unregistro['kilosdesechosproduccion'].'"></td>';
    echo '<td><input type="number" name="fkilosterceraproduccion"  value="'.$unregistro['kilosterceraproduccion'].'"></td>';
    echo '<td><input type="number" name="fkilossegundaproduccion"  value="'.$unregistro['kilossegundaproduccion'].'"></td>';
    echo '<td><input type="number" name="fkilosprimeraproduccion"  value="'.$unregistro['kilosprimeraproduccion'].'"></td>';
    echo '<td><select name="fidarbolproduccion">';
        while($otroregistro =mysqli_fetch_array($listaarboles)){
           echo "<option value=".$otroregistro['idarbol']."";
           if ($unregistro['idarbolproduccion'] == $otroregistro['idarbol']){
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
                echo '<button type="submit" class="btn btn-danger" name="fenviar" value="eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
            } //fin permiso d
            echo '</form></tr>';
    } //fin while
}//fin permiso r
?>

<?php
    
    if (stripos($permiso,"c")!==false){  
?>

<tr><form id="fingresarproduccion" action="../controlador/controladorproduccion.php" method="post">
<td><input type="hidden" name="fidproduccion" value="0">
    <input type="number" name="fkilosdesechosproduccion"></td>
<td><input type="number" name="fkilosterceraproduccion"></td>
<td><input type="number" name="fkilossegundaproduccion"></td>
<td><input type="number" name="fkilosprimeraproduccion"></td>
<td><select name="fidarbolproduccion">
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
$cantPaginas=$objetoproduccion->cantPaginas();
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
mysqli_free_result($listaproduccions);
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