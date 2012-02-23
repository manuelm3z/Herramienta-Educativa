<?php
session_start();
session_destroy();
?>
<p>Hasta Pronto</p>
<script> 
setTimeout("document.location.href='aut.php';",2000);
</script> 