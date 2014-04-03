<?php 

/**
 * Controla la coneccion con la base de datos
 *
 * @package manager.database
 * @author Jonathan Delgado Zanorano <jonad.coreo@gmail.com>
 **/
class managerMySQL extends mysqli
{
	/**
	 * define los archivos de configuracion
	 *
	 * @return void
	 * @param config config
	 **/
	public function __construct($config = null,$username= null,$password = null,$dbname = "",$port=null,$socket =null)
	{
		if (gettype($config) == "object" && get_class($config) == "option") {
			if (isset($config->host)) {
				if (isset($config->username)) {
					if (isset($config->password)) {
						$database = "";
						if (isset($config->database)) {
							$database = $config->database;
						}
						parent::__construct($config->host,$config->username,$config->password,$database);
						return true;
					} else return false;
				}else return false;
			}else return false;
		} else {
			$host = $config;
			$host = ($host==null)?ini_get("mysqli.default_host"):$host;
			$username = ($username==null)?ini_get("mysqli.default_user"):$username;
			$password = ($password==null)?ini_get("mysqli.default_pw"):$password;
			$port = ($port==null)?ini_get("mysqli.default_port"):$port;
			$socket = ($socket==null)?ini_get("mysqli.default_socket"):$socket;
			@parent::__construct($host,$username,$password,$dbname,$port,$socket);
		}
	}
}