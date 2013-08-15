<?php
include('../settings.php');

class Datos{
	public $conexion;
	public $baseDatos;	
		
	public function __construct(){
		$this->conexion=(@mysql_connect(server,user,pass));
		$this->baseDatos=(@mysql_select_db(bd,$this->conexion));

		if(!$this->conexion){
		echo 'No se puede conectar al servidor';
		}elseif(!$this->baseDatos){
			echo 'No se puede conectar a la Base de Datos';
			}
	}
}
?>