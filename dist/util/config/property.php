<?php 

/**
 * controla una variable tanto nombre con su valor
 *
 * @package util.config
 * @author Jonathan Delgado Zamorano <jonad.correo@gmail.com>
 **/
class property
{
	/**
	 * nobmre de la variable property
	 *
	 * @var string
	 **/
	private $name = null;
	/**
	 * valor de la variable property
	 *
	 * @var string
	 **/
	private $value = null;
	function __construct($name = null, $value = null) {
		$this->name = $name;
		$this->value = $value;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getValue()
	{
		return $this->value;
	}

	public function __toString()
	{
		return (String)($this->value);
	}
} // END class property