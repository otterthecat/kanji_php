<?php
require_once("kanji/core/Module.php");

class LoginModule extends Module {
	// Properties
	/////////////////////////////////////////////////////////////////////////////

	private $fieldsetId = "login";
	private $postTo = "/";
	private $username = "username";
	private $password = "password";


	// Methods
	///////////////////////////////////////////////////////////////

	public function init ()
	{
		// get args (if any) at time of module being called.
		$args = $this -> getArguments ();

		// loop through passed argument to set properties
		// prior to rendering the form
		foreach ($args as $key => $value)
		{
			switch ($key)
			{
				case "fieldsetId":
					$this -> setFieldsetId ($value);
					break;

				case "postTo":
					$this -> setPostTo ($value);
					break;

				case "username":
					$this -> setUsername ($value);
					break;

				case "password":
					$this -> setPassword ($value);
					break;
			}
		}

		$this -> setData ("fieldsetId", $this -> fieldsetId)
			-> setData ("postTo", $this -> postTo)
			-> setData ("username", $this -> username)
			-> setData ("password", $this -> password);


		return $this -> renderView ();

	}



	private function setFieldsetId ($string)
	{
		if (is_string ($string))
		{
			$this -> fieldsetId = $string;
			return true;
		}
		else
		{
			return false;
		}

	}



	private function setPostTo ($string)
	{
		if (is_string ($string))
		{
			$this -> postTo = $string;
			return true;
		}
		else
		{
			return false;
		}

	}



	private function setUsername ($string)
	{
		if (is_string ($string))
		{
			$this -> username = $string;
			return true;
		}
		else
		{
			return false;
		}

	}



	private function setPassword ($string)
	{
		if (is_string ($string))
		{
			$this -> password = $string;
			return true;
		}
		else
		{
			return false;
		}

	}



}

// end class

/* end file
*/