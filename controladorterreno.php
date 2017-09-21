<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/terreno.php");

$opcion = $_POST["fenviar"];
$idterreno = $_POST["fidterreno"];
$_POST["fpresentaerocion"] = (isset($_POST["fpresentaerocion"])==false)?"":$_POST["fpresentaerocion"];
$presentaerocion = (($_POST["fpresentaerocion"]=="on")?1:0); //esto se usa por que tiene un input type checkbox
$phterreno = $_POST["fphterreno"];
$idtiposuelo = $_POST["fidtiposuelo"];

$presentaerocion  = htmlspecialchars($presentaerocion);
$phterreno = htmlspecialchars($phterreno);
$idtiposuelo = htmlspecialchars($idtiposuelo);

$objetoterreno = new terreno($conexion,$idterreno,$presentaerocion,$phterreno,$idtiposuelo);

switch($opcion){
    case 'ingresar':
    $objetoterreno->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetoterreno->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetoterreno->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioterreno.php?msj=$mensaje");
?>