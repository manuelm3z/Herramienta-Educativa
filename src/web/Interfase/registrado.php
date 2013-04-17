<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Datos Registrados</title>
<link rel="stylesheet" type="text/css" href="../Estilos/general.css" />
  </head>
  <body>
<div align="center"><?php include("../Funciones/imagenes.php") ?>
<?php banner();
?></div>
<div id="formr">
<?php
$cmdAccion=$_POST['cmdAccion'];
include("../Clases/usuario.php");
$usuario=new usuario();
$usuario->connect();
switch($cmdAccion){
		case 'Registrar':
			$usuario->registraru();
			break; 
		case 'Agregar':
			$usuario->connect();
			break;
	}
?>
</div>
<br>
<div id="pie"><?php include("../Funciones/pie.php") ?>
<?php pie();
?></div>
  </body>
</html>