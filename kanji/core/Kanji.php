<?php

require_once("kanji/core/Bootstrap.php");

abstract class Kanji extends Bootstrap {

	// Properties
	////////////////////////////////////////////////////////////////

	protected $viewPathPrefix = "kanji/views/";

	// Methods
	///////////////////////////////////////////////////////////////

	abstract public function init ();

	public function __construct ($uri_path)
	{

		parent::__construct ();

		$this->setData("kanji_path", $uri_path);
		$this -> setViewPath ($this -> viewPathPrefix . lcfirst (get_class ($this)) . "View.php");
	}

// end constructor


	protected function render ()
	{

		$request = $_SERVER['HTTP_X_REQUESTED_WITH'];

		if(is_string($request) || strtolower($request) == 'xmlhttprequest'){

			$this->renderJSON();
		} else {

			$this->renderView();
		}
	}

// end render ---------------------------------------------------------------------- end render

	protected function renderView ()
	{

		if (file_exists ($this -> viewPath))
		{

			// parse variables from array
			extract ($this -> dataArray);

			// variables then get included in view
			require_once ($this -> viewPath);
		}
		else
		{

			die ("ERROR :: " . get_class ($this) . " :: requested view does not exist or is invalid");
		}
	}

// end renderView ----------------------------------------------------------------- end renderView

	protected function renderJSON ($callback = null)
	{

		$dataIsArray = is_array($this->dataArray);

		// callback only allows for letters (any case), numbers, and/or underscores
		$callbackIsValid = is_string($callback) ?  preg_match('/^[a-zA-Z0-9_]*$/', $callback) : false;

		if ($dataIsArray && $callbackIsValid)
		{

			$jsn = json_encode ($this -> getData());

			$this -> setHTTPHeader('JAVASCRIPT');
			echo $callback."($jsn);";
		}
		else if ($dataIsArray)
		{

			$this -> setHTTPHeader ('JSON');
			echo json_encode ($this -> getData ());

		}
		else
		{

			return false;
		}
	}

// end renderJSON ----------------------------------------------------------------- end renderJSON

	protected function loadModule ($moduleName, $dataArray = null)
	{

		return $this -> loadClass ($this -> modulePathPrefix . lcfirst ($moduleName) . "/", ucfirst ($moduleName) . "Module", $dataArray) -> init ();
	}

// end loadModule ----------------------------------------------------------------- end loadModule

	protected function setHTTPHeader ($stringType)
	{

		switch ($stringType)
		{
			case 'JSON':

				header ('Content-Type: application/json');
				break;

			case 'JAVASCRIPT':

				header ('Content-Type: application/javascript');
				break;

			case 'PDF':

				header ('Content-Type: application/pdf');
				break;


			case 'ZIP':

				header ('Content-Type: application/zip');
				break;

			case 'RSS':

				header ('Content-Type: application/rss');
				break;

			case 'XML':

				header ('Content-Type: application/xml');
				break;

			default:

				return false;
				break;
		}
	}

// end setHTTPHeader -------------------------------------------------------------- end setHTTPHeader
}

// end class

/* end file
*/