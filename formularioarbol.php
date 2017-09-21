<!DOCTYPE html>
 <?php
   session_start();
   if (isset($_SESSION['id'])){
?>

<html>
<head>
    <meta charset="utf-8">
    <title>formulario arbol</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body> 


<?php
   $formulario = "arbol";
   include_once("menu.php");
    $pagina = isset($_GET['pag'])?$_GET['pag']:1;
  
?>
<div class="container">
<header>
    <h1>formulario arbol</h1>
</header>
            <table class="table table-striped"> 
            <tbody>
                <tr>
                <th scope="col">altura del arbol</th>
                    <th scope="col">cantidad de ramas</th>
                    <th scope="col">finca</th>
                    <th scope="col">terreno</th>
                     <th scope="col">variedades</th>
              
                    
                <th scope="col"></th>
                </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/arbol.php");
$objetoarbol = new arbol ($conexion,0,'alturaarbol','cantidadderamasarbol','idfincaarbol','idterrenoarbol','idvariedades');
$listaarboles = $objetoarbol->listar($pagina);
$permiso = $objetoarbol->getRol($_SESSION['id']);

include_once("../modelo/variedades.php");
$objetovariedades = new variedades($conexion,0,'nombrevariedades');
$listavariedadess = $objetovariedades->listar(0);

include_once("../modelo/terreno.php");
$objetoterreno = new terreno($conexion,0,'presentaerocion','ph','idtiposuelos');
$listaterrenos = $objetoterreno->listar(0);

include_once("../modelo/finca.php");
$objetofinca = new finca($conexion,0,'area','msnm','nombre','ubicacion','propietario');
$listafincas = $objetofinca->listar(0);

if (stripos($permiso,"r")!==false){        
    while($unregistro =mysqli_fetch_array($listaarboles)){
            echo '<tr><form id="fmodificararbol'.$unregistro["idarbol"].'" action="../controlador/controladorarbol.php" method="post">';
            echo '<td><input type="hidden"      name="fidarbol"             value="'.$unregistro['idarbol'].'">';
            echo '    <input type="text"        name="falturaarbol"         value="'.$unregistro['alturaarbol'].'"></td>';
            echo '<td><input type="text"        name="fcantidadderamasarbol" value="'.$unregistro['cantidadderamasarbol'].'"></td>';

            echo '<td><select name="fidfincaarbol">';
        while($fincaregistro =mysqli_fetch_array($listafincas)){
            echo "<option value=".$fincaregistro['idfinca']."";
            if ($unregistro['idfincaarbol'] == $fincaregistro['idfinca']){
                echo " selected ";
            }
            echo ">{$fincaregistro['nombrefinca']}</option>";
        }
            mysqli_data_seek($listafincas,0);
            echo '</select></td>';

            echo '<td><select  name="fidterrenoarbol">';
        while($terrenoregistro =mysqli_fetch_array($listaterrenos)){
            echo "<option value=".$terrenoregistro['idterreno']."";
            if ($unregistro['idterrenoarbol'] == $terrenoregistro['idterreno']){
                echo " selected ";
            }
            echo ">Ph {$terrenoregistro['phterreno']} {$terrenoregistro['nombrestiposuelos']}</option>";
        }
            mysqli_data_seek($listaterrenos,0);
            echo '</select></td>';
        
            echo '<td><select name="fidvariedadesarbol">';
        while($variedadregistro =mysqli_fetch_array($listavariedadess)){
            echo "<option value=".$variedadregistro['idvariedades']."";
            if ($unregistro['idvariedadesarbol'] == $variedadregistro['idvariedades']){
                echo " selected ";
            }
            echo ">{$variedadregistro['nombrevariedades']}</option>";
        }
            mysqli_data_seek($listavariedadess,0);
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
<tr><form id="fingresartipoaplicacion" action="../controlador/controladorarbol.php" method="post">
<td><input type="hidden" name="fidarbol" value="0">
    <input type="text" name="falturaarbol"></td>
<td><input type="text" name="fcantidadderamasarbol"></td>
<td><select name="fidfincaarbol">
<?php
       while($fincaregistro =mysqli_fetch_array($listafincas)){
           echo "<option value=".$fincaregistro['idfinca'].">{$fincaregistro['nombrefinca']}</option>";
       }
    ?>
    </select>
    </td>

<td><select name="fidterrenoarbol">
<?php
       while($terrenoregistro =mysqli_fetch_array($listaterrenos)){
           echo "<option value=".$terrenoregistro['idterreno'].">Ph {$terrenoregistro['phterreno']} {$terrenoregistro['nombrestiposuelos']}</option>";
       }
    ?>
    </select>
    </td>

<td><select name="fidvariedadesarbol">
<?php
       while($variedadregistro =mysqli_fetch_array($listavariedadess)){
           echo "<option value=".$variedadregistro['idvariedades'].">{$variedadregistro['nombrevariedades']}</option>";
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
$cantPaginas=$objetoarbol->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formularioarbol.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formularioarbol.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formularioarbol.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
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