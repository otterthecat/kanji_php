<?php

class URIController {

	// Properties
	////////////////////////////////////////////////////////////////
	public $nameOfClass = null;
	public $nameOfMethod = null;
	public $argArray = null;

	private $uriArray = array();
	private $uriIgnore = null;


	// Methods
	///////////////////////////////////////////////////////////////
	
	public function __construct($directory=null)
	{
	
		$uri = $_SERVER['REQUEST_URI'];
		
		$this -> setUriIgnore ($directory);
		$uri = substr ($uri, strlen ($this -> getUriIgnore ()));
		
		// get first & last positions of "/" in uri
		// so we can make things a bit cleaner before we
		// explode the uri into an array
		$firstSlash = stripos($uri, "/");
		$lastSlash = strrpos($uri, "/");
		
		
		// if the last slash is at the end of the string...
		if ($lastSlash == (strlen ($uri) - 1))
		{
		
			$uri = substr ($uri, 0, -1);
		}

		// if the first slash is at the start of the string...
		if ($firstSlash == 0)
		{
			$uri = substr ($uri, 1);
		}
		
		// if after all the above prep, we still have a useable uri,
		// parse it for names of class, methods, and any arguments
		if ($uri)
		{
		
			$this -> uriArray = explode ("/", $uri);
		
			$this -> nameOfClass = isset ($this -> uriArray[0]) ? ucfirst($this -> uriArray[0]) : null;
			$this -> nameOfMethod = isset ($this -> uriArray[1]) ? $this -> uriArray[1] : null;
			$this -> argArray = count ($this -> uriArray) > 2 ? array () : null;
			
			// this SHOULD only loop if the uri indicates there
			// are arguments to process - but this should probably
			// be written in a better way in the future.
			for ($i = 2; $i < count ($this->uriArray); $i++)
			{
				array_push ($this->argArray, $this->uriArray[$i]);
			}
		}
	
	} // end construct
	
	
	
	public function setUriIgnore ($path)
	{
		if (isset ($path))
		{
			$this->uriIgnore = $path;
		}
	} // end setUriIgnore ------------------------------------------------------------------- end setUriIgnore
	
	
	
	public function getUriIgnore ()
	{
	
		return $this->uriIgnore;
	} // end getUriIgnore ------------------------------------------------------------------- end getUriIgnore
	
	

	// if no argument is passed, the whole uri is send back (as array)
	// otherwise, it will look for the array element with key matching 
	// the passed index.
	public function getURISegments ($segmentIndex=false)
	{
		if (!$segmentIndex)
		{
		
			return $this->uriArray;
		}
		else if (isset ($this -> uriArray[$segmentIndex]))
		{
		
			return $this->uriArray[$segmentIndex];
		}
		else
		{
		
			return false;
		}
	} // end getURISegments --------------------------------------------------------------------------------- end getURISegments

}// end class

/* end file
*/