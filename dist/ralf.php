<?php 

if (class_exists("ralf") != true) {
	class ralf
	{
		protected static $listImport = [];
		protected $_pathFile = null;

		function __construct() {
			$this->_pathFile = dirname(__FILE__);
		}

		static function import($rute)
		{
			if (gettype($rute) == 'string') {
				if (!in_array($rute, ralf::$listImport)) {

					$pathSearch = dirname(__FILE__).'\\'.str_replace('.', '\\', $rute);
					$pathSearch .= ".php";
					
					if (file_exists($pathSearch)) {
						include $pathSearch;
					} else {
						throw new Exception("Seller does not exist");
					}

					ralf::$listImport[] = $rute;
				}
			} else {
				throw new Exception("The data type is not correct");
			}
		}
	}
}

$ralf = new ralf();
$GLOBAL["ralf"] = $ralf;