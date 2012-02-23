<?php
	class modulo{
		public $idModulo;
		public $numeroModulo;
		public $nombreModulo;
		public $contenidoModulo;
		public $imagen;
		public $fecha;
		public $ultimaModificacion;
		public $tipo;
		private $consultam;
		private $consultaim;
		private $consulta;
		
		
		public function __construct(){
			$this->numeroModulo=($_POST['numeroModulo']);
			$this->nombreModulo=($_POST['nombreModulo']);
			$this->contenidoModulo=($_POST['contenidoModulo']);
			$this->imagen=(mysql_escape_string(join(@file($_FILES['imagenModulo']['tmp_name']))));
			$this->tipo=($_FILES['imagenModulo']['type']);
			}
	
		public function agregarModulo(){
			if (is_uploaded_file($_FILES['imagenModulo']['tmp_name']) === TRUE){
				$this->consultam=(mysql_query("SELECT * FROM modulo where numeroModulo='$this->numeroModulo';"));
				if(mysql_num_rows($this->consultam)>0){
					echo "Modulo ya existe!!!, modificar el existente o crear otro nuevo<br><br>";
					$this->formModulo();
				}else{
				$this->consultaim=(mysql_query("insert into modulo values(0, '$this->numeroModulo', '$this->nombreModulo', '$this->contenidoModulo', '$this->imagen', '$this->tipo', curdate(), curdate());"));
				}
			}
		}

		public function buscarModulo(){
			$this->consulta=(mysql_query("select idModulo, numeroModulo, nombreModulo, contenidoModulo, tipo, fecha, ultimaModificacion from modulo where numeroModulo='$this->numeroModulo';"));
			if(mysql_num_rows($this->consulta)>0){
        			$this->registro=(mysql_fetch_array($this->consulta));
        			$this->idModulo=($this->registro[0]);
        			$this->numeroModulo=($this->registro[1]);
				$this->nombreModulo=($this->registro[2]);
				$this->contenidoModulo=($this->registro[3]);
				$this->tipo=($this->registro[4]);
				$this->fecha=($this->registro[5]);
				$this->ultimaModificacion=($this->registro[6]);
				$this->formModulo();
        		}else{
        			echo "Modulo no encontrado<br><br>";
				$this->formModulo();
        		}
		}
		
		public function modificarModulo(){
			if (is_uploaded_file($_FILES['imagenModulo']['tmp_name']) === TRUE){
				$this->consultam=(mysql_query("update modulo set nombreModulo='$this->nombreModulo', contenidoModulo='$this->contenidoModulo', imagen='$this->imagen', ultimaModificacion=curdate() where numeroModulo='$this->numeroModulo';"));
			}else{
				$this->consultam=(mysql_query("update modulo set nombreModulo='$this->nombreModulo', contenidoModulo='$this->contenidoModulo', ultimaModificacion=curdate() where numeroModulo='$this->numeroModulo';"));
				}
			}
	
		public function eliminarModulo(){
			$this->consulta=(mysql_query("delete from modulo where numeroModulo='$this->numeroModulo';"));
			echo "Modulo Eliminado<br>";
			$this->formModulo();
		}
		
		public function formModulo(){
?>
			<script language='JavaScript'>
				function Abrir_ventana (pagina) {
				var opciones='toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=85, left=140';
				window.open(pagina,'',opciones);
				}
			</script><div>
			<form enctype='multipart/form-data' method='post' action='main.php?m=m' onSubmit='return valida(this);'>
			<fieldset id='inside'>
			<legend>Registro de Modulos</legend>
			<ol>
			<li><label>ID</label><? echo $this->idModulo; ?></li><br><br>
			<li><label>Numero</label><INPUT type='text' size='30' name='numeroModulo' value='<? echo $this->numeroModulo; ?>'></li>
			<li><label>Titulo</label><INPUT type='text' size='50' name='nombreModulo' value='<? echo $this->nombreModulo; ?>'></li>
			<li><label>Contenido</label><TEXTAREA COLS='57' ROWS='10' name='contenidoModulo'><? echo $this->contenidoModulo; ?></TEXTAREA></li>
			<li><label>Imagen</label><INPUT type='file' size='50' name='imagenModulo'>
			<li><label>Fecha de Registro: </label><? echo $this->fecha; ?></li><br><br><br>
			<li><label>Ultima Modificaci&oacute;n </label><? echo $this->ultimaModificacion; ?></li>
			</ol>
			<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Agregar' /> <input type='submit' name='cmdAccion' class='btn' value='Buscar' /> <input type='submit' name='cmdAccion' class='btn' value='Modificar' /> <input type='submit' name='cmdAccion' class='btn' value='Eliminar' /> <INPUT type="button" class="btn" value="Vista Previa"  onclick='javascript:Abrir_ventana("vp.php?nm=<? echo $this->numeroModulo; ?>")'></p>
			</fieldset>
			</form>
			</div>
<?
		}

		public function imagen(){
			$nm=$_GET['nm'];
			$this->consulta=(mysql_query("select imagen, tipo from modulo where numeroModulo='$nm';"));
			if(mysql_num_rows($this->consulta)>0){
        			$this->registro=(mysql_fetch_array($this->consulta));
				$this->imagen=($this->registro[0]);
				$this->tipo=($this->registro[1]);
        		}else{
        			echo "<h1>Imagen no Encontrada</h1><br><br><br><br><br><br><br><br><br><br>";
        		}
		}

		public function vistaPrevia(){
			$nm=$_GET['nm'];
			$this->consulta=(mysql_query("select idModulo, numeroModulo, nombreModulo, contenidoModulo, imagen, tipo from modulo where numeroModulo='$nm';"));
			if(mysql_num_rows($this->consulta)>0){
        			$this->registro=(mysql_fetch_array($this->consulta));
        			$this->idModulo=($this->registro[0]);
        			$this->numeroModulo=($this->registro[1]);
				$this->nombreModulo=($this->registro[2]);
				$this->contenidoModulo=($this->registro[3]);
				$this->imagen=($this->registro[4]);
				$this->tipo=($this->registro[5]);
        		}else{
        			echo "Modulo no encontrado<br><br><br><br><br><br><br><br><br><br>";
        		}
			
		}

		public function mainModulo(){
			$cmdAccion=$_POST['cmdAccion'];
			switch($cmdAccion){
					case '':
						$this->formModulo();
					break; 
					case 'Agregar':
						$this->agregarModulo();
						$this->buscarModulo();
					break;
					case 'Buscar':
						$this->buscarModulo();
					break;
					case 'Modificar':
						$this->modificarModulo();
						$this->buscarModulo();
					break;
					case 'Eliminar':
						$this->eliminarModulo();
					break;
				}
		}
		
		public function mainModulou(){
		
		$this->consulta=(mysql_query("select numeroModulo from modulo;"));
		if(mysql_num_rows($this->consulta)>0){
			$this->registro=(mysql_fetch_row($this->consulta));
			$r=0;
			while($r<mysql_num_rows($this->consulta)){
			$r=$r+1;
			echo "<A href='main.php?m=m&nm=".$r."'>Modulo ".$r. "</A><BR>";
			
   				}
			}
        	}
public function espacio(){
		
		$this->consulta=(mysql_query("select numeroModulo from modulo;"));
		if(mysql_num_rows($this->consulta)>0){
			$this->registro=(mysql_fetch_row($this->consulta));
			$r=0;
			while($r<mysql_num_rows($this->consulta)){
			$r=$r+1;
			echo "<BR>";
			
   				}
			}
        	}	

		public function mainModulouC(){
			$nm=$_GET['nm'];
			if($nm!=''){
			$this->vistaPrevia();
			echo "
			<div><h1>Modulo $this->numeroModulo</h1></div>
		      	<div><h1>$this->nombreModulo</h1></div>
			<div><IMG src='imagen.php?nm=$this->numeroModulo' align='left' border='0' width='500px'></div>
			<p align='justify'> $this->contenidoModulo</p>
    			";
			}else{
			echo "Seleccionar unos de los modulos";
			$this->espacio();
			}
		
		}	
}
?>