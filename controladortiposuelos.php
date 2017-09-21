<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/tiposuelos.php");

$opcion = $_POST["fenviar"];
$idtiposuelos = $_POST["fidtiposuelos"];
$nombrestiposuelos = $_POST["fnombrestiposuelos"];


$nombrestiposuelos = htmlspecialchars($nombrestiposuelos);

$objetotiposuelos = new tiposuelos($conexion,$idtiposuelos,$nombrestiposuelos);

switch($opcion){
    case 'ingresar':
        $objetotiposuelos->insertar();
        $mensaje="ingresado";
    break;

    case 'modificar':
        $objetotiposuelos->modificar();
        $mensaje="modificado";
    break;

    case 'eliminar':
        $objetotiposuelos->eliminar();
        $mensaje="eliminado";
    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariotiposuelos.php?msj=$mensaje");
?>