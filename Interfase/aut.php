<?php
session_start();
$login=$_POST["loginUsuario"];
include("../Clases/usuario.php");
$usuario=new usuario();
$usuario->autenticar();
?>
<html>
<head>
  <title>Principal</title>
<link rel="stylesheet" type="text/css" href="../Estilos/general.css" />
</head>
<body>
	<form method="post" action="<?php $_self ?>">
	
		<fieldset id="forma">
		<legend>Bienvenido</legend>
		<ol>
			<li><label>Usuario</label><INPUT type="text" name="loginUsuario"></li>
			<li><label>Password</label><INPUT type="password" name="passUsuario"></li>
		</ol>
			<p align="center"><input type="submit" name="submit" class="btn" value="Enviar" /></p>
			<p id="text" align="center">
          No tienes cuenta? Registrate <a href="registro.php">aqui</a></p>
		</fieldset>
	</form>		
</body>
</html>
