<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/foliacion.php");

$opcion = $_POST["fenviar"];
$idfoliacion = $_POST["fidfoliacion"];
$fechadeanalicisfoliacion = $_POST["ffechadeanalicisfoliacion"];
$areadehojafoliacion = $_POST["fareadehojafoliacion"];
$numerodehojasfoliacion = $_POST["fnumerodehojasfoliacion"];
$idarbolfoliacion = $_POST["fidarbolfoliacion"];

$fechadeanalicisfoliacion  = htmlspecialchars($fechadeanalicisfoliacion);
$areadehojafoliacion = htmlspecialchars($areadehojafoliacion);
$numerodehojasfoliacion = htmlspecialchars($numerodehojasfoliacion);
$idarbolfoliacion = htmlspecialchars($idarbolfoliacion);

$objetofoliacion = new foliacion($conexion,$idfoliacion,$fechadeanalicisfoliacion,$areadehojafoliacion,$numerodehojasfoliacion,$idarbolfoliacion);

switch($opcion){
    case 'ingresar':
    $objetofoliacion->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetofoliacion->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetofoliacion->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariofoliacion.php?msj=$mensaje");
?>