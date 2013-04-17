<?php
/*
* @file db.php
* en este archivo esta la clase encargada de manejar las conexiones a base de datos y demas
*/
namespace core\db\db;

class db
{
	private $server;
	private $user;
	private $password;

	//Para configurar el servidor de base de datos
	public function setServer($server=null)
	{
		if(!is_null($server))
		{
			$this->server = $server;
		}
	}
	//Metodo para obtener el nombre del servidor de base de datos
	public function getServer()
	{
		if(isset($this->server))
		{
			return $this->server;
		}
		else
		{
			return "Servidor no configurado";
		}
	}
	//metodo para configurar el usuario del servidor
	public function setUser($user)
	{
		if(!is_null($user))
		{
			$this->user = $user;
		}
	}
	//metodo para configurar el password para conexion de base de datos
	public function setPass($pass)
	{
		if(!is_null($pass))
		{
			$this->password = $pass;
		}
	}
}
?>