<?php
session_start();
include("../Clases/usuario.php");
$usuario=new usuario();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Principal</title>
<link rel="stylesheet" type="text/css" href="../Estilos/general.css" />

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
$usuario->links();
?>
</div> 
<div id="marco">
<div id="contenido">
<br>
<script type='text/javascript'> 
var ahora = new Date()
dia = new Array('Domingo', 'Lunes', 'Martes', 'Mercoles', 'Jueves', 'Viernes', 'Sabado');
mes = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
document.write(dia[ahora.getDay()])
document.write(' ')
document.write(ahora.getDate())
document.write(' del mes de ')
document.write(mes[ahora.getMonth()])
document.write(' del a&ntilde;o ')
document.write(ahora.getFullYear())
document.write(' a las ')
document.write(ahora.getHours())
document.write(':')
document.write(ahora.getMinutes())
document.write(':')
document.write(ahora.getSeconds())
</script>
<hr>
<?php
$usuario->contenido();
?>
</div>
<hr>
<div id="pie"><?php include("../Funciones/pie.php") ?>
<?php pie();
?></div>
</div>
  </body>
</html>
