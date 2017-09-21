<?php
$correousuario= $_POST["fcorreo"];
$claveusuario= $_POST["fclave"];

include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

$correousuario = mysqli_real_escape_string($conexion, $correousuario);

include_once("../modelo/login.php");
$objetologin = new login($conexion, $correousuario, $claveusuario);
$usuarioesvalido = $objetologin->verificarusuario();

if ($usuarioesvalido==true){
    session_start();
    $_SESSION['id']      =    $objetologin->getidusuario();
    $_SESSION['nombre']  =    $objetologin->getnombreusuario();
    $_SESSION['rol']     =    $objetologin->getidrolusuario();
    $objetoconexion-> desconectar($conexion);
 header("location:../vista/formularioarbol.php");
}else{
    $objetoconexion-> desconectar($conexion);      
 header("location:../index.php?mensaje=incorrecto");
  }
 ?> 