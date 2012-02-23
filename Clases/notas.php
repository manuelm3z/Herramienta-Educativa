<?php
	class notas{
		private $consulta1;
		private $consulta2;
		private $consulta3;
		public $resultado;
		public $id;
		
		public function buscar(){
			$loginUsuario=$_POST['loginUsuario'];
			$this->consulta1=(mysql_query("SELECT idEvaluacion, nota FROM notas where id_usuario=(SELECT id_usuario FROM usuario where login='$loginUsuario');"));
			if(mysql_num_rows($this->consulta1)>0){
        		echo "<fieldset id='inside'>";
				echo "<legend>Notas</legend>";
				echo "<ol>";
		while ($this->resultado=(mysql_fetch_array($this->consulta1))) {
				$this->id=($this->resultado['idEvaluacion']);
				$this->consulta2=(mysql_query("SELECT numeroModulo FROM modulo where IdModulo=(SELECT idModulo FROM evaluacion where idEvaluacion=$this->id);"));
				$this->resultado2=(mysql_fetch_array($this->consulta2));
				$this->numero=($this->resultado2['numeroModulo']);
				$this->nota=($this->resultado['nota']);
  				printf("<li>Modulo: %s Nota: %s </li>", $this->numero, $this->nota);  
				}
				$this->consulta3=(mysql_query("SELECT avg(nota) FROM notas where id_usuario=(SELECT id_usuario FROM usuario where login='$loginUsuario');"));
				$this->resultado3=(mysql_fetch_array($this->consulta3));
				$this->promedio=($this->resultado3['avg(nota)']);
				if(($this->promedio)<10){
				echo "<li>Promedio: ".substr($this->promedio,-6,1)."</li>";
				echo "</ol></fieldset>";
				}else{
				echo "<li>Promedio: ".substr($this->promedio,-6,2)."</li>";
				echo "</ol></fieldset>";
				}
        	}else{
			echo "<form>";
			echo "<fieldset id='inside'>";
			echo "<legend>";
			echo "Notas";
			echo "</legend>";
			echo "<ol>";
			echo "<li>";
        		echo "No tiene resultados";
			echo "</li>";
			echo "</ol>";
			echo "</fieldset>";
			echo "</form>";
        	}
		}
		
		public function formNotas(){
			$f=$_GET['f'];
			switch($f){
					case '':
						echo "<div>";
						echo "<form method='post' name='usuario' action='main.php?m=n&f=cd'>";
						echo "<fieldset id='inside'>";
						echo "<legend>Consultas de Notas</legend>";
						echo "<ol>";
						echo "<li><label>Login</label><INPUT type='text' size='50' name='loginUsuario'></li>";
						echo "</ol>";
						echo "<p align='center'><input type='submit' name='cmdAccion' class='btn' value='Buscar' /></p>";
						echo "</fieldset>";
						echo "</form>";
						echo "</div>";
					break; 
					case 'cd':
						$this->buscar();
					break;
				}
			
		}

		public function corregir(){
		$nm=$_GET['nm'];
		$autloginUsuario=($_SESSION['loginUsuario']);
		$respuesta=$_POST['respuesta'];
		$this->consulta1=(mysql_query("insert into notas values(0, (SELECT valor FROM respuesta where respuesta='$respuesta'), curdate(), 'cerrada', (SELECT id_usuario FROM usuario where login='$autloginUsuario'), (SELECT idRespuesta FROM respuesta where respuesta='$respuesta'), (SELECT idEvaluacion FROM evaluacion where idModulo=(SELECT idModulo FROM modulo where numeroModulo=$nm)));"));
		}

		public function buscaraut(){
		$autloginUsuario=($_SESSION['loginUsuario']);
		$this->consulta1=(mysql_query("SELECT idEvaluacion, nota FROM notas where id_usuario=(SELECT id_usuario FROM usuario where login='$autloginUsuario');"));
		if(mysql_num_rows($this->consulta1)>0){
		echo "<fieldset id='inside'>";
				echo "<legend>Notas</legend>";
				echo "<ol>";
		while ($this->resultado=(mysql_fetch_array($this->consulta1))) {
				$this->id=($this->resultado['idEvaluacion']);
				$this->consulta2=(mysql_query("SELECT numeroModulo FROM modulo where IdModulo=(SELECT idModulo FROM evaluacion where idEvaluacion=$this->id);"));
				$this->resultado2=(mysql_fetch_array($this->consulta2));
				$this->numero=($this->resultado2['numeroModulo']);
				$this->nota=($this->resultado['nota']);
  				printf("<li>Modulo: %s Nota: %s </li>", $this->numero, $this->nota);  
				}
				$this->consulta3=(mysql_query("SELECT avg(nota) FROM notas where id_usuario=(SELECT id_usuario FROM usuario where login='$autloginUsuario');"));
				$this->resultado3=(mysql_fetch_array($this->consulta3));
				$this->promedio=($this->resultado3['avg(nota)']);
				if(($this->promedio)<10){
				echo "<li>Promedio:</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG src='../Archivos/Numeros/".substr($this->promedio,-6,1).".gif' width='50' height='50' border='0'></li>";
				echo "</ol></fieldset>";
				}else{
				echo "<li>Promedio:</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG src='../Archivos/Numeros/".substr($this->promedio,-6,2).".gif' width='50' height='50' border='0'></li>";
				echo "</ol></fieldset>";
				}
				}else{
				echo "<form>";
			echo "<fieldset id='inside'>";
			echo "<legend>";
			echo "Notas";
			echo "</legend>";
			echo "<ol>";
			echo "<li>";
        		echo "No tiene resultados";
			echo "</li>";
			echo "</ol>";
			echo "</fieldset>";
			echo "</form>";
			}
		}
}
?>
