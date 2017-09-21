<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/arbol.php");

$opcion = $_POST["fenviar"];
$idarbol = $_POST["fidarbol"];
$alturaarbol = $_POST["falturaarbol"];
$cantidadderamasarbol = $_POST["fcantidadderamasarbol"];
$idfincaarbol = $_POST["fidfincaarbol"];
$idterrenoarbol = $_POST["fidterrenoarbol"];
$idvariedadesarbol = $_POST["fidvariedadesarbol"];



$alturaarbol = htmlspecialchars($alturaarbol);
$cantidadderamasarbol = htmlspecialchars($cantidadderamasarbol);
$idfincaarbol = htmlspecialchars($idfincaarbol);
$idterrenoarbol = htmlspecialchars($idterrenoarbol);
$idvariedadesarbol = htmlspecialchars($idvariedadesarbol);



$objetoarbol = new arbol($conexion,$idarbol,$alturaarbol,$cantidadderamasarbol,$idfincaarbol,$idterrenoarbol,$idvariedadesarbol);

switch($opcion){
    case 'ingresar':
        $objetoarbol->insertar();
        $mensaje="ingresado";
    break;

    case 'modificar':
        $objetoarbol->modificar();
        $mensaje="modificado";
    break;

    case 'eliminar':
        $objetoarbol->eliminar();
        $mensaje="eliminado";
    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioarbol.php?msj=$mensaje");
?>