<?php

class ClassLoader{

	private static $path = "kanji/app/";
	private static $reflectedMethod;

	// load class by the Class's name. Typically called from modules, and used
	// by Kanji.php as well.
	public static function loadClassByName ($className, $arguments = null)
	{

		$fileExists = file_exists(self::$path.$className.".php");
		if ($fileExists)
		{
			// we know file exists so load it up (if not already)
			require_once (self::$path.$className.".php");
		}
		else
		{
			self::throw404();
		}

		// if arguments exist, pass them as you instantiate class
		// otherwise, just call it without arguments
		if ($fileExists && isset ($arguments) && is_array ($arguments))
		{

			$instance = new $className ($arguments);
		}
		else if ($fileExists)
		{

			$instance = new $className ();
		}

		return $instance;

	} // end loadClassByName ------------------------------------------------------------------- end loadClassByName


	public static function loadClassFromURI (URIController $uri)
	{
		// use instance of uri to check if we have a matching class to what's expected
		if (isset ($uri -> nameOfClass) && file_exists (self::$path.$uri -> nameOfClass.".php"))
		{
			// file exists, so load it up (if not already)
			require_once (self::$path.$uri -> nameOfClass.".php");

			// generate requested class instance
			$instance = new $uri -> nameOfClass ($uri -> getUriIgnore());

			// generate and set refection method object
			// if method exists, determine value
			// set boolean to be used in the upcoming checks
			$isPublicMethod = method_exists ($instance, $uri -> nameOfMethod) ?
				self::setReflectedMethod($instance, $uri -> nameOfMethod) -> isPublic() : false;

			// if uri has a list of arguments...
			if (isset ($uri -> argArray) && $isPublicMethod)
			{
				//... then we know it has a method as well
				// so parse them both out and call method with
				// proper arguments
				if (count($uri -> argArray) <= self::$reflectedMethod -> getNumberOfParameters())
				{
					call_user_func_array(array($instance, $uri->nameOfMethod), $uri->argArray);

				}
				else
				{
					// ... UNLESS the number of passed arguments does not match
					// what the requested methods total number of allowable arguments
					// for now, let's toss a 404
					self::throw404();

				}

			}
			else if (isset ($uri -> nameOfMethod) && $isPublicMethod)
			{

				// if it has a valid method name but no arguments,
				// simply call the method
				$m = $uri -> nameOfMethod;
				$instance -> $m ();
			}
			else if (isset ($uri -> nameOfMethod) && !$isPublicMethod)
			{

				// a method name is being passed, but it doesn't
				// exist within the class - so throw a 404
				self::throw404();
			}
			else
			{
				// if uri indicates no arguments and no method,
				// then call init() by default
				$instance -> init ();
			}

		}
		else if (!isset ($uri -> nameOfClass))
		{
			// if uri does not specify a class to load
			// (ie - such as www.example.com/) then pull
			// Index.php by default.
			$instance = self::loadClassByName ("Home");
			$instance -> init ();
		}
		else
		{
			// default case - can't think of a realistic
			// use case, but here for sake of comleteness
			self::throw404();
		}

	} // end loadClass ------------------------------------------------------------------------------- end loadClass


	// just a helper method to direct bad requests.
	// Perhaps bring Utility_Error to Core and extend it?
	protected static function throw404 ()
	{
		header ("HTTP/1.0 404 Not Found");
		require ("kanji/errors/404.php");
		exit ();

	}


	//  takes a class instance and method to create a ReflectionMethod instance
	// for loading classes via URI
	public static function setReflectedMethod ($class, $method)
	{
		return self::$reflectedMethod = new ReflectionMethod($class, $method);

	}



	// reset class path if - presumably if it was changed prior
	public static function resetClassPath ()
	{

		self::$path = "kanji/app/";
	} // end resetClassPath ------------------------------------------------------------------------ end resetClassPath



	/* ! GETTERS & SETTERS  */
	public static function setClassPath ($classPath)
	{

		if (file_exists ($classPath))
		{

			self::$path = $classPath;
		}
		else
		{

			return false;
		}

	} // end setClassPath --------------------------------------------------------------------------- end setClassPath



	public static function getClassPath ()
	{

		return self::$path;
	} // end getClassPath --------------------------------------------------------------------------- end getClassPath

}// end class


/* end file
*/