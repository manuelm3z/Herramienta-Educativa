<?php
class usuario{
	public $conexion;
	public $db;
	public $id_usuario;
	public $loginUsuario;
	public $passUsuario;
	public $cpassUsuario;
	private $nombres;
	private $apellidos;
	private $nac;
	private $cedula;
	private $direccion;
	private $telefono;
	private $email;
	private $dia_nac;
	private $mes_nac;
	private $year_nac;
	private $sexo;
	private $consulta1;
	private $consulta2;
	private $consulta3;
	public $tipo;
	public $autloginUsuario;
	public $autpassUsuario;
	public $fecha_nac;		
		
	public function __construct(){
		$this->conexion=(@mysql_connect("localhost","root","1234"));
		$this->db=(@mysql_select_db("soft_educ",$this->conexion));
		$this->id_usuario=($_POST['id_usuario']);
		$this->loginUsuario=($_POST['loginUsuario']);
		$this->passUsuario=($_POST['passUsuario']);
		$this->cpassUsuario=($_POST['cpassUsuario']);
		$this->nombres=($_POST['nombres']);
		$this->apellidos=($_POST['apellidos']);
		$this->nac=($_POST['nac']);
		$this->cedula=($_POST['cedula']);
		$this->direccion=($_POST['direccion']);
		$this->telefono=($_POST['telefono']);
		$this->email=($_POST['email']);
		$this->dia_nac=($_POST['dia_nac']);
		$this->mes_nac=($_POST['mes_nac']);
		$this->year_nac=($_POST['year_nac']);
		$this->sexo=($_POST['sexo']);
		$this->fecha=$this->year_nac.$this->mes_nac.$this->dia_nac;
		$this->autloginUsuario=($_SESSION['loginUsuario']);
	}
	
	public function registraru(){
		$this->consulta1=(mysql_query("SELECT * FROM usuario WHERE usuario='$this->loginUsuario';"));
		if(mysql_num_rows($this->consulta1)>0){
			echo "Usuario ya existe!!!, en breve ser&aacute; redireccionado";
			echo "<script>";
			echo "setTimeout('document.location.href='registro.php';',5000);";
			echo "</script>";
		}else{
			$this->consulta2=(mysql_query("insert into usuario values(0, '$this->loginUsuario', '$this->passUsuario', 'usuario', curdate(), '$this->cedula');"));
			$this->consulta3=(mysql_query("insert into datos values(0, '$this->nombres', '$this->apellidos', '$this->nac', '$this->cedula', '$this->direccion', '$this->telefono', '$this->email', '$this->fecha', '$this->sexo');"));
			$this->autenticar();
		}
	}
		
	public function registrarud(){
		$this->consulta1=(mysql_query("SELECT * FROM usuario WHERE usuario='$this->loginUsuario';"));
		if(mysql_num_rows($this->consulta1)>0){
			echo "Usuario ya existe!!!";
		}else{
			$this->consulta2=(mysql_query("insert into usuario values(0, '$this->loginUsuario', '$this->passUsuario', 'usuario', curdate(), '$this->cedula');"));
			$this->consulta3=(mysql_query("insert into datos values(0, '$this->nombres', '$this->apellidos', '$this->nac', '$this->cedula', '$this->direccion', '$this->telefono', '$this->email', '$this->fecha', '$this->sexo');"));
			echo "Usuario Registrado!";
		}
	}

	public function registrara(){
		$this->consulta1=(mysql_query("SELECT * FROM usuario WHERE usuario='$this->loginUsuario';"));
		if(mysql_num_rows($this->consulta1)>0){
			echo "Usuario ya existe!!!";
		}else{
			$this->consulta2=(mysql_query("insert into usuario values(0, '$this->loginUsuario', '$this->passUsuario', 'admin', curdate(), $this->cedula);"));
			$this->consulta3=(mysql_query("insert into datos values(0, '$this->nombres', '$this->apellidos', '$this->nac', '$this->cedula', '$this->direccion', '$this->telefono', '$this->email', '$this->fecha', '$this->sexo');"));
			echo "Usuario Registrado!";
		}
	}

