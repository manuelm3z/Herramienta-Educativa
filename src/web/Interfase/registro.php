<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Registro de Usuario</title>
<link rel="stylesheet" type="text/css" href="../Estilos/general.css" />
<script type='text/javascript' src="../Funciones/funciones.js">
</script>
  </head>
  <body>
<div align="center"><?php include("../Funciones/imagenes.php") ?>
<?php banner();
?></div>
<div>
<?php
$loginUsuario=$_POST['loginUsuario'];
include("../Clases/usuario.php");
$usuario=new usuario();
if($loginUsuario!=''){
$usuario->registraru();
}else{
$usuario->formregistro();
}
?>
</div>
<br>
<div id="pie"><?php include("../Funciones/pie.php") ?>
<?php pie();
?></div>
  </body>
</html>
