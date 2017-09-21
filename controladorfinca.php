<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/finca.php");

$opcion = $_POST["fenviar"];
$idfinca = $_POST["fidfinca"];
$areafinca = $_POST["fareafinca"];
$msnmfinca = $_POST["fmsnmfinca"];
$nombrefinca = $_POST["fnombrefinca"];
$ubicacionfinca = $_POST["fubicacionfinca"];
$propietariofinca = $_POST["fpropietariofinca"];

$areafinca  = htmlspecialchars($areafinca);
$msnmfinca = htmlspecialchars($msnmfinca);
$nombrefinca = htmlspecialchars($nombrefinca);
$ubicacionfinca = htmlspecialchars($ubicacionfinca);
$propietariofinca = htmlspecialchars($propietariofinca);

$objetofinca = new finca($conexion,$idfinca,$areafinca,$msnmfinca,$nombrefinca,$ubicacionfinca,$propietariofinca);

switch($opcion){
    case 'ingresar':
    $objetofinca->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetofinca->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetofinca->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariofinca.php?msj=$mensaje");
?>