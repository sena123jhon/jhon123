<html>
  <head>
    <title>
      JC soft.
    </title>
    <meta charSet="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/devices.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  </head>
  <body>
    <header class="header">
      <div class="container-lrg">
        <div class="col-12 spread">
          <div>
            <a class="logo">
              <font><font><font><font>Jc soft</font></font></font></font><br>
            </a>
          </div>
          
<div>
<form action="controlador/controladorlogin.php" method="post">
<input name="fcorreo" type="correo" maxlength="60" palaceholder="nombre@sucorreo.co" required autofocus>
<input name="fclave" type="password" placeholder="password" required>
<button name ="fenviar" type ="submit" class="btn btn-success" value="ingresar">ingresar </button>
</form>
<?php
@$mensaje = $_GET['mensaje'];
if (isset($mensaje)){
  if($mensaje=='incorrecto'){
        echo '<div  class="alert alert-danger" role="alert"> usuario o clave incorrecto</div>';

    
  }

}
?>
</div>

          <div>
            <a class="nav-link" href="#">
              Twitter
            </a>
            <a class="nav-link" href="#">
              Facebook
            </a>
          </div>
        </div>
      </div>
      <div class="container-sml ">
        <div class="col-12">
          <h1 class="heading text-center">
            <font><font><font><font><font><font>Sistema de Información &nbsp;para cultivo de guayaba tecnificada.</font></font></font></font></font></font>
          </h1>
        </div>
      </div>
      <div class="container-lrg">
        <div class="centerdevices col-12">
          <div class="browseriphone">
           
            <div class="browser">
              <div class="mask">
                <img class="mask-img" src="http://i0.wp.com/www.saludbook.info/wp-content/uploads/2016/10/Guayaba-una-fruta-muy-rica-en-Antioxidantes-y-Vitamina-C.17.jpg">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-sml">
      <div class="col-12 text-center">
        <h2 class="paragraph">
          <font><font><font><font><font><font>Este sistema permite almacenar los datos de un cultivo de guayaba tecnificada, permitiendole al agricultor Una mejor portabilidad de ellos.</font></font></font></font></font></font>
        </h2>
       
        </div>
      </div>
    </header>
    <div class="feature4">
      <div class="container-lrg flex">
        <div class="col-5 centervertical">
          <h3 class="subheading">
            <font><font>Ingreso sencillo</font></font>
          </h3>
          <p class="paragraph">
            Podra &nbsp;ver las ubicacaiones con gps de cada una de las fincas donde se establece el cutivo tecnificado.
          </p>
        </div>
        <div class="col-1">
        </div>
        <div class="col-6">
          <div class="sidedevices">
            <div class="browseriphone">
              <div class="iphone">
                <div class="mask">
                  <img class="mask-img" src="https://3.bp.blogspot.com/-5D6CtX-x92M/V0egwPB1guI/AAAAAAAAI4Q/loelPymkyXQ92bg87jpsp4EBPVyuyCpAQCK4B/s640/1.PNG">
                </div>
              </div>
              <div class="browser">
                <div class="mask">
                  <img class="mask-img" src="https://mayoresdehoy.files.wordpress.com/2012/12/13809812-exotico-guayaba-amarilla-desde-hawai-con-greeen-deja-en-el-fondo-blanco.jpg">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="feature1">
      <div class="container-sml">
        <div class="col-12 text-center">
          <h3 class="heading">
            Almacenamiento de informacion
          </h3>
          <p class="paragraph">
            Podras almacenar mucha informacion con alta precicion.
          </p>
        </div>
      </div>
      <div class="container-lrg centerdevices col-12">
        <div class="iphoneipad2">
       
          </div>
           <div class="browser">
                <div class="mask">
                  <img class="mask-img" src="http://www.elterritorio.com.ar/verimg.aspx?F=1&A=810&O=/img/1/156/8330372120585671_1.jpg">
                </div>
          </div>
        </div>
      </div>
    </div>
    <div class="socialproof">
      <div class="container-sml">
        <div class="flex text-center">
          <div class="col-12">
            <h4 class="subheading">
              Ahora podemos &nbsp;hacer las cosas mas faciles en nuestro cultivo.
            </h4>
            <p class="paragraph">
              delio123@hotmail.com
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container-sml">
        <div class="col-12 text-center">
          <div>
            <a class="nav-link">
              Twitter
            </a>
            <a class="nav-link">
              Facebook
            </a>
            <a class="nav-link">
              Contact
            </a>
            <a class="nav-link">
              TOS
            </a>
            <a class="nav-link">
              Privacy
            </a>
          </div>
          <br>
          <div>
            <span>
              © 2017 jc soft.
            </span>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>