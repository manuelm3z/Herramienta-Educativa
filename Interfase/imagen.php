<?php
include("../Clases/usuario.php");
$usuario=new usuario();
?>
<?php
include("../Clases/modulo.php");
$modulo=new modulo();
$modulo->imagen();
header("Content-Type: $modulo->tipo");
print $modulo->imagen;
?>
