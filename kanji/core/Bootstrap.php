<?php

abstract class Bootstrap {
	// Properties
	////////////////////////////////////////////////////////////////
	protected $dataArray = array ();
	protected $viewPath;
	protected $viewPathPrefix;
	protected $modulePathPrefix = "kanji/modules/";
	protected $logPathPrefix = "kanji/logs/";
	protected $kanjiPathPrefix = "kanji/library/";

	// Methods
	///////////////////////////////////////////////////////////////
	abstract protected function renderJSON ();

	abstract protected function renderView ();

	public function __construct ()
	{

	}



// end constructor

	protected function setData ($keyName, $dataObject)
	{
		if (is_string ($keyName))
		{

			$this -> dataArray[$keyName] = $dataObject;
			return $this;
		}
		else
		{

			return false;
		}

	}



// end setData ------------------------------------------------------------------------- end setData

	protected function setViewPath ($path)
	{
		if (file_exists ($path))
		{

			$this -> viewPath = $path;
			return $this;
		}
		else
		{

			return false;
		}

	}



// end setViewPath ------------------------------------------------------------------- end setViewPath

	public function getView ()
	{
		return $this -> viewPath;

	}



// end getView -------------------------------------------------------------------------- end getView

	protected function getData ($keyName = false)
	{
		// if keyName is set, and it exists in dataArray
		if ($keyName && isset ($keyName) && array_key_exists ($keyName, $this -> dataArray))
		{
			// return element
			return $this -> dataArray[$keyName];
		}
		else if ($keyName && isset ($keyName) && !array_key_exists ($keyName, $this -> dataArray))
		{

			// keyName doesn't exist in array
			return false;
		}
		else
		{

			return $this -> dataArray;
		}

	}



// end getData --------------------------------------------------------------------- end getData

	protected function loadClass ($classPath, $className, $arguments = null)
	{
		ClassLoader::setClassPath ($classPath);
		return ClassLoader::loadClassByName ($className, $arguments);

	}



// end loadClass ------------------------------------------------------------------- end loadClass

	protected function loadKanji ($className, $arguments = null)
	{
		$segments = explode ("_", $className);
		return $this -> loadClass ($this -> kanjiPathPrefix . lcfirst ($segments[0]) . "/", $className, $arguments);

	}



// end loadKanji ------------------------------------------------------------------ end loadKanji
}

// end class

/* end file
*/