	public function buscar(){
		$this->consulta1=(mysql_query("SELECT login, fecha FROM usuario WHERE cedula='$this->cedula';"));
		$this->consulta2=(mysql_query("SELECT * FROM datos WHERE cedula='$this->cedula';"));
		if(mysql_num_rows($this->consulta1)>0){
	       		$this->registro=(mysql_fetch_array($this->consulta1));
        		$this->loginUsuario=($this->registro[0]);
        		$this->fecha=($this->registro[1]);
        		$this->registro2=(mysql_fetch_array($this->consulta2));
        		$this->nombres=($this->registro2[1]);
			$this->apellidos=($this->registro2[2]);
			$this->nac=($this->registro2[3]);
			$this->cedula=($this->registro2[4]);
			$this->direccion=($this->registro2[5]);
			$this->telefono=($this->registro2[6]);
			$this->email=($this->registro2[7]);
			$this->fecha_nac=($this->registro2[8]);
			$this->sexo=($this->registro2[9]);
        	}else{
        		$this->nombres='NO ENCONTRADO';
        	}

		echo "<form>";
		echo "<fieldset id='inside'>";
		echo "<legend>";
		echo $this->loginUsuario;
		echo "</legend>";
		echo "<ol>";
		echo "<li>";
		echo "Fecha de Inscripci&oacute;n: ".$this->fecha;
		echo "</li>";
		echo "<li>";
		echo "Nombres: ".$this->nombres;
		echo "</li>";
		echo "<li>";
		echo "Apellidos: ".$this->apellidos;
		echo "</li>";
		echo "<li>";
		echo "Cedula: ".$this->nac.$this->cedula;
		echo "</li>";
		echo "<li>";
		echo "Direcci&oacute;n: ".$this->direccion;
		echo "</li>";
		echo "<li>";
		echo "Tel&eacute;fono: ".$this->telefono;
		echo "</li>";
		echo "<li>";
		echo "Email: ".$this->email;
		echo "</li>";
		echo "<li>";
		echo "Fecha de nacimiento: ".$this->fecha_nac;
		echo "</li>";
		echo "<li>";
		echo "Sexo: ";
		if($this->sexo==M){
		echo "Masculino";
		}else{
		echo "Femenino";
		}
		echo "</li>";
		echo "</ol>";
		echo "</fieldset>";
		echo "</form>";
	}

	public function buscaraut(){
		$this->consulta1=(mysql_query("SELECT login, fecha FROM usuario WHERE cedula=(SELECT cedula from usuario where login='$this->autloginUsuario');"));
		$this->consulta2=(mysql_query("SELECT * FROM datos WHERE cedula=(SELECT cedula from usuario where login='$this->autloginUsuario');"));
		if(mysql_num_rows($this->consulta1)>0){
	       		$this->registro=(mysql_fetch_array($this->consulta1));
        		$this->loginUsuario=($this->registro[0]);
        		$this->fecha=($this->registro[1]);
        		$this->registro2=(mysql_fetch_array($this->consulta2));
        		$this->nombres=($this->registro2[1]);
			$this->apellidos=($this->registro2[2]);
			$this->nac=($this->registro2[3]);
			$this->cedula=($this->registro2[4]);
			$this->direccion=($this->registro2[5]);
			$this->telefono=($this->registro2[6]);
			$this->email=($this->registro2[7]);
			$this->fecha_nac=($this->registro2[8]);
			$this->sexo=($this->registro2[9]);
        	}else{
        		$this->nombres='NO ENCONTRADO';
        	}

		echo "<form>";
		echo "<fieldset id='inside'>";
		echo "<legend>";
		echo $this->loginUsuario;
		echo "</legend>";
		echo "<ol>";
		echo "<li>";
		echo "Fecha de Inscripci&oacute;n: ".$this->fecha;
		echo "</li>";
		echo "<li>";
		echo "Nombres: ".$this->nombres;
		echo "</li>";
		echo "<li>";
		echo "Apellidos: ".$this->apellidos;
		echo "</li>";
		echo "<li>";
		echo "Cedula: ".$this->nac.$this->cedula;
		echo "</li>";
		echo "<li>";
		echo "Direcci&oacute;n: ".$this->direccion;
		echo "</li>";
		echo "<li>";
		echo "Tel&eacute;fono: ".$this->telefono;
		echo "</li>";
		echo "<li>";
		echo "Email: ".$this->email;
		echo "</li>";
		echo "<li>";
		echo "Fecha de nacimiento: ".$this->fecha_nac;
		echo "</li>";
		echo "<li>";
		echo "Sexo: ";
		if($this->sexo==M){
		echo "Masculino";
		}else{
		echo "Femenino";
		}
		echo "</li>";
		echo "</ol>";
		echo "</fieldset>";
		echo "</form>";
	}

