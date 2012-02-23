<?php
session_start();
include("../Clases/usuario.php");
$usuario=new usuario();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Editar Perfil</title>
<link rel="stylesheet" type="text/css" href="../Estilos/general.css" />
<script type='text/javascript' src="../Funciones/funciones.js">
</script> 
  </head>
  <body>
<div align="center"><?php include("../Funciones/imagenes.php") ?>
<?php banner();
?></div>
<div id="links">
<?php
print_r ($_SESSION['loginUsuario']);
?>
</div>
<div id="links_modulo">
<?php
?>
<A href="main.php">Inicio</A>
</div> 
<div id="marco">
<div id="contenido">
<br>
<script type='text/javascript'> 
hora();
</script>
<hr>
<?php
$usuario->buscarautedit();
?>
<br><br>
</div>
<hr>
<div id="pie">
<?php 
include("../Funciones/pie.php");
pie();
?></div>
</div>
  </body>
</html>>