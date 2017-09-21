<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/roles.php");

$opcion = $_POST["fenviar"];
$idroles = $_POST["fidroles"];
$nombreroles = $_POST["fnombreroles"];
$arbolroles = $_POST["farbolroles"];
$fincaroles = $_POST["ffincaroles"];
$podasroles = $_POST["fpodasroles"];
$produccionroles = $_POST["fproduccionroles"];
$foliacionroles = $_POST["ffoliacionroles"];
$floracionroles = $_POST["ffloracionroles"];
$enfermedadesroles = $_POST["fenfermedadesroles"];
$ataqueroles = $_POST["fataqueroles"];
$variedadesroles = $_POST["fvariedadesroles"];
$terrenoroles = $_POST["fterrenoroles"];
$aplicacionesroles = $_POST["faplicacionesroles"];
$tipoaplicacionroles = $_POST["ftipoaplicacionroles"];
$usuarioroles = $_POST["fusuarioroles"];
$auditoriaroles = $_POST["fauditoriaroles"];

$nombreroles  = htmlspecialchars($nombreroles);
$arbolroles = htmlspecialchars($arbolroles);
$fincaroles = htmlspecialchars($fincaroles);
$dirreccionroles = htmlspecialchars($podasroles);
$produccionroles = htmlspecialchars($produccionroles);
$foliacionroles  = htmlspecialchars($foliacionroles);
$floracionroles  = htmlspecialchars($floracionroles);
$enfermedadesroles  = htmlspecialchars($enfermedadesroles);
$ataqueroles  = htmlspecialchars($ataqueroles);
$variedadesroles  = htmlspecialchars($variedadesroles);
$terrenoroles  = htmlspecialchars($terrenoroles);
$aplicacionesroles  = htmlspecialchars($aplicacionesroles);
$tipoaplicacionroles  = htmlspecialchars($tipoaplicacionroles);
$usuarioroles  = htmlspecialchars($usuarioroles);
$auditoriaroles  = htmlspecialchars($auditoriaroles);

$objetoroles = new roles($conexion,$idroles,$nombreroles,$arbolroles,$fincaroles,$dirreccionroles,$produccionroles,$foliacionroles,$floracionroles,$enfermedadesroles,$ataqueroles,$variedadesroles,$terrenoroles,$aplicacionesroles,$tipoaplicacionroles,$usuarioroles,$auditoriaroles);

switch($opcion){
    case 'ingresar':
    $objetoroles->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetoroles->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetoroles->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioroles.php?msj=$mensaje");
?>