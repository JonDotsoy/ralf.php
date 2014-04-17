<?php 

ralf::import("util.config.property");

/**
 * controla y modifica archivos de configuracion ini
 * @author Jonathan Delgado Zamorano <jonad.correo@gmail.com>
 */
class fileConfig
{
	/**
	 * define la ruta del archivo
	 *
	 * @var string
	 **/
	private $___pathfile;
	/**
	 * undocumented class variable
	 *
	 * @var array
	 **/
	private $___treeConfig;
	function __construct($file = null,$type = null)
	{
		if (!is_null($file)) {
			$this->loadFile($file);
		}
	}
	public function loadFile($file)
	{
		$this->___pathfile = $file;
		if (!file_exists($this->___pathfile)) {
			throw new Exception("The file '".$this->___pathfile."' not exits.", 1);
		}
		if ($this->detectFileExtent($this->___pathfile)=="Initialization/Configuration") {
			$config = parse_ini_file($this->___pathfile,true,true);
			$config = $this->transformAtributeVarToProperty($config);
			$this->___treeConfig = $config;
			if (gettype($config) == "array") {
				foreach ($config as $key => $value) {
					$this->$key = $value;
				}
			}
		}
	}

	public function get($nameOption){
		return $this->___treeConfig[$nameOption];
	}

	private function transformAtributeVarToProperty($var){
		if (gettype($var) == "array") {
			$ret = array();
			foreach ($var as $key => $value) {
				if (gettype($value) == "array") {
					$ret[$key] = $this->transformAtributeVarToProperty($value);
				} else {
					$ret[$key] = new property($key,$value);
				}
			}
			return $ret;
		}
	}
	/**
	 * detecta la excion del archivo
	 *
	 * @return string
	 **/
	private function detectFileExtent($nameFile)
	{
		$forms = explode(".", $nameFile);
		$extent = $forms[count($forms)-1];
		$extent = strtolower($extent);
		$typeFile = null;
		switch ($extent) {
			case 'ini':
				$typeFile = "Initialization/Configuration";
				break;
		}
		if (is_null($typeFile)) {
			throw new Exception("Error could not detect the file type", 1);
		}
		return $typeFile;
	}
}