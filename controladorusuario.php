<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/usuario.php");

$opcion = $_POST["fenviar"];
$idusuario = $_POST["fidusuario"];
$nombreusuario = $_POST["fnombreusuario"];
$correousuario = $_POST["fcorreousuario"];
$claveusuario = $_POST["fclaveusuario"];
$fecharegistrousuario = $_POST["ffecharegistrousuario"];
$fechaultimaclave = $_POST["ffechaultimaclave"];             
$celularusuario = $_POST["fcelularusuario"];
$idrolusuario = $_POST["fidrolusuario"];

$nombreusuario = htmlspecialchars($nombreusuario);
$correousuario  = htmlspecialchars($correousuario);
$claveusuario = htmlspecialchars($claveusuario);
$fecharegistrousuario = htmlspecialchars($fecharegistrousuario);
$fechaultimaclave = htmlspecialchars($fechaultimaclave);
$celularusuario = htmlspecialchars($celularusuario);
$idrolusuario  = htmlspecialchars($idrolusuario);


$objetousuario = new usuario($conexion,$idusuario,$nombreusuario,$correousuario,$claveusuario,$fecharegistrousuario,$fechaultimaclave,$celularusuario,$idrolusuario);

switch($opcion){
    case 'ingresar':
    $objetousuario->insertar();
    $mensaje="ingresado";

    break;

        case 'modificar':
    $objetousuario->modificar();
    $mensaje="modificado";

    break;

       case 'eliminar':
    $objetousuario->eliminar();
    $mensaje="eliminado";

    break;
}

$objetoconexion->desconectar($conexion);
header("location:../vista/formulariousuario.php?msj=$mensaje");
?>