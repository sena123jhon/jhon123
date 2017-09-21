<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>

<form action="../controlador/controladorlogin.php" method="post">
<input name="femail" type="email" maxlength="60" palaceholder="nombre@sucorreo.co" required autofocus>
<input name="fclave" type="password" placeholder="password" required>
<button name ="fenviar" type ="submit" value="ingresar">ingresar </button>
</form>
<?php
@$mensaje = $_GET['mensaje'];
if (isset($mensaje)){
  if($mensaje=='incorrecto'){
        echo '<div  class="alert alert-danger" role="alert"> usuario o clave incorrecto</div>';

    
  }

}
?>
</body>
</html>