	public function autenticar(){
		if($this->loginUsuario!=""){
			$this->consulta1=(mysql_query("SELECT login, password, tipo FROM usuario where login='$this->loginUsuario' and password='$this->passUsuario';"));
			$this->consulta2=(mysql_query("SELECT * FROM datos WHERE cedula='$this->cedula';"));
			if(mysql_num_rows($this->consulta1)>0){
	        		$this->registro=(mysql_fetch_array($this->consulta1));
				$this->autloginUsuario=($this->registro[0]);
				$this->autpassUsuario=($this->registro[1]);
				$this->tipo=($this->registro[2]);
	        		$_SESSION['loginUsuario']  = $this->autloginUsuario;
				$_SESSION['passUsuario']  = $this->autpassUsuario;
				$_SESSION['tipo']  = $this->tipo;
				header ("Location: main.php");
	        	}else{
	        		echo "Usuario o Password incorrectos, intente de nuevo";
				echo "<script>";
				echo "setTimeout('document.location.href='aut.php';',5000);";
				echo "</script>";
	        	}
		}
	}
		
	public function modificar(){
		$this->consulta1=(mysql_query("SELECT login, fecha FROM usuario WHERE cedula='$this->cedula';"));
		$this->consulta2=(mysql_query("SELECT * FROM datos WHERE cedula='$this->cedula';"));
		if(mysql_num_rows($this->consulta1)>0){
        		$this->registro=(mysql_fetch_array($this->consulta1));
        		$this->nombres=($this->registro[0]);
        		$this->apellidos=($this->registro[1]);
        		$this->registro2=(mysql_fetch_array($this->consulta2));
        		$this->asis=($this->registro2[0]);
        	}else{
        		$this->nombres='NO ENCONTRADO';
        	}
	}
		
	public function eliminar(){
		$this->consulta1=(mysql_query("SELECT login, fecha FROM usuario WHERE cedula='$this->cedula';"));
		$this->consulta2=(mysql_query("SELECT * FROM datos WHERE cedula='$this->cedula';"));
		if(mysql_num_rows($this->consulta1)>0){
	       		$this->registro=(mysql_fetch_array($this->consulta1));
        		$this->nombres=($this->registro[0]);
        		$this->apellidos=($this->registro[1]);
        		$this->registro2=(mysql_fetch_array($this->consulta2));
        		$this->asis=($this->registro2[0]);
        	}else{
        		$this->nombres='NO ENCONTRADO';
        	}
	}

	public function links(){
		$this->tipo=($_SESSION['tipo']);
		switch ($this->tipo){
			case admin:
				echo "<a href='main.php?m=m'>Modulo</a> <a href='main.php?m=u'>Usuarios</a> <a href='main.php?m=n'>Notas</a> <a href='main.php?m=e'>Evaluaci&oacute;n</a> <a href='out.php'>Cerrar Sesi&oacute;n</a>";
        		break;
    			case usuario:
				echo "<a href='main.php?m=m'>Modulo</a> <a href='main.php?m=n'>Perfil</a> <a href='out.php'>Cerrar Sesi&oacute;n</a>";
        		break;
		}
	}

