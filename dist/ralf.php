<?php 
/**
 * Website: https://github.com/alfa30/ralf-framework-php
 *
 * Ralf is a framework that facilitates the creation of software in php 
 * by administration of free modules that facilitate the construction of
 * an application. Ralf allows incorporation of external modules and 
 * incorporates their own modules that facilitate the construction of 
 * any application designed for web.
 * 
 * @author Jonathan Delgado Zamorano <jonad.correo@gmail.com>
 * @version 0.23.5
 * @package ralf
 */
if (class_exists("ralf") != true) {
	class ralf
	{
		protected static $listImport = [];
		protected $_pathFile = null;
		function __construct() {
			$this->_pathFile = dirname(__FILE__);
		}
		public final static function version(){
			return "0.23.5";
		}
		public static function import($rute)
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