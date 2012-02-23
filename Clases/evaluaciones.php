<?php
	class evaluacion{
		public $enunciado;
		public $numeroModulo;
		public $respuesta;
		public $resultado;
		public $valor;
		private $consulta;
		private $consultab;		
		
		public function __construct(){
			$this->enunciado=($_POST['enunciado']);
			$this->numeroModulo=($_POST['numeroModulo']);
			$this->respuesta=($_POST['respuesta']);
			$this->valor=($_POST['valor']);
			}

		public function formEvaluacion(){
?>
<div>
<form enctype='multipart/form-data' method='post' action='main.php?m=e' onSubmit='return valida(this);'>
<fieldset id='inside'>
	<legend>Registro de Evaluaciones</legend>
	<TABLE id="tabla1" width="700px" align="center">
	<TR>
	<TD colspan="2">Solo se permite una pregunta por m&oacute;dulo, debe ser de seleci&oacute;n simple con un minimo de dos respuestas y un m&aacute;ximo de cinco.</TD>
	</TR>
	<TR>
	<TD width="110px">Numero de Modulo</TD><TD><INPUT type='text' size='30' name='numeroModulo' value='<? echo $this->numeroModulo; ?>'></TD>
	</TR>
	<TR>
	<TD width="110px">Enunciado</TD><TD><INPUT type='text' size='50' name='enunciado' value='<? echo $this->enunciado; ?>'></TD>
	</TR>
	<TR>
	<TD width="110px">Respuesta 1</TD><TD><INPUT type='text' size='30' name='respuesta[]' value='<? echo $this->respuesta[0]; ?>'> Valor <INPUT type='text' size='2' name='valor[]' value='<? echo $this->valor[0]; ?>'></TD>
	</TR>
	<TR>
	<TD width="110px">Respuesta 2</TD><TD><INPUT type='text' size='30' name='respuesta[]' value='<? echo $this->respuesta[0]; ?>'> Valor <INPUT type='text' size='2' name='valor[]' value='<? echo $this->valor[0]; ?>'></TD>
	</TR>
	</TABLE>

<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Agregar' /> <input type='submit' name='cmdAccion' class='btn' value='Buscar' /> <input type='submit' name='cmdAccion' class='btn' value='Modificar' /> <input type='submit' name='cmdAccion' class='btn' value='Eliminar' /> <INPUT type="button" class="btn" name="nuevo" value="Nueva Respuesta" onclick="Nuevalinea();"></p>
</fieldset>
</form>
</div>
<?
		}

		public function agregarEvaluacion(){
			$this->consulta=(mysql_query("SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo';"));
			if(mysql_num_rows($this->consulta)>0){
				$this->consultab=(mysql_query("SELECT * FROM evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo');"));
				if(mysql_num_rows($this->consultab)>0){
					echo "Evaluacion ya existe!!!, modificar la existente<br><br>";
					$this->formEvaluacion();
				}else{
					/*print_r(array_count_values($this->respuesta));
					print_r(count(array_count_values($this->respuesta)));
					print_r(array_count_values($this->valor));
					print_r(count(array_count_values($this->valor)));*/
					$this->consulta=(mysql_query("insert into evaluacion values(0, '$this->enunciado',(SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo'));"));
					$i=0;
					do{
					$r=$this->respuesta[$i];
					$v=$this->valor[$i];
					$this->consultab=(mysql_query("insert into respuesta values(0, '$r', '$v', (SELECT idEvaluacion FROM evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo')));"));
					$i=$i+1;
					}while($this->respuesta[$i]!='');
					echo "Evaluacion Agregada al m&oacute;dulo";
					$this->buscarEvaluacion();
				}
			}else{
				echo "No existe el modulo al que asociar la evaluaci&oacute;n, realice primero el registro del m&oacute;dulo";
			}
		}
		
		/*public function modificarEvaluacion(){
		$this->consulta=(mysql_query("SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo';"));
			if(mysql_num_rows($this->consulta)>0){
				$this->consultab=(mysql_query("SELECT * FROM evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo');"));
				if(mysql_num_rows($this->consultab)>0){
					$this->consulta=(mysql_query("update evaluacion set enunciado='$this->enunciado' where idModulo=(SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo');"));
					$i=0;
					do{
					$r=$this->respuesta[$i];
					$v=$this->valor[$i];
					$this->consultab=(mysql_query("update respuesta set values(0, '$r', '$v', (SELECT idEvaluacion FROM evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo='$this->numeroModulo')));"));
					$i=$i+1;
					}while($this->respuesta[$i]!='');
					echo "Evaluacion Agregada al m&oacute;dulo";
					$this->buscarEvaluacion();
				}else{
					
				}
			}else{
				echo "No existe el modulo al que asociar la evaluaci&oacute;n, realice primero el registro del m&oacute;dulo";
			}
		}*/
		public function buscarEvaluacion(){
			$this->consulta=(mysql_query("select idEvaluacion, enunciado from evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$this->numeroModulo);"));
			$this->resultado=(mysql_fetch_array($this->consulta));
			$this->enunciado=($this->resultado['enunciado']);
			if(mysql_num_rows($this->consulta)>0){
				$this->consultar=(mysql_query("select respuesta, valor from respuesta where idEvaluacion=(select idEvaluacion from evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$this->numeroModulo));"));
?>
<div>
<form enctype='multipart/form-data' method='post' action='main.php?m=e' onSubmit='return valida(this);'>
<fieldset id='inside'>
	<legend>Registro de Evaluaciones</legend>
	<TABLE id="tabla1" width="700px" align="center">
	<TR>
	<TD colspan="2">Solo se permite una pregunta por m&oacute;dulo, debe ser de seleci&oacute;n simple con un minimo de dos respuestas y un m&aacute;ximo de cinco.</TD>
	</TR>
	<TR>
	<TD width="110px">Numero de Modulo</TD><TD><INPUT type='text' size='30' name='numeroModulo' value='<? echo $this->numeroModulo; ?>'></TD>
	</TR>
	<TR>
	<TD width="110px">Enunciado</TD><TD><INPUT type='text' size='50' name='enunciado' value='<? echo $this->enunciado; ?>'></TD>
	</TR>
<?
		$c=0;
	while ($this->resultado=(mysql_fetch_array($this->consultar))) {
		$c++;
		$this->respuesta=($this->resultado['respuesta']);
		$this->valor=($this->resultado['valor']);
  		printf("<TR><TD width='110px'>Respuesta $c</TD><TD><INPUT type='text' size='30' name='respuesta[]' value=' %s '> Valor <INPUT type='text' size='2' name='valor[]' value=' %s '></TD></TR>", $this->respuesta, $this->valor);  
		}
	?>
	</TABLE>

<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Agregar' /> <input type='submit' name='cmdAccion' class='btn' value='Buscar' /> <input type='submit' name='cmdAccion' class='btn' value='Modificar' /> <input type='submit' name='cmdAccion' class='btn' value='Eliminar' /> <INPUT type="button" class="btn" name="nuevo" value="Nueva Respuesta" onclick="Nuevalinea();"></p>
</fieldset>
</form>
</div>
<?	
			}else{
				echo "No se encuentra la evaluaci&oacute;n solicitada";
				$this->formEvaluacion();
			}
		}
		
		public function eliminarEvaluacion(){
			$this->consulta=(mysql_query("delete from respuesta where idEvaluacion=(select idEvaluacion from evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$this->numeroModulo));"));
			$this->consulta=(mysql_query("delete from evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$this->numeroModulo);"));
			echo "Evaluacion Eliminado<br>";
			$this->formEvaluacion();
		}

		public function buscarEvaCor(){
			$nm=$_GET['nm'];
			$autloginUsuario=($_SESSION['loginUsuario']);
			$this->consulta=(mysql_query("SELECT * FROM notas where id_usuario=(SELECT id_usuario FROM usuario where login='$autloginUsuario') and idEvaluacion=(SELECT idEvaluacion FROM evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$nm));"));
			if(mysql_num_rows($this->consulta)>0){
			echo "<h1>La evaluaci&oacute;n ya fue realizada.</h1>";
			}else{
			$nm=$_GET[nm];
			$this->consulta=(mysql_query("select idEvaluacion, enunciado from evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$nm);"));
			$this->resultado=(mysql_fetch_array($this->consulta));
			$this->enunciado=($this->resultado['enunciado']);
			echo "<HR><DIV align='center'>".$this->enunciado."</DIV>";
			if(mysql_num_rows($this->consulta)>0){
				$this->consultar=(mysql_query("select respuesta from respuesta where idEvaluacion=(select idEvaluacion from evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$nm));"));
				$c=0;
				echo "<DIV><form method='POST' action='main.php?m=m&nm=$nm'>";
				while ($this->resultado=(mysql_fetch_array($this->consultar))) {
				$c++;
				$this->respuesta=($this->resultado['respuesta']);
  				printf("<INPUT type='Radio' name='respuesta' value='%s'>%s <br>", $this->respuesta, $this->respuesta);  
				}
				echo "<center><input type='submit' name='cmdAccion' id='bot' value='Corregir' /></center></form></DIV>";
			}
		}
		}

		public function mainEvaluacion(){
			$cmdAccion=$_POST['cmdAccion'];
			switch($cmdAccion){
				case '':
					$this->formEvaluacion();
				break; 
					case 'Agregar':
					$this->agregarEvaluacion();
					break;
					case 'Buscar':
					$this->buscarEvaluacion();
					break;
					case 'Modificar':
					break;
					case 'Eliminar':
					$this->eliminarEvaluacion();
					break;
				}
		}

		public function buscar(){

		}
}
?>

