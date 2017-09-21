<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/variedades.php");

$opcion = $_POST["fenviar"];
$idvariedades = $_POST["fidvariedades"];
$nombrevariedades = $_POST["fnombrevariedades"];


$nombrevariedades = htmlspecialchars($nombrevariedades);

$objetovariedades = new variedades($conexion,$idvariedades,$nombrevariedades);

switch($opcion){
    case 'ingresar':
        $objetovariedades->insertar();
        $mensaje="ingresado";
    break;

    case 'modificar':
        $objetovariedades->modificar();
        $mensaje="modificado";
    break;

    case 'eliminar':
        $objetovariedades->eliminar();
        $mensaje="eliminado";
    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariovariedades.php?msj=$mensaje");
?>