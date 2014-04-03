<?php
/**
 * @package manager
 * @author jonathan Delgado Zamorano <jonad.correo@gmail.com>
 **/
class option
{
	/**
	 * Expresa el tipo de archivo.
	 *
	 * @var string
	 **/
	private $_typefile;

	/**
	 * tipos permitidos para archivo
	 *
	 * @var array
	 **/
	protected $_types_file = array(
		"JSON",
		"INI"
	);

	/**
	 * undocumented class variable
	 *
	 * @var array
	 **/
	private $_DATA;

	function __construct($strconfig=null,$typefile=null) {
		if ($strconfig != null && $typefile != null) {
			$this->setFileOption($strconfig,$typefile);
		}
	}

	/**
	 * undocumented function, Realiza la busqueda en el primer y segundo nivel de la escala de configuraciones
	 *
	 * @return void
	 **/
	function findOptionConfigPredefin($data,$type = "undefined")
	{
		foreach ($data as $key => $value) {
			if (gettype($value) == "array" && !strpos(strtolower($key), strtolower("SQL"))) {
				$this->findOptionConfigPredefin($value, "SQL");
			} else {
				if ($type = "SQL") {
					if (in_array(strtolower($key),
						array(
							"username",
							"password",
							"host",
							"database"
							))) {
						$this->$key = $value;
						if (strtolower($key) != $key) {
							$key = strtolower($key);
							$this->$key = $value;
						}
					}
				}
			}
		}
	}

	/**
	 * Define el archivo de configuracion
	 *
	 * @return void
	 **/
	function setFileOption($strconfig, $typefile)
	{
		$typefile = strtoupper($typefile);
		$strconfigtype = null;
		$type = $typefile;
		if (!in_array($typefile, $this->_types_file)){
			throw new Exception("This MIME do not is supported", 1);
		}
		if (gettype($strconfig) != "string") {
			throw new Exception("The context must be a String text", 1);
		}
		if ($type == "JSON") {
			$this->_DATA = json_decode($strconfig);
		} else if ($type == "INI"){
			$this->_DATA = parse_ini_string($strconfig,true);
		}
		foreach ($this->_DATA as $key => $value) {
			$key = str_replace(" ", "_", $key);
			$this->$key = $value;
		}
		$this->findOptionConfigPredefin($this->_DATA);
	}
} // END class 