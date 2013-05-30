<?php

/**
 * @author David Lally
 * @copyright 2009
 */



class File_Reader{
    
    //  VARIABLES
    ////////////////////////////////////////////////////////
    
    
    private $directory_string       = string;
    
    
    
    //  METHODS
    ////////////////////////////////////////////////////////
    
    
    public function __construct($dir_str)
    {
        
        ((string)$dir_str)? $this->directory_string = $dir_str :
            
            die("ERROR :: FileReader Construct :: Invalid argument");
           
        // enable chaining    
        return $this;
        
    }// end construct ----------------------------------------------------------------------------------------------------------- end construct
    
    
    
    
    public function getDirPath()
    {
        return $this->directory_string;   
        
    }// end getDirPath ---------------------------------------------------------------------------------------------------------- end getDirPath
    
    
    public function getFileContent ()
    {
    	// placeholder for now
    
    }
    
    
    public function setDirPath($dir_str)
    {
        
        ((string)$dir_str)? $this->directory_string = $dir_str :
            
            die("ERROR :: FileReader setDirPath :: Invalid argument");
        
        // enable chaining
        return $this;
        
    }// end setDirPath ---------------------------------------------------------------------------------------------------------- end setDirPath
    
    
    
    
    public function getDirectoryContentByType($filter = false, $ext_str = ".jpg")
    {
        
        $tmp_array  = scandir($this->directory_string);
        $file_array = array();

        foreach($tmp_array as $item)
        {
            if(!is_dir($this->directory_string."/".$item))
            {

                array_push($file_array, $item);
                
            }
        }
        
       if($filter){$file_array = $this->filterExtension($file_array, $ext_str);}
        
       return $file_array;
        
        
    }// end scanFiles ----------------------------------------------------------------------------------------------------------- end scanFiles
    
    
    
    
    public function scanDirectoryContent() // combine fuctionality with getDirectoryContentByType()
    {
       return scandir($this->directory_string);   
        
    }// end scanDirectoryContent ----------------------------------------------------------------------------------------------- end scanDirectoryContent
    
    
    
    
    public function getDirectoryContentCount()
    {
        return count(scandir($this->directory_string));
        
    }// end getDirectoryContentCount -------------------------------------------------------------------------------------------- end getDirectoryContentCount
    
    
    
    
    private function filterExtension($array, $ext_str)
    {
        $filter_array   = array();
        
        // create a negative number used below when checking substr
        $str_pos        = "-".strlen($ext_str);
        
        foreach($array as $item)
        {
            if($ext_str == substr($item, $str_pos)){array_push($filter_array, $item);}
            
        }
        
        return $filter_array;
        
    }// end filterExtension ----------------------------------------------------------------------------------------------------- end filterExtension
  

}// end class 

/* end file
*/