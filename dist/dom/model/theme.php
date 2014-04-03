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

	public function __toString()
	{
		return $this->_dom_html->outertext;
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

	/**
	 * Buesca el elemento en cuention.
	 * @return void
	 **/
	public function getElement($math)
	{
		$find = $this->_dom_html->find($math);
		if (count($find)==1) {
			$find = $find[0];
		}
		return $find;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @param title String
	 **/
	public function changeTitle($title)
	{
		$this->_dom_html->find("head",0)->find("title",0)->innertext = $title;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @param elem simple_html_dom_node
	 **/
	static public function cloneObejtDom($elem)
	{

		if (gettype($elem)=="object") {
			if (get_class($elem)=="simple_html_dom_node") {
				$dom = str_get_html($elem->outertext);
				return $dom;
			}
			if (get_class($elem)=="themeProyectHTML") {
				$dom = str_get_html($elem->__toString());
				return $dom;
			}
		}
	}

	/**
	 * 
	 * 
	 */
	public static function removeObjectDom($elem)
	{
		if (gettype($elem)=="object") {
			if (get_class($elem)=="simple_html_dom_node") {
				$elem->outertext = "";
				unset($elem);
			}
		}
	}
}

