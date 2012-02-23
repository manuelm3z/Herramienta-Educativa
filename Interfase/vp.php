<?php
include("../Clases/usuario.php");
$usuario=new usuario();
?>
<?php
include("../Clases/modulo.php");
$modulo=new modulo();
$modulo->vistaPrevia();
?>
<html>
<HEAD><TITLE>Vista Previa del Modulo Numero <? //echo $this->numeroModulo; ?></TITLE>
</HEAD>
<BODY>
<h1>Vista Previa del Modulo Numero <? echo $modulo->numeroModulo; ?></h1>
<div>Numero: <? echo $modulo->numeroModulo; ?></div>
<div>Titulo: <? echo $modulo->nombreModulo; ?></div>
<div><IMG src='imagen.php?nm=<? echo $modulo->numeroModulo; ?>' align='left' border='0' width='500px'></div>
<p align='justify'> <? echo $modulo->contenidoModulo; ?></p>
</BODY>
</html>