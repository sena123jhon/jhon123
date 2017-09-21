<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/enfermedades.php");

$opcion = $_POST["fenviar"];
$idenfermedades = $_POST["fidenfermedades"];
$nombreenfermedades = $_POST["fnombreenfermedades"];


$nombreenfermedades = htmlspecialchars($nombreenfermedades);

$objetoenfermedades = new enfermedades($conexion,$idenfermedades,$nombreenfermedades);

switch($opcion){
    case 'ingresar':
        $objetoenfermedades->insertar();
        $mensaje="ingresado";
    break;

    case 'modificar':
        $objetoenfermedades->modificar();
        $mensaje="modificado";
    break;

    case 'eliminar':
        $objetoenfermedades->eliminar();
        $mensaje="eliminado";
    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioenfermedades.php?msj=$mensaje");
?>