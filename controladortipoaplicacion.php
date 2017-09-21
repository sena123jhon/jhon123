<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/tipoaplicacion.php");

$opcion = $_POST["fenviar"];
$idtipoaplicacion = $_POST["fidtipoaplicacion"];
$nombretipoaplicacion = $_POST["fnombretipoaplicacion"];
$tipohervicida = $_POST["ftipohervicida"];
$tipofungicida = $_POST["ftipofungicida"];
$tipoabono = $_POST["ftipoabono"];
$nombrefungicida = $_POST["fnombrefungicida"];
$nombrehervicida = $_POST["fnombrehervicida"];
$nombreabono = $_POST["fnombreabono"];


$nombretipoaplicacion = htmlspecialchars($nombretipoaplicacion);
$tipohervicida = htmlspecialchars($tipohervicida);
$tipofungicida = htmlspecialchars($tipofungicida);
$tipoabono = htmlspecialchars($tipoabono);
$nombrefungicida = htmlspecialchars($nombrefungicida);
$nombrehervicida = htmlspecialchars($nombrehervicida);
$nombreabono = htmlspecialchars($nombreabono);


$objetotipoaplicacion = new tipoaplicacion($conexion,$idtipoaplicacion,$nombretipoaplicacion,$tipohervicida,$tipofungicida,$tipoabono,$nombrefungicida,$nombrehervicida,$nombreabono);

switch($opcion){
    case 'ingresar':
        $objetotipoaplicacion->insertar();
        $mensaje="ingresado";
    break;

    case 'modificar':
        $objetotipoaplicacion->modificar();
        $mensaje="modificado";
    break;

    case 'eliminar':
        $objetotipoaplicacion->eliminar();
        $mensaje="eliminado";
    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariotipoaplicacion.php?msj=$mensaje");
?>