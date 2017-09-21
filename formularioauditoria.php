<!DOCTYPE html>
<?php
   session_start();
   if (isset($_SESSION['id'])){
?>

<html>
<head>
    <meta charset="utf-8">
    <title>formulario auditoria</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    </head>
    <body>

<?php
   $formulario = "auditoria";  
   include_once("menu.php");
    $pagina = isset($_GET['pag'])?$_GET['pag']:1;
?>
<div class="container">
<header>
    <h1>formulario auditoria</h1>
</header>
    <table  class="table table-striped">
    <tbody>
        <tr>
         <th scope="col">id</th>
         <th scope="col">fechaauditoria </th>
         <th scope="col">idusuarioauditorias </th>
         <th scope="col"> descripcionauditoria </th>
        </tr>

<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion =$objetoconexion->conectar();

include_once("../modelo/usuario.php");
$objetousuario = new usuario($conexion,0,'nombreusuario','correousuario','claveusuario','fecharegistrousuario','fehaultimaclave','celularusuario','idrolusuario');
$listausuarios = $objetousuario->listar(0);

include_once("../modelo/auditoria.php");
$objetoauditoria = new auditoria($conexion,0,'idauditoria','fechaauditoria','idusuarioauditorias','descripcionauditoria');
$listaauditorias = $objetoauditoria->listar($pagina);
while($unregistro =mysqli_fetch_array($listaauditorias)){
    echo '<tr><form id="fmodificarauditoria'.$unregistro["idauditoria"].'" action="../controlador/controladorauditoria.php" method="post">';
    echo '<td><input type="number" name="fidusuarioauditoria"   value="'.$unregistro['idauditoria'].'"></td>';
    echo '<td><input type="date" name="ffechaauditoria"  value="'.$unregistro['fechaauditoria'].'"></td>';
    while($registroauditoria =mysqli_fetch_array($listausuarios)){
      if($unregistro['idusuarioauditorias']==$registroauditoria['idusuario']){
        echo '<td><input type="text" name="fidusuarioauditorias"  value="'.$registroauditoria['nombreusuario'].'"></td>';
      }
    }
    mysqli_data_seek($listausuarios,0);
    echo '<td><input type="text" name="fdescripcionauditoria"  value="'.$unregistro['descripcionauditoria'].'"></td>';
   
    echo '</form></tr>';

}
?>

</tbody>
</table>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<nav><ul class="pagination justify-content-center">
<?php
$cantPaginas=$objetoauditoria->cantPaginas();
if($cantPaginas>1){
    if($pagina>1){
        echo '<li class="page-item"><a class="page-link" href="formularioauditoria.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantPaginas;$i++){
        if($i==$pagina){
            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="formularioauditoria.php?pag='.$i.'">'.$i.'</a></li>';
        }
    }
    if ($pagina<$cantPaginas){
        echo '<li class="page-item"><a class="page-link" href="formularioauditoria.php?pag='.($pagina+1).'" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
?>
</ul></nav>

</div>
<?php
mysqli_free_result($listausuarios);
mysqli_free_result($listaauditorias);

$objetoconexion->desconectar($conexion);
?>
</body>
</html>
<?php

}else{
       header("location:../index.php");
   }
?>