	public function contenido(){
		include("../Clases/modulo.php");
		$modulo=new modulo();
		include("../Clases/evaluaciones.php");
		$evaluacion=new evaluacion();
		include("../Clases/notas.php");
		$notas=new notas();
		$this->tipo=($_SESSION['tipo']);
		switch ($this->tipo){
			case admin:
				$m=$_GET['m'];
				switch($m){
					case '':
						echo "Bienvenido Administrador!!!, aqui podr&aacute;s realizar los cambios respectivos al sistema.";
					break; 
					case 'm':
						$modulo->mainModulo();
					break;
					case 'u':
						$this->linksusuario();
					break;
					case 'e':
						$evaluacion->mainEvaluacion();
					break;
					case 'n':
						$notas->formNotas();
					break;
				}
        		break;
    			case usuario:
				$m=$_GET['m'];
				switch($m){
					case '':
						echo "Bienvenido! Aprender Software Libre es lo m&aacute;s f&aacute;cil, sencillo, pr&aacute;ctico, util. Con este Software Educativo lo podr&aacute;s hacer!
						<br>
						Para ver los modulos a estudiar haz click en el link modulos.
						<br>
						En el link notas podr&aacute;s verifcar el progreso de tus notas";
					break; 
					case 'm':
						$cmdAccion=$_POST['cmdAccion'];
						echo "<DIV id='links_modulo'>";
						$modulo->mainModulou();
						echo "</DIV><DIV id='contenido_modulo'>";
						$modulo->mainModulouC();
						echo "</DIV><DIV id='contenido_modulo'>";
						if($cmdAccion!=''){
						$notas->corregir();
						$evaluacion->buscarEvaCor();
						}else{
						$evaluacion->buscarEvaCor();
						}
						echo "</DIV>";
					break;
					case 'n':
						$this->buscaraut();
						$notas->buscaraut();
					break;
				}
			break;	
		}
	}

