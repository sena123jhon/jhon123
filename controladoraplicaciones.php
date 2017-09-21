<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/aplicaciones.php");

$opcion = $_POST["fenviar"];
$idaplicaciones = $_POST["fidaplicaciones"];
$fechaaplicaciones = $_POST["ffechaaplicaciones"];
$marcaempleadaaplicaciones = $_POST["fmarcaempleadaaplicaciones"];
$idtipoaplicacion = $_POST["fidtipoaplicacion"];
$idarbolaplicaciones = $_POST["fidarbolaplicaciones"];

$fechaaplicaciones  = htmlspecialchars($fechaaplicaciones);
$marcaempleadaaplicaciones = htmlspecialchars($marcaempleadaaplicaciones);
$idtipoaplicacion = htmlspecialchars($idtipoaplicacion);
$idarbolaplicaciones = htmlspecialchars($idarbolaplicaciones);

$objetoaplicaciones = new aplicaciones($conexion,$idaplicaciones,$fechaaplicaciones,$marcaempleadaaplicaciones,$idtipoaplicacion,$idarbolaplicaciones);

switch($opcion){
    case 'ingresar':
    $objetoaplicaciones->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetoaplicaciones->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetoaplicaciones->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioaplicaciones.php?msj=$mensaje");
?>