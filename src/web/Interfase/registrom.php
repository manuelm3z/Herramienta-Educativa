<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Registro de Usuario</title>
<link rel="stylesheet" type="text/css" href="../Estilos/general.css" /><script type='text/javascript'>
function vacio(q) {
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}

marcas=false; 
    function sexo(q){ 
    if(!marcas){  
    return false; 
    } 
    else{ 
    return true; 
    } 
    } 


function Clave(clave1, clave2){ 
   	if (clave1 == clave2){
	return true
		}else{
		return false
	}
}

function email(valor) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
   return true
  } else {
   return false
  }
}

function valida(F){
	if(vacio(F.loginUsuario.value) == false){
	alert("Introduce tu Usuario.")
      	return false
		}else{
      		if(vacio(F.passUsuario.value) == false){
      		alert("Introduce tu Password.")
        	return false
        		}else{
            		if(vacio(F.cpassUsuario.value) == false){
            		alert("Confirma tu Password.")
            		return false
            		}else{
            		if(vacio(F.nombres.value) == false){
            		alert("Introduce tus Nombres.")
            		return false
            			}else{
            			if(vacio(F.apellidos.value) == false){
            			alert("Introduce tus Apellidos.")
				return false
					}else{
					if(vacio(F.nac.value) == false){
					alert("Selecciona tu nacionalidad.")
            				return false
            					}else{
            					if(vacio(F.cedula.value) == false){
            					alert("Introduce tu numero de Cedula.")
            					return false
            						}else{
            						if(vacio(F.direccion.value) == false){
            						alert("Introduce tu Direccion.")
            						return false
            							}else{
            							if(vacio(F.telefono.value) == false){
            							alert("Introduce tu numero Telefonico.")
            							return false
            								}else{
            								if(vacio(F.email.value) == false){
            								alert("Introduce tu Email.")
            								return false
            									}else{
            									if(vacio(F.dia_nac.value) == false){
            									alert("Selecciona tu dia de nacimiento.")
            									return false
            										}else{
            										if(vacio(F.mes_nac.value) == false){
            										alert("Selecciona tu mes de nacimiento.")
            										return false
            											}else{
            											if(vacio(F.year_nac.value) == false){
            											alert("Selecciona tu año de nacimiento.")
            											return false
            												}else{
            												if(sexo(F.sexo.value) == false){
            												alert("Selecciona tu Sexo.")
            												return false
            													}else{
														if(Clave(F.passUsuario.value, F.cpassUsuario.value) == false){
														alert("Escribe correctamente los passwords.")
														return false
															}else{
            														if(email(F.email.value) == false){
															alert("Escribe correctamente tu email.")
															return false
																}else{
            															return true
																}
															}
            													}				
            												}
            											}
        										}
        									}
        								}
        							}
        						}
        					}
        				}
        			}
        		}
        	}
	}
}
</script> 
  </head>
  <body>
<div align="center"><?php include("../Funciones/imagenes.php") ?>
<?php banner();
?></div>
<div>
	<form method="post" name="usuario" action="registrado.php" onSubmit="return valida(this);">
		<fieldset id="formr">
		<legend>Registro de Datos</legend>
		<ol>
			<li><label>Numero del Modulo</label><INPUT type="text" size="30" name="numeroModulo"></li>
			<li><label>Nombre del Modulo</label><INPUT type="text" size="30" name="nombreModulo"></li>
			<li><label>Contenido del Modulo</label><textarea name="contenidoModulo" rows="10" cols="30"></textarea></li>
			<li><label>Imagen</label><INPUT type="image" size="30" name="imagen"></li>
		</ol>
		</fieldset>
		
	</form>
</div>
<br>
<div id="pie"><?php include("../Funciones/pie.php") ?>
<?php pie();
?></div>
  </body>
</html>
