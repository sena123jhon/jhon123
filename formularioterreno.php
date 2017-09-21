<!DOCTYPE html>
 <?php
   session_start();
   if (isset($_SESSION['id'])){
?>


<html>
<head>
    <meta charset="utf-8">
    <title>formulario terreno</title>
           <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>
    
<?php
   $formulario = "terreno";
   include_once("menu.php");
   $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container">
<header>
    <h1>formulario terreno</h1>
    </header>
    <table class="table table-striped">
    <tbody>
        <tr>
        <th scope="col">presentaerocion terreno</th>
         <th scope="col">ph terreno</th>
         <th scope="col" >tiposuelo</th>
        
          
           <th scope="col"></th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/tiposuelos.php");
$objetotiposuelos = new tiposuelos($conexion,0,'nombrestiposuelos');
$listatiposueloss = $objetotiposuelos->listar(0);

include_once("../modelo/terreno.php");
$objetoterreno = new terreno($conexion,0,'presentaerocion','ph','idtiposuelos');
$listaterrenos = $objetoterreno->listar($pagina);
$permiso = $objetoterreno->getRol($_SESSION['id']);

if (stripos($permiso,"r")!==false){  
while($unregistro =mysqli_fetch_array($listaterrenos)){
    echo '<tr><form id="fmodificarterreno"'.$unregistro["idterreno"].' action="../controlador/controladorterreno.php"
    method="post">';
    echo '<td><input type="hidden" name="fidterreno"   value="'.$unregistro['idterreno'].'">';
    echo '  <input type="checkbox" name="fpresentaerocion" '.(($unregistro['presentaerocion']=="1")?" checked ":" ").'"></td>';
    echo '<td><input type="number" name="fphterreno" step="0.001" value="'.$unregistro['phterreno'].'"></td>';
    
    echo '<td><select name="fidtiposuelo">';
        while($otroregistro =mysqli_fetch_array($listatiposueloss)){
           echo "<option value=".$otroregistro['idtiposuelos']."";
           if ($unregistro['idtiposuelo'] == $otroregistro['idtiposuelos']){
               echo " selected ";
           }
           echo ">{$otroregistro['nombrestiposuelos']}</option>";
        }
        mysqli_data_seek($listatiposueloss,0);
            
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
<tr><form id="fingresarterreno" action="../controlador/controladorterreno.php" method="post">
<td><input type="hidden" name="fidterreno" value="0">
    <input type="checkbox" name="fpresentaerocion"></td>
<td><input type="number" required name="fphterreno"></td>
<td><select name="fidtiposuelo">
 <?php
       while($otroregistro =mysqli_fetch_array($listatiposueloss)){
           echo "<option value=".$otroregistro['idtiposuelos'].">{$otroregistro['nombrestiposuelos']}</option>";
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
$cantPaginas=$objetoterreno->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formularioterreno.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formularioterreno.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formularioterreno.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
mysqli_free_result($listaterrenos);
mysqli_free_result($listatiposueloss);
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