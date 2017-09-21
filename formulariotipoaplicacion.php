        <!DOCTYPE html>
         <?php
   session_start();
   if (isset($_SESSION['id'])){
?>


<html>
<head>
        <title>formulario tipoaplicacion</title>
         <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

            </head>
            <body>
            
<?php
   $formulario = "tipoaplicacion";
   include_once("menu.php");
   $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container">
        <header>
            <h1>formulario tipoaplicacion</h1>
            </header>
            <table class="table table-responsive" class="table table-striped">
            <tbody>
                <tr>
                <th scope="col">nombre tipoaplicacion</th>
                    <th scope="col">tipo hervicida</th>
                    <th scope="col">tipo fungicida</th>
                    <th scope="col">tipo abono</th>
                     <th scope="col">nombre fungicida</th>
                     <th scope="col">nombre hervicida</th>
                    <th scope="col"> nombre abono</th>
                    
                <th scope="col"></th>
                </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/tipoaplicacion.php");
$objetotipoaplicacion = new tipoaplicacion($conexion,0,'nombretipoaplicacion','tipohervicida','tipofungicida','tipoabono','nombrefungicida','nombreherviida','nombreabono');
$listatipoaplicaciones = $objetotipoaplicacion->listar($pagina);
$permiso = $objetotipoaplicacion->getRol($_SESSION['id']);

if (stripos($permiso,"r")!==false){        
while($unregistro =mysqli_fetch_array($listatipoaplicaciones)){
        echo '<tr><form id="fmodificartipoaplicacion'.$unregistro["idtipoaplicacion"].'" action="../controlador/controladortipoaplicacion.php"
        method="post">';
        echo '<td><input type="hidden"  name="fidtipoaplicacion"     value="'.$unregistro['idtipoaplicacion'].'">';
        echo ' <input type="text"       name="fnombretipoaplicacion" value="'.$unregistro['nombretipoaplicacion'].'"></td>';
        echo '<td><input type="text"  name="ftipohervicida"        value="'.$unregistro['tipohervicida'].'"></td>';
        echo '<td><input type="text"    name="ftipofungicida"        value="'.$unregistro['tipofungicida'].'"></td>';
        echo '<td><input type="text"    name="ftipoabono"            value="'.$unregistro['tipoabono'].'"></td>';
        echo '<td><input type="text"  name="fnombrefungicida"      value="'.$unregistro['nombrefungicida'].'"></td>';
        echo '<td><input type="text"    name="fnombrehervicida"      value="'.$unregistro['nombrehervicida'].'"></td>';
        echo '<td><input type="text"    name="fnombreabono"          value="'.$unregistro['nombreabono'].'"></td>';

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


<tr><form id="fingresartipoaplicacion" action="../controlador/controladortipoaplicacion.php" method="post">
<td><input type="hidden" name="fidtipoaplicacion" value="0">
<input type="text" name="fnombretipoaplicacion"></td>
<td><input type="text" name="ftipohervicida"></td>
<td><input type="text" name="ftipofungicida"></td>
<td><input type="text" name="ftipoabono"></td>
<td><input type="text" name="fnombrefungicida"></td>
<td><input type="text" name="fnombrehervicida"></td>
<td><input type="text" name="fnombreabono"></td>
<td><button type="submit" class="btn btn-success" name="fenviar" value="ingresar">agregar</button>
<td><button type="reset" class="btn" name="fenviar" value="limpiar">Limpiar</button></td>
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
$cantPaginas=$objetotipoaplicacion->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formulariotipoaplicacion.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formulariotipoaplicacion.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formulariotipoaplicacion.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>

<?php
mysqli_free_result($listatipoaplicaciones);        
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