	public function formregistro(){
	echo "<form method='post' name='usuario' action='";
	printf($_SERVER['PHP_SELF']);
	echo "' onSubmit='return valida(this);'>
					<fieldset id='inside'>
						<legend>Registro de Datos</legend>
							<ol>
								<li><label>Usuario</label><INPUT type='text' size='30' name='loginUsuario'></li>
								<li><label>Password</label><INPUT type='password' size='30' name='passUsuario'></li>
								<li><label>Cofirmar Password</label><INPUT type='password' size='30' name='cpassUsuario'  onchange='comprobarClave()'><script>if(correcto) == false){
	document.write('<b>Escribe correctamente los password</b>');
	}else{
	document.write('<b>Passwords correctas</b>');
	      	</script></li>
							</ol>
					</fieldset>
					<fieldset id='inside'>
						<legend>Datos Personales</legend>
							<ol>
								<li><label>Nombres</label><INPUT type='text' size='50' name='nombres'></li>
								<li><label>Apellidos</label><INPUT type='text' size='50' name='apellidos'></li>
								<li><label>Cedula</label><select name='nac'><option selected value=''>Selecciona</option><option value='v'>V</option><option value='e'>E</option></select><INPUT type='text' onkeyup='this.value = this.value.slice(0,8)' size='45' name='cedula'></li>
								<li><label>Direcci&oacute;n</label><INPUT type='text' size='50' maxlength='500' name='direccion'></li>
								<li><label>Telefono</label><INPUT type='text' size='50' name='telefono'></li>
								<li><label>E-Mail</label><INPUT type='text' size='50' name='email'></li>
								<li><label>Fecha de Nacimiento</label><select name='dia_nac'><option selected value=''>DIA</option> 
													<option  value='01'>1</option> 
													<option  value='02'>2</option> 
													<option  value='03'>3</option> 
													<option  value='04'>4</option> 
													<option  value='05'>5</option> 
													<option  value='06'>6</option> 
													<option  value='07'>7</option> 
													<option  value='08'>8</option> 
													<option  value='09'>9</option> 
													<option  value='10'>10</option> 
													<option  value='11'>11</option> 
													<option  value='12'>12</option> 
													<option  value='13'>13</option> 
													<option  value='14'>14</option> 
													<option  value='15'>15</option> 
													<option  value='16'>16</option> 
													<option  value='17'>17</option> 
													<option  value='18'>18</option> 
													<option  value='19'>19</option> 
													<option  value='20'>20</option> 
													<option  value='21'>21</option> 
													<option  value='22'>22</option> 
													<option  value='23'>23</option> 
													<option  value='24'>24</option> 
													<option  value='25'>25</option> 
													<option  value='26'>26</option> 
													<option  value='27'>27</option> 
													<option  value='28'>28</option> 
													<option  value='29'>29</option> 
													<option  value='30'>30</option> 
													<option  value='31'>31</option> 
												</select> 
												<select name='mes_nac'> 
                       			 								<option selected value=''>MES</option> 
                       						 					<option  value='01'>1</option> 
													<option  value='02'>2</option> 
													<option  value='03'>3</option> 
													<option  value='04'>4</option> 
													<option  value='05'>5</option> 
													<option  value='06'>6</option> 
													<option  value='07'>7</option> 
													<option  value='08'>8</option> 
													<option  value='09'>9</option> 
													<option  value='10'>10</option> 
													<option  value='11'>11</option> 
													<option  value='12'>12</option> 
             	  	 									</select> 
												<select name='year_nac'> 
                       											<option selected value=''>A&Ntilde;O</option> 
                       											<option  value='2005'>2005</option> 
													<option  value='2004'>2004</option> 
													<option  value='2003'>2003</option> 
													<option  value='2002'>2002</option> 
													<option  value='2001'>2001</option> 
													<option  value='2000'>2000</option> 
													<option  value='1999'>1999</option> 
													<option  value='1998'>1998</option> 
													<option  value='1997'>1997</option> 
													<option  value='1996'>1996</option> 
													<option  value='1995'>1995</option> 
													<option  value='1994'>1994</option> 
													<option  value='1993'>1993</option> 
													<option  value='1992'>1992</option> 
													<option  value='1991'>1991</option> 
													<option  value='1990'>1990</option> 
													<option  value='1989'>1989</option> 
													<option  value='1988'>1988</option> 
													<option  value='1987'>1987</option> 
													<option  value='1986'>1986</option> 
													<option  value='1985'>1985</option> 
													<option  value='1984'>1984</option> 
													<option  value='1983'>1983</option> 
													<option  value='1982'>1982</option> 
													<option  value='1981'>1981</option> 
													<option  value='1980'>1980</option> 
													<option  value='1979'>1979</option> 
													<option  value='1978'>1978</option> 
													<option  value='1977'>1977</option> 
													<option  value='1976'>1976</option> 
													<option  value='1975'>1975</option> 
													<option  value='1974'>1974</option> 
													<option  value='1973'>1973</option> 
													<option  value='1972'>1972</option> 
													<option  value='1971'>1971</option> 
													<option  value='1970'>1970</option> 
													<option  value='1969'>1969</option> 
													<option  value='1968'>1968</option> 
													<option  value='1967'>1967</option> 
													<option  value='1966'>1966</option> 
													<option  value='1965'>1965</option> 
													<option  value='1964'>1964</option> 
													<option  value='1963'>1963</option> 
													<option  value='1962'>1962</option> 
													<option  value='1961'>1961</option> 
													<option  value='1960'>1960</option> 
													<option  value='1959'>1959</option> 
													<option  value='1958'>1958</option> 
													<option  value='1957'>1957</option> 
													<option  value='1956'>1956</option> 
													<option  value='1955'>1955</option> 
													<option  value='1954'>1954</option> 
													<option  value='1953'>1953</option> 
													<option  value='1952'>1952</option> 
													<option  value='1951'>1951</option> 
													<option  value='1950'>1950</option> 
													<option  value='1949'>1949</option> 
													<option  value='1948'>1948</option> 
													<option  value='1947'>1947</option> 
													<option  value='1946'>1946</option> 
													<option  value='1945'>1945</option> 
													<option  value='1944'>1944</option>
													<option  value='1943'>1943</option> 
													<option  value='1942'>1942</option> 
													<option  value='1941'>1941</option> 
													<option  value='1940'>1940</option> 
													<option  value='1939'>1939</option> 
													<option  value='1938'>1938</option> 
													<option  value='1937'>1937</option> 
													<option  value='1936'>1936</option> 
													<option  value='1935'>1935</option> 
													<option  value='1934'>1934</option> 
													<option  value='1933'>1933</option> 
													<option  value='1932'>1932</option> 
													<option  value='1931'>1931</option> 
													<option  value='1930'>1930</option> 
													<option  value='1929'>1929</option> 
													<option  value='1928'>1928</option> 
													<option  value='1927'>1927</option> 
													<option  value='1926'>1926</option> 
													<option  value='1925'>1925</option> 
													<option  value='1924'>1924</option> 
													<option  value='1923'>1923</option> 
													<option  value='1922'>1922</option> 
													<option  value='1921'>1921</option> 
													<option  value='1920'>1920</option> 
													<option  value='1919'>1919</option> 
													<option  value='1918'>1918</option> 
													<option  value='1917'>1917</option> 
													<option  value='1916'>1916</option> 
													<option  value='1915'>1915</option> 
													<option  value='1914'>1914</option> 
													<option  value='1913'>1913</option> 
													<option  value='1912'>1912</option> 
													<option  value='1911'>1911</option> 
													<option  value='1910'>1910</option> 
													<option  value='1909'>1909</option> 
													<option  value='1908'>1908</option> 
													<option  value='1907'>1907</option> 
													<option  value='1906'>1906</option> 
													<option  value='1905'>1905</option> 
													<option  value='1904'>1904</option> 
													<option  value='1903'>1903</option> 
													<option  value='1902'>1902</option> 
													<option  value='1901'>1901</option> 
													<option  value='1900'>1900</option> 
                										</select></li>
								<li><label>Sexo</label><INPUT type='radio' name='sexo' value='M' onclick='marcas=true'> Masculino 
<INPUT type='radio' name='sexo' value='F' onclick='marcas=true'> Femenino</li>
							</ol>
						<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Registrar' /></p>
					</fieldset>
				</form>";
	}
	public function linksusuario(){
		$f=$_GET['f'];
		switch($f){
			case '':
				echo "<div id='links_modulo'><a href='main.php?m=u&f=r'>Registrar Usuarios</a> <a href='main.php?m=u&f=c'>Consultar Usuarios</a></div><br><br><br><br><br><br><br><br><br><br><br>";
			break;
			case 'r':
				echo "<form method='post' name='usuario' action='main.php?m=u&f=rd' onSubmit='return valida(this);'>
					<fieldset id='inside'>
						<legend>Registro de Datos</legend>
							<ol>
								<li><label>Tipo de Usuario</label><select name='tipo'><option selected value=''>Selecciona</option><option value='admin'>Administrador</option><option value='usuario'>Usuario</option></select></li>
								<li><label>Usuario</label><INPUT type='text' size='30' name='loginUsuario'></li>
								<li><label>Password</label><INPUT type='password' size='30' name='passUsuario'></li>
								<li><label>Cofirmar Password</label><INPUT type='password' size='30' name='cpassUsuario'  onchange='comprobarClave()'><script>if(correcto) == false){
	document.write('<b>Escribe correctamente los password</b>');
	}else{
	document.write('<b>Passwords correctas</b>');
	      	</script></li>
							</ol>
					</fieldset>
					<fieldset id='inside'>
						<legend>Datos Personales</legend>
							<ol>
								<li><label>Nombres</label><INPUT type='text' size='50' name='nombres'></li>
								<li><label>Apellidos</label><INPUT type='text' size='50' name='apellidos'></li>
								<li><label>Cedula</label><select name='nac'><option selected value=''>Selecciona</option><option value='v'>V</option><option value='e'>E</option></select><INPUT type='text' onkeyup='this.value = this.value.slice(0,8)' size='45' name='cedula'></li>
								<li><label>Direcci&oacute;n</label><INPUT type='text' size='50' maxlength='500' name='direccion'></li>
								<li><label>Telefono</label><INPUT type='text' size='50' name='telefono'></li>
								<li><label>E-Mail</label><INPUT type='text' size='50' name='email'></li>
								<li><label>Fecha de Nacimiento</label><select name='dia_nac'><option selected value=''>DIA</option> 
													<option  value='01'>1</option> 
													<option  value='02'>2</option> 
													<option  value='03'>3</option> 
													<option  value='04'>4</option> 
													<option  value='05'>5</option> 
													<option  value='06'>6</option> 
													<option  value='07'>7</option> 
													<option  value='08'>8</option> 
													<option  value='09'>9</option> 
													<option  value='10'>10</option> 
													<option  value='11'>11</option> 
													<option  value='12'>12</option> 
													<option  value='13'>13</option> 
													<option  value='14'>14</option> 
													<option  value='15'>15</option> 
													<option  value='16'>16</option> 
													<option  value='17'>17</option> 
													<option  value='18'>18</option> 
													<option  value='19'>19</option> 
													<option  value='20'>20</option> 
													<option  value='21'>21</option> 
													<option  value='22'>22</option> 
													<option  value='23'>23</option> 
													<option  value='24'>24</option> 
													<option  value='25'>25</option> 
													<option  value='26'>26</option> 
													<option  value='27'>27</option> 
													<option  value='28'>28</option> 
													<option  value='29'>29</option> 
													<option  value='30'>30</option> 
													<option  value='31'>31</option> 
												</select> 
												<select name='mes_nac'> 
                       			 								<option selected value=''>MES</option> 
                       						 					<option  value='01'>1</option> 
													<option  value='02'>2</option> 
													<option  value='03'>3</option> 
													<option  value='04'>4</option> 
													<option  value='05'>5</option> 
													<option  value='06'>6</option> 
													<option  value='07'>7</option> 
													<option  value='08'>8</option> 
													<option  value='09'>9</option> 
													<option  value='10'>10</option> 
													<option  value='11'>11</option> 
													<option  value='12'>12</option> 
             	  	 									</select> 
												<select name='year_nac'> 
                       											<option selected value=''>A&Ntilde;O</option> 
                       											<option  value='2005'>2005</option> 
													<option  value='2004'>2004</option> 
													<option  value='2003'>2003</option> 
													<option  value='2002'>2002</option> 
													<option  value='2001'>2001</option> 
													<option  value='2000'>2000</option> 
													<option  value='1999'>1999</option> 
													<option  value='1998'>1998</option> 
													<option  value='1997'>1997</option> 
													<option  value='1996'>1996</option> 
													<option  value='1995'>1995</option> 
													<option  value='1994'>1994</option> 
													<option  value='1993'>1993</option> 
													<option  value='1992'>1992</option> 
													<option  value='1991'>1991</option> 
													<option  value='1990'>1990</option> 
													<option  value='1989'>1989</option> 
													<option  value='1988'>1988</option> 
													<option  value='1987'>1987</option> 
													<option  value='1986'>1986</option> 
													<option  value='1985'>1985</option> 
													<option  value='1984'>1984</option> 
													<option  value='1983'>1983</option> 
													<option  value='1982'>1982</option> 
													<option  value='1981'>1981</option> 
													<option  value='1980'>1980</option> 
													<option  value='1979'>1979</option> 
													<option  value='1978'>1978</option> 
													<option  value='1977'>1977</option> 
													<option  value='1976'>1976</option> 
													<option  value='1975'>1975</option> 
													<option  value='1974'>1974</option> 
													<option  value='1973'>1973</option> 
													<option  value='1972'>1972</option> 
													<option  value='1971'>1971</option> 
													<option  value='1970'>1970</option> 
													<option  value='1969'>1969</option> 
													<option  value='1968'>1968</option> 
													<option  value='1967'>1967</option> 
													<option  value='1966'>1966</option> 
													<option  value='1965'>1965</option> 
													<option  value='1964'>1964</option> 
													<option  value='1963'>1963</option> 
													<option  value='1962'>1962</option> 
													<option  value='1961'>1961</option> 
													<option  value='1960'>1960</option> 
													<option  value='1959'>1959</option> 
													<option  value='1958'>1958</option> 
													<option  value='1957'>1957</option> 
													<option  value='1956'>1956</option> 
													<option  value='1955'>1955</option> 
													<option  value='1954'>1954</option> 
													<option  value='1953'>1953</option> 
													<option  value='1952'>1952</option> 
													<option  value='1951'>1951</option> 
													<option  value='1950'>1950</option> 
													<option  value='1949'>1949</option> 
													<option  value='1948'>1948</option> 
													<option  value='1947'>1947</option> 
													<option  value='1946'>1946</option> 
													<option  value='1945'>1945</option> 
													<option  value='1944'>1944</option>
													<option  value='1943'>1943</option> 
													<option  value='1942'>1942</option> 
													<option  value='1941'>1941</option> 
													<option  value='1940'>1940</option> 
													<option  value='1939'>1939</option> 
													<option  value='1938'>1938</option> 
													<option  value='1937'>1937</option> 
													<option  value='1936'>1936</option> 
													<option  value='1935'>1935</option> 
													<option  value='1934'>1934</option> 
													<option  value='1933'>1933</option> 
													<option  value='1932'>1932</option> 
													<option  value='1931'>1931</option> 
													<option  value='1930'>1930</option> 
													<option  value='1929'>1929</option> 
													<option  value='1928'>1928</option> 
													<option  value='1927'>1927</option> 
													<option  value='1926'>1926</option> 
													<option  value='1925'>1925</option> 
													<option  value='1924'>1924</option> 
													<option  value='1923'>1923</option> 
													<option  value='1922'>1922</option> 
													<option  value='1921'>1921</option> 
													<option  value='1920'>1920</option> 
													<option  value='1919'>1919</option> 
													<option  value='1918'>1918</option> 
													<option  value='1917'>1917</option> 
													<option  value='1916'>1916</option> 
													<option  value='1915'>1915</option> 
													<option  value='1914'>1914</option> 
													<option  value='1913'>1913</option> 
													<option  value='1912'>1912</option> 
													<option  value='1911'>1911</option> 
													<option  value='1910'>1910</option> 
													<option  value='1909'>1909</option> 
													<option  value='1908'>1908</option> 
													<option  value='1907'>1907</option> 
													<option  value='1906'>1906</option> 
													<option  value='1905'>1905</option> 
													<option  value='1904'>1904</option> 
													<option  value='1903'>1903</option> 
													<option  value='1902'>1902</option> 
													<option  value='1901'>1901</option> 
													<option  value='1900'>1900</option> 
                										</select></li>
								<li><label>Sexo</label><INPUT type='radio' name='sexo' value='M' onclick='marcas=true'> Masculino 
<INPUT type='radio' name='sexo' value='F' onclick='marcas=true'> Femenino</li>
							</ol>
						<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Registrar' /></p>
					</fieldset>
				</form>";
			break;
			case 'rd':
				$tipo=$_POST['tipo'];
				switch($tipo){
					case 'admin':
					$this->registrara();
					break; 
					case 'usuario':
					$this->registrarud();
					break;
				}
			break;
			case 'c':
			echo "<div>
			<form method='post' name='usuario' action='main.php?m=u&f=cd' onSubmit='return valida(this);'>
			<fieldset id='inside'>
			<legend>Consultar Usuarios</legend>
			<ol>
			<li><label>Cedula</label><INPUT type='text' size='50' name='cedula'></li>
			</ol>
			<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Buscar' /></p>
			</fieldset>
			</form>
			</div>";
			break;
			case 'cd':
				$this->buscar();
			break;
		}
	}
		
