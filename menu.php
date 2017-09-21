 <!DOCTYPE html>
<html>
<head></head>

<nav>
<ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='finca')?'active':''); ?>"          href="formulariofinca.php">Finca</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='arbol')?'active':''); ?>"          href="formularioarbol.php">Arbol</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='aplicaciones')?'active':''); ?>"   href="formularioaplicaciones.php">Aplicaciones</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='tipoaplicacion')?'active':''); ?>" href="formulariotipoaplicacion.php">TipoAplicacion</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='variedades')?'active':''); ?>" href="formulariovariedades.php">Variedades</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='terreno')?'active':''); ?>" href="formularioterreno.php">Terreno</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='tiposuelos')?'active':''); ?>" href="formulariotiposuelos.php">TiposSuelo</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='enfermedades')?'active':''); ?>" href="formularioenfermedades.php">enfermedades</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='ataque')?'active':''); ?>" href="formularioataque.php">ataque</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='floracion')?'active':''); ?>" href="formulariofloracion.php">floracion</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='foliacion')?'active':''); ?>" href="formulariofoliacion.php">foliacion</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='produccion')?'active':''); ?>" href="formularioproduccion.php">produccion</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='podas')?'active':''); ?>" href="formulariopodas.php">podas</a>
  </li>
   <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='roles')?'active':''); ?>" href="formularioroles.php">roles</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='usuario')?'active':''); ?>" href="formulariousuario.php">usuario</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='auditoria')?'active':''); ?>" href="formularioauditoria.php">auditoria</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo (($formulario=='cerrarsesion')?'active':''); ?>" href="formulariocerrarsesion.php">Cerrar sesion</a>
  </li>
</ul>
<nav>

</html>