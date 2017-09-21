<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/podas.php");

$opcion = $_POST["fenviar"];
$idpodas = $_POST["fidpodas"];
$tipopodas = $_POST["ftipopodas"];
$fechapodas = $_POST["ffechapodas"];
$idarbolpodas = $_POST["fidarbolpodas"];

$tipopodas  = htmlspecialchars($tipopodas);
$fechapodas = htmlspecialchars($fechapodas);
$idarbolpodas = htmlspecialchars($idarbolpodas);

$objetopodas = new podas($conexion,$idpodas,$tipopodas,$fechapodas,$idarbolpodas);

switch($opcion){
    case 'ingresar':
    $objetopodas->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetopodas->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetopodas->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariopodas.php?msj=$mensaje");
?>