<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/ataque.php");

$opcion = $_POST["fenviar"];
$idataque = $_POST["fidataque"];
$fechadeataque = $_POST["ffechadeataque"];
$idenfermedadesataque = $_POST["fidenfermedadesataque"];
$idarbolataque = $_POST["fidarbolataque"];

$fechadeataque  = htmlspecialchars($fechadeataque);
$idenfermedadesataque = htmlspecialchars($idenfermedadesataque);
$idarbolataque = htmlspecialchars($idarbolataque);

$objetoataque = new ataque($conexion,$idataque,$fechadeataque,$idenfermedadesataque,$idarbolataque);

switch($opcion){
    case 'ingresar':
    $objetoataque->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetoataque->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetoataque->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formularioataque.php?msj=$mensaje");
?>