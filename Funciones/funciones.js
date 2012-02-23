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
var mailres = true;             
    var cadena = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890@._-"; 
     
    var arroba = texto.indexOf("@",0); 
    if ((texto.lastIndexOf("@")) != arroba) arroba = -1; 
     
    var punto = texto.lastIndexOf("."); 
                 
     for (var contador = 0 ; contador < texto.length ; contador++){ 
        if (cadena.indexOf(texto.substr(contador, 1),0) == -1){ 
            mailres = false; 
            break; 
     } 
    } 

    if ((arroba > 1) && (arroba + 1 < punto) && (punto + 1 < (texto.length)) && (mailres == true) && (texto.indexOf("..",0) == -1)) 
     mailres = true; 
    else 
     mailres = false; 
                 
    return mailres; 
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

function hora(){
var ahora = new Date()
dia = new Array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
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
}

function Abrir_ventana (pagina) {
	var opciones='toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1000px, height=800px, top=85, left=140';
	window.open(pagina,'',opciones);
	}

function agregar(){
var objFila = document.createElement("tr");
var objCelda = document.createElement("td");
objCelda.innerHTML=pinput;
objFila.appendChild(objCelda);

objCelda = document.createElement("td");
objCelda.innerHTML=sinput;
objFila.appendChild(objCelda);

objTabla = document.getElementById(id);
objTabla.lastChild.appendChild(objFila);
}

contador=2;

function Nuevalinea(){
id="tabla1";
contador++;
respuesta = <?echo $this->respuesta[0];?>;
valor = <?echo $this->valor[0];?>;
pinput="Respuesta "+contador;
sinput="<INPUT type='text' size='30' name='respuesta[]' value='"+respuesta+"'> Valor <INPUT type='text' size='2' name='valor[]' value='"+valor+"'>";
if (contador<6){
agregar(id, pinput, sinput);
}
}