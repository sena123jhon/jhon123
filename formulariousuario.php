 <!DOCTYPE html>
  <?php
   session_start();
   if (isset($_SESSION['id'])){
?>
<html>
<head>
 <title>formulario usuario</title>
           <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>
    <?php
   $formulario = "usuario";
   include_once("menu.php");
   $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container-fluid">
<header>
    <h1>formulario usuario</h1>
    </header>
    <table   class="table table-responsive">
    <tbody>
        <tr>
        <th scope="col">nombreusuario </th>
         <th scope="col">correousuario</th>
          <th scope="col">claveusuario</th>
           <th scope="col">fecharegistrousuario</th>
             <th scope="col">fechaultimaclave</th>
              <th scope="col">celularusuario</th>
               <th scope="col">idrolusuario</th>
                

         <th scope="col"></th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/roles.php");
$objetoroles = new roles($conexion,0,'nombreroles','arbolroles','fincaroles','podasroles','produccionroles','foliacionroles','floracion','enfermedadesroles','ataques roles','variedadesroles','terrenoroles','aplicacionesroles','tipoaplicacionesroles','usuarioroles','auditoriaroles');
$listaroless = $objetoroles->listar(0);

include_once("../modelo/usuario.php");
$objetousuario = new usuario($conexion,0,'nombreusuario','correousuario','claveusuario','fecharegistrousuario','fehaultimaclave','celularusuario','idrolusuario');
$listausuarios = $objetousuario->listar($pagina);
$permiso = $objetousuario->getRol($_SESSION['id']);

if (stripos($permiso,"r")!==false){
while($unregistro =mysqli_fetch_array($listausuarios)){
    echo '<tr><form id="fmodificarusuario"'.$unregistro["idusuario"].' action="../controlador/controladorusuario.php"
    method="post">';
    echo '<td><input type="hidden" name="fidusuario"   value="'.$unregistro['idusuario'].'">';
    echo '    <input type="text" name="fnombreusuario"  value="'.$unregistro['nombreusuario'].'"></td>';
    echo '<td><input type="email" name="fcorreousuario"  value="'.$unregistro['correousuario'].'"></td>';
    echo '<td><input type="password" name="fclaveusuario"  value="'.$unregistro['claveusuario'].'"></td>';
    echo '<td><input type="date" name="ffecharegistrousuario"  value="'.$unregistro['fecharegistrousuario'].'"></td>';
    echo '<td><input type="date" name="ffechaultimaclave"  value="'.$unregistro['fechaultimaclave'].'"></td>';
    echo '<td><input type="number" name="fcelularusuario"  value="'.$unregistro['celularusuario'].'"></td>';
    echo '<td><select name="fidrolusuario">';
        while($otroregistro =mysqli_fetch_array($listaroless)){
           echo "<option value=".$otroregistro['idroles']."";
           if ($unregistro['idrolusuario'] == $otroregistro['idroles']){
               echo " selected ";
           }
           echo ">{$otroregistro['nombreroles']}</option>";
        }
        mysqli_data_seek($listaroless,0);
            
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


<tr><form id="fingresarusuario" action="../controlador/controladorusuario.php" method="post">
<td><input type="hidden" name="fidusuario" value="0">
    <input type="text" name="fnombreusuario"></td>
<td><input type="email" name="fcorreousuario"></td>
<td><input type="password" name="fclaveusuario"></td>
<td><input type="date" name="ffecharegistrousuario"></td>
<td><input type="date" name="ffechaultimaclave"></td>
<td><input type="number" name="fcelularusuario"></td>

<td><select name="fidrolusuario">
 <?php
       while($otroregistro =mysqli_fetch_array($listaroless)){
           echo "<option value=".$otroregistro['idroles'].">{$otroregistro['nombreroles']}</option>";
       }
    ?>
    </select>
    


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
$cantPaginas=$objetousuario->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formulariousuario.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formulariousuario.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formulariousuario.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
mysqli_free_result($listausuarios);
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