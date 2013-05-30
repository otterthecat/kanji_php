<?php

	/*
		re-evaluate and test the hell out of the 
		html/multipart
	
	*/

    class Email_ServerMail {


	   //	VARIABLES
	   ////////////////////////////////////////////////////
	
    
        private $mail_to            		= "";
        private $mail_cc					= "";
        private $mail_bcc					= "";
        private $mail_from          		= "";
        private $mail_subject       		= "";
        private $mail_plain_body    		= "";
        private $mail_html_body     		= "";
        private $mail_body          		= "";
	
        private $mail_headers       		= array();
        
        private $mail_html_tmpl				= "";
	
	   // METHODS
	   ////////////////////////////////////////////////////



        public function __construct()
        {
            $this->mail_headers['type']		= "plain/text";
            return $this;
            
        }// end constructor ----------------------------------------------------------------------------------------- end constructor



        public function setTo($string_to)
        {
            
            $this->mail_to          			= $string_to;
            
            return $this;
            
        }// end setTO ----------------------------------------------------------------------------------------------- end setTo
        
        
        
        public function setCC($string_cc)
        {
        
        	$this->mail_headers['cc']			= $string_cc;
        	
        	return $this;
        
        }// end setCC ----------------------------------------------------------------------------------------------- end setCC
        
        
        
        public function setBCC($string_bcc)
		{
		
			$this->mail_headers['bcc']			= $string_bcc;
			
			return $this;
		
		}// end setBCC ---------------------------------------------------------------------------------------------- end setBCC
		


        public function setFrom($string_from)
        {
            
            $this->mail_headers['from']       	= $string_from;
            
            return $this;
            
        }// end setFrom --------------------------------------------------------------------------------------------- end setFrom



        public function setSubject($string_subj)
        {
            $this->mail_subject     			= $string_subj;
            
            return $this;
            
        }// end setSubject ------------------------------------------------------------------------------------------ end setSubject
        
        
        
        public function setPlainBody($string_plain)
        {
            
            $this->mail_plain_body  			= $string_plain;
            
            return $this;
            
            
        }// end setPlainBody ---------------------------------------------------------------------------------------- end setPlainBody
        
        
        
        public function setHtmlBody($string_html)
        {
            
            $this->mail_html_body   			= $string_html;
            
            return $this;
            
        }// end setHtmlBody ----------------------------------------------------------------------------------------- end setHtmlBody
        
        
        
        public function setHeaders($array_headers)
        {
            
            $this->mail_headers     			= $array_headers;
            
            return $this;
            
            
        }// end setHeaders ------------------------------------------------------------------------------------------ end setHeaders
        
        

        public function setMailType($string_type)
        {
            
            $type                   			= strtolower($string_type);
            
            switch($type)
            {
                case "html":
                    $this->mail_headers['type']      = "html";
                    break;
                    
                case "plain":
                    $this->mail_headers['type']		= "plain";
                    break;
                    
                case "multipart":
                	$this->mail_headers['type']		= "multipart";
                    
                default:
                    die("Error :: Argument for setMailType is invalid. Value must be 'html' or 'plain', or 'multipart'");
                    break;
                
            }
            
            return $this;
            
            
        }// end setMailType ----------------------------------------------------------------------------------------- end setMailType
        
        
        
        public function setHtmlTemplate($string_path)
        {
        
        	if(is_file($string_path))
        	{
        		$this->mail_html_tmpl			   = $string_path;
        	}
        	else
        	{
        		die("Error :: setHtmlTemplate argument must be a valid PHP file");
        	}
        	
        	return $this;
        
        
        }// end setHtmlTemplate ------------------------------------------------------------------------------------ end setHtmltemplate


        
        public function sendMail()
        {
        
        	$headers 								= $this->parseHeaders();
        	$this->concatBody();
         
            return mail($this->mail_to, $this->mail_subject, $this->mail_body, $headers);
            
            
        }// end sendMail ------------------------------------------------------------------------------------------- end sendMail
 
 
 
 		private function parseHeaders()
 		{
 		 
            $headers = "";
            
            foreach($this->mail_headers as $key=>$hdr)
            {
                
                $headers .= $key.": ".$hdr.";\n";
                
            }
            
            return $headers;
         
 		
 		}// end parseHeaders ---------------------------------------------------------------------------------------- end parseHeaders
 		
 		
 		
 		private function concatBody()
 		{
 		
 			switch($this->mail_headers['type'])
 			{
 			
 				case "html":
 					$this->mail_body				 = $this->mail_html_body;
 					break;
 					
 				case "plain/text":
 					$this->mail_body				 = $this->mail_plain_body;
 					break;
 					
 				case "multipart":
 					$this->mail_body				 = $this->mail_plain_body.$this->mail_html_body;
 					break;
 			
 			}
 		
 		}// end concatBody ------------------------------------------------------------------------------------------ end concatBody       


    }// end class
    
/* end file
*/