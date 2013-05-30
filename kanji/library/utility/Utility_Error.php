<?php

class Utility_Error {

	// Properties
	////////////////////////////////////////////////////////////////

	protected $errorLogPath = "kanji/logs/";
	protected $errorLogFile = "error.txt";
        
        protected $defaultErrorMessage = "Uh-oh. You know how they say mistakes happen all the time? This is one of those times.";
        
        protected $originalErrorHandler;


	// Methods
	///////////////////////////////////////////////////////////////

	public function __construct ($path=null, $file=null)
	{

            $this->setErrorLogFile($path);
            $this->setErrorLogFile($file);
            
	}// end constructor 

        
        public function setErrorHandler($functionHandler)
        {
            $this->originalErrorHandler = set_error_handler($functionHandler, E_ALL);
            
        }
        
        
        public function resetErrorHandler()
        {
            if(isset($originalErrorHandler))
            {
                set_error_handler($originalErrorHandler);
                
            }
            else
            {
                restore_error_handler();
                
            }
            
        }
        

	public function setErrorLogPath ($path)
	{
	
           if (isset($path) && is_dir($path))
            {
                $this->errorLogPath = $path;
                
            }
	}
	
	
	public function setErrorLogFile ($fileName)
	{
	
           if (isset($$fileName) && file_exists($fileName))
            {
                $this->errorLogFile = $fileName;
                
            }
	}


	public function throwError ($message, $doDie = false)
	{
	
            if (isset($message) && $doDie)
            {
                
                die($message);
            }
            else if (isset($message))
            {
            
                echo $message;
            }
            else 
            {
                // no message defined, so just log an error stating that
                $this->logError("Error :: Error.thowError() called but message arguement not set");
            }
	}


	public function throwErrorPage ($code, $message=null)
	{
                $kanjiErrorMessage = ($message != null)? $message : $this->defaultErrorMessage;
                
		switch ($code)
		{
		
			case '401':
                                header ("HTTP/1.0 401 Unauthorized");
                                require("kanji/errors/401.php");
				break;
		
			case '404': 
                                header ("HTTP/1.0 404 Not Found");
				require("kanji/errors/404.php");
				break;
		
			case '500':
                                header ("HTTP/1.0 500 Internal Server Error");
				require("kanji/errors/500.php");
				break;
		
			default:
                                header ("HTTP/1.0 503 Service Unavailable");
                                require("kanji/errors/503.php");
				break;
		}
	
                exit();
	}
	
	
	
	public function logError ($message)
	{
	
            $errorFile = $this->errorLogPath.$this->errorLogFile;
            
            file_put_contents($errorFile, $message."\n", FILE_APPEND | LOCK_EX);
	}
	

}// end class

/* end file
*/