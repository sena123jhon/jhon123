<!DOCTYPE html>
 <?php
   session_start();
   if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>formulario finca</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body> 




<?php
   $formulario = "finca";
   include_once("menu.php");
   $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container">
<header>
    <h1>formulario finca</h1>
</header>
    <table class="table table-striped">
    <tbody>
        <tr>
        <th scope="col">area finca</th>
         <th scope="col">msnm finca</th>
         <th scope="col">nombre finca</th>
         <th scope="col">ubicacion finca</th>
         <th scope="col">propietario finca</th>
        <th scope="col">  </th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/finca.php");
$objetofinca = new finca($conexion,0,'area','msnm','nombre','ubicacion','propietario');
$listafincas = $objetofinca->listar($pagina);
$permiso = $objetofinca->getRol($_SESSION['id']);

if (stripos($permiso,"r")!==false){ 
while($unregistro =mysqli_fetch_array($listafincas)){
    echo '<tr><form id="fmodificarfinca"'.$unregistro["idfinca"].' action="../controlador/controladorfinca.php"
    method="post">';
    echo '<td><input type="hidden" name="fidfinca"   value="'.$unregistro['idfinca'].'">';
    echo '<input class="form-control col-lg-10" type="number" name="fareafinca"  value="'.$unregistro['areafinca'].'"></td>';
    echo '<td><input type="number" class="form-control col-lg-10" name="fmsnmfinca"  value="'.$unregistro['msnmfinca'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fnombrefinca"  value="'.$unregistro['nombrefinca'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fubicacionfinca"  value="'.$unregistro['ubicacionfinca'].'"></td>';
    echo '<td><input type="text" class="form-control" name="fpropietariofinca" value="'.$unregistro['propietariofinca'].'"></td>';

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

<tr><form id="fingresarfinca" action="../controlador/controladorfinca.php" method="post">
<td><input type="hidden" name="fidfinca" value="0">
   <input type="number" class="form-control col-lg-6" name="fareafinca"></td>
<td><input type="number" class="form-control col-lg-10" name="fmsnmfinca"></td>
<td><input type="text" class="form-control" name="fnombrefinca"></td>
<td><input type="text" class="form-control" name="fubicacionfinca"></td>
<td><input type="text" class="form-control" name="fpropietariofinca"></td>
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
$cantPaginas=$objetofinca->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formulariofinca.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formulariofinca.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formulariofinca.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
mysqli_free_result($listafincas);
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