	public function buscarautedit(){
		$this->consulta1=(mysql_query("SELECT login, fecha FROM usuario WHERE cedula=(SELECT cedula from usuario where login='$this->autloginUsuario');"));
		$this->consulta2=(mysql_query("SELECT * FROM datos WHERE cedula=(SELECT cedula from usuario where login='$this->autloginUsuario');"));
		if(mysql_num_rows($this->consulta1)>0){
	       		$this->registro=(mysql_fetch_array($this->consulta1));
        		$this->loginUsuario=($this->registro[0]);
        		$this->fecha=($this->registro[1]);
        		$this->registro2=(mysql_fetch_array($this->consulta2));
        		$this->nombres=($this->registro2[1]);
			$this->apellidos=($this->registro2[2]);
			$this->nac=($this->registro2[3]);
			$this->cedula=($this->registro2[4]);
			$this->direccion=($this->registro2[5]);
			$this->telefono=($this->registro2[6]);
			$this->email=($this->registro2[7]);
			$this->fecha_nac=($this->registro2[8]);
			$this->sexo=($this->registro2[9]);
        	}else{
        		$this->nombres='NO ENCONTRADO';
        	}

		echo "<form>";
		echo "<fieldset id='inside'>";
		echo "<legend>";
		echo $this->loginUsuario;
		echo "</legend>";
		echo "<ol>";
		echo "<li>";
		echo "Fecha de Inscripci&oacute;n: ".$this->fecha;
		echo "</li>";
		echo "<li>";
		echo "Nombres: ".$this->nombres;
		echo "<BUTTON value='editar'></BUTTON></li>";
		echo "<li>";
		echo "Apellidos: ".$this->apellidos;
		echo "</li>";
		echo "<li>";
		echo "Cedula: ".$this->nac.$this->cedula;
		echo "</li>";
		echo "<li>";
		echo "Direcci&oacute;n: ".$this->direccion;
		echo "</li>";
		echo "<li>";
		echo "Tel&eacute;fono: ".$this->telefono;
		echo "</li>";
		echo "<li>";
		echo "Email: ".$this->email;
		echo "</li>";
		echo "<li>";
		echo "Fecha de nacimiento: ".$this->fecha_nac;
		echo "</li>";
		echo "<li>";
		echo "Sexo: ";
		if($this->sexo==M){
		echo "Masculino";
		}else{
		echo "Femenino";
		}
		echo "</li>";
		echo "</ol>";
		echo "</fieldset>";
		echo "</form>";
	}
}
?>