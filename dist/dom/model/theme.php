<?php 

ralf::import("dom.html");

/**
* 
*/
class themeProyectHTML
{
	
	private $_PATH_THEME = NULL;
	private $_dom_html = NULL;
	private $_PATH_NAME_THEME = NULL;

	function __construct()
	{

	}

	/**
	* Cargar el dom del thema en el objeto
	*/
	public function loadDom()
	{
		$this->_dom_html = file_get_html($this->_PATH_THEME);
	}

	/**
	* Completa los path (src, href) de los elementos incertos dentro del tema plantilla, da solucion a que no se vean las imagenes por estar usando una ruta distinta
	*/
	public function solutionPathComplement()
	{
		foreach ($this->_dom_html->find("link") as $key => $value) {
			if (isset($value->href)) {
				$preRel = $this->_PATH_NAME_THEME . '/' . $value->href;

				if (file_exists($preRel)) {
					$value->href = $this->_PATH_NAME_THEME . '/' . $value->href;
				}
			}
		}

		foreach ($this->_dom_html->find("script") as $key => $value) {
			if (isset($value->src)) {
				$preRel = $this->_PATH_NAME_THEME . '/' . $value->src;

				if (file_exists($preRel)) {
					$value->src = $this->_PATH_NAME_THEME . '/' . $value->src;
				}
			}
		}

		foreach ($this->_dom_html->find("img") as $key => $value) {
			if (isset($value->src)) {
				$preRel = $this->_PATH_NAME_THEME . '/' . $value->src;

				if (file_exists($preRel)) {
					$value->src = $this->_PATH_NAME_THEME . '/' . $value->src;
				}
			}
		}
	}

	/**
	*Define la ruta del archivo tema
	**/
	public function setPathTheme($path)
	{
		$this->_PATH_THEME = $path;
		$this->_PATH_NAME_THEME = dirname($path);
		$this->loadDom();
		$this->solutionPathComplement();
	}

	/*
	* imprime el codigo HTML del documento Tema
	*/
	public function out()
	{
		echo $this->_dom_html;
	}
}

