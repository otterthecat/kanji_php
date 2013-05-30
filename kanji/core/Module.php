<?php
require_once("kanji/core/Bootstrap.php");

abstract class Module extends Bootstrap {

	// Properties
	////////////////////////////////////////////////////////////////
	
	protected $cssPath, $javascriptPath, $argArray;


	// Methods
	///////////////////////////////////////////////////////////////
	
	// TODO - make a self-documenting method that lists all available
	// argumets that can be accepted for a module.

	abstract public function init ();
	

	public function __construct ($argArray = null)
	{
	
		// inherit error handling from parent
		parent::__construct();
		
		// set arguments - if available
		$this->setArguments($argArray);
		
		// getting base name of module by pasrsing the class name before
		// the suffix "Module" - hopefully no one breaks naming convention
		// This should probably be replaced once namepaces are implemented
		$baseName = strstr (get_class($this), "Module", true);
		
		// set default view paths for module assets. This can be reset on a per module basis
		$this -> setViewPath ($this -> modulePathPrefix.lcfirst($baseName)."/".lcfirst (get_class ($this))."View.php");
		$this -> setCSS ($this -> modulePathPrefix.lcfirst($baseName)."/".lcfirst (get_class ($this)).".css");
		$this -> setJavascript ($this -> modulePathPrefix.lcfirst($baseName)."/".lcfirst (get_class ($this)).".js");
		
		return $this;
	
	}
	
	protected function setArguments($array=null)
	{
		if(isset($array) && is_array($array))
		{
			$this->argArray = $array;
		
		}
		return $this;
	}
	
	protected function getArguments()
	{
		return $this->argArray;
		
	}
	
	protected function renderJSON ()
	{
	
		return json_decode($this -> getData());	
	}
	
	
	protected function renderView ()
	{
		// if booleans indicates module uses a JS and/or CSS file, 
		// then add it/them to dataArray just before we render the module
		if ($this -> getJavascript ())
		{
		
			$this -> setData ("moduleJsFile", $this->getJavascript ());
		}
		
		
		if ($this -> getCss ())
		{
		
			$this -> setData ("moduleCssFile", $this->getCSS ());
		}
		
		// buffer output as we get variables and populate them
		// into the module's html
		ob_start ();
		
		extract ($this -> getData());
		require ($this -> getView());
		
		$content = ob_get_contents();
		
		ob_end_clean ();
	
		// return buffered output
		return $content;
	}
	
	
	protected function setCss ($cssPath)
	{
		if (file_exists($cssPath))
		{

			$this->cssPath = $cssPath;
		}
		else
		{
			return false;
		}
	}



	protected function getCSS ()
	{
	
		return $this -> cssPath;
	}


	
	protected function setJavascript ($javascriptPath)
	{
	
		if (file_exists($javascriptPath))
		{
			$this -> javascriptPath = $javascriptPath;
		}
		else
		{
		
			return false;
		}
	}
	
	
	protected function getJavascript ()
	{
	
		return $this -> javascriptPath;
	}


}// end class

/* end file
*/