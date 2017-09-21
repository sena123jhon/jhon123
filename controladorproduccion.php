<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/produccion.php");

$opcion = $_POST["fenviar"];
$idproduccion = $_POST["fidproduccion"];
$kilosdesechosproduccion = $_POST["fkilosdesechosproduccion"];
$kilosterceraproduccion = $_POST["fkilosterceraproduccion"];
$kilossegundaproduccion = $_POST["fkilossegundaproduccion"];
$kilosprimeraproduccion = $_POST["fkilosprimeraproduccion"];
$idarbolproduccion = $_POST["fidarbolproduccion"];

$kilosdesechosproduccion  = htmlspecialchars($kilosdesechosproduccion);
$kilosterceraproduccion  = htmlspecialchars($kilosterceraproduccion);
$kilossegundaproduccion = htmlspecialchars($kilossegundaproduccion);
$kilosprimeraproduccion = htmlspecialchars($kilosprimeraproduccion);
$idarbolproduccion = htmlspecialchars($idarbolproduccion);

$objetoproduccion = new produccion($conexion,$idproduccion,$kilosdesechosproduccion,$kilosterceraproduccion,$kilossegundaproduccion,$kilosprimeraproduccion,$idarbolproduccion);

switch($opcion){
    case 'ingresar':
    $objetoproduccion->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetoproduccion->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetoproduccion->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioproduccion.php?msj=$mensaje");
?>