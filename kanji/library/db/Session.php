<?php


	/* ********************************************
	
	Seems like a lot of extra code just for a wrapper
	class of PHP built in functions.
	
	Scrap this?
	
	********************************************* */

    class Session {
        
        
        public function __construct()
        {
            session_start();
            
        }// end Constructor --------------------------------------------------------------------------------------- end constructor
        


        public function setSession(array $data_array)
        {

            foreach($data_array as $key=>$value)
            {
                $_SESSION[$key]   = $value;    
            }
                        

        }// end setSession ---------------------------------------------------------------------------------------- end setSession
        
        
        
        
        public function getSession($session_field = null) // returned arrays will return NULL values if requested fields don't exist
        {

            if(is_array($session_field))
            {

                $temp_array     = array();
                
                foreach($session_field as $item)
                {
                    
                    $temp_array[$item]    = $_SESSION[$item];
                    
                }
                
                
                return              $temp_array;

            }
            else if(is_string($session_field))
            {
                
                $field_array      = explode(", ", $session_field);
                
                $temp_array       = array();
                
                foreach($field_array as $item)
                {
                    
                    $temp_array[$item]  = $_SESSION[$item];
                }
                
                
                return              $temp_array;
                
                
            }
            else
            {

                return $_SESSION;

            }

        }// end getSession ---------------------------------------------------------------------------------------- end getSession
        
        
        
        
        public function deleteSession(array $data_array = null)
        {

            if(is_array($data_array))
            {
                
                foreach($data_array as $item)
                {
                    
                    unset($_SESSION[$item]);
                    
                }
                
                return;


            }
            else
            {

                return session_unset();

            }

        }// end deleteSession ------------------------------------------------------------------------------------- end deleteSession

        
    }// end class


/* end file

*/