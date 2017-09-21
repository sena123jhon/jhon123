<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/floracion.php");

$opcion = $_POST["fenviar"];
$idfloracion = $_POST["fidfloracion"];
$cantidadflores = $_POST["fcantidadflores"];
$fechafloracion = $_POST["ffechafloracion"];
$idarbolfloracion = $_POST["fidarbolfloracion"];

$cantidadflores  = htmlspecialchars($cantidadflores);
$fechafloracion = htmlspecialchars($fechafloracion);
$idarbolfloracion = htmlspecialchars($idarbolfloracion);

$objetofloracion = new floracion($conexion,$idfloracion,$cantidadflores,$fechafloracion,$idarbolfloracion);

switch($opcion){
    case 'ingresar':
    $objetofloracion->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetofloracion->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetofloracion->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariofloracion.php?msj=$mensaje");
?>