<?php

class Utility_Scrub {

    //	VARIABLES
    ////////////////////////////////////////////////////
    // METHODS
    ////////////////////////////////////////////////////


    public static function scrubPOST($mysql_escape = false)
    {

        return self::scrubData($_POST, $mysql_escape);
    }

// end scrubPOST ------------------------------------------------------------------------------------------------------ end scrubPOST

    public static function scrubGET($mysql_escape = false)
    {

        return self::scrubData($_GET, $mysql_escape);
    }

// end scrubGET ------------------------------------------------------------------------------------------------------- end scrubGET

    public static function scrubString($string, $mysql_escape = false)
    {

        $temp_array["string"] = $string;

        $scrubbed_array = self::scrubData($temp_array, $mysql_escape);

        return $scrubbed_array["string"];
    }

// end scrubString ---------------------------------------------------------------------------------------------------- end scrubString

    private static function scrubData($data_obj, $mysql_escape = false)
    {

        $scrubbed_data = array();

        if (!$mysql_escape)
        {

            foreach ($data_obj as $key => $item)
            {

                $scrubbed_data[$key] = htmlentities(trim($item), ENT_QUOTES);
            }

            return $scrubbed_data;
        }
        else
        {

            foreach ($data_obj as $key => $item)
            {

                $scrubbed_data[$key] = mysql_escape_string(htmlentities(trim($item), ENT_QUOTES));
            }

            return $scrubbed_data;
        }
    }

// end scrubData ------------------------------------------------------------------------------------------------------ end scrubData
}

// end class


/* end file

*/