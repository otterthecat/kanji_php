<?php

/**
 * @author David Lally
 * @copyright 2010
 */


class Date_Calendar{
    
    
    //      PROPERTIES
    /////////////////////////////////////////////////////////////////

    private $current_calendar                       = array();
    
    private $new_calendar                           = array();

    private $view_url                               = "";

    
    //      METHODS
    /////////////////////////////////////////////////////////////////


    public function __construct()
    {
        
        $this->current_calendar['year']               = date("Y");
        $this->current_calendar['month']              = date("F");
        $this->current_calendar['day']                = date("j");
        $this->current_calendar['month_num']          = date("n");
        $this->current_calendar['month_len']          = date("t");
        $this->current_calendar['start_day']          = date("w", mktime(0, 0, 0, $this->current_calendar['month_num'], 1, $this->current_calendar['year']));
        
        
        // some months may get "longer" if the start day is late in the week, compensate here
        $total_month_length                       = $this->current_calendar['start_day'] + $this->current_calendar['month_len'];
        $this->current_calendar['num_weeks']          = ceil($total_month_length/7);
        
        return $this;
        
    }// end constructor ---------------------------------------------------------------------------------------------------------------- end constructor
    
    
    
    public function setViewUrl($path)
    {
        
        $this->view_url         = $path;
        
        return $this;
        
    }// end setViewUrl ----------------------------------------------------------------------------------------------------------------- end setViewUrl
    
    
    
    public function getCurrentYear()
    {
    
        return $this->current_calendar['year'];
        
    }// end getCurrentYear ------------------------------------------------------------------------------------------------------------- end getCurrentYear
    
    
    
    public function getCurrentMonth()
    {
        
        return $this->current_calendar['month_num'];
        
    }// end getCurrentMonth ------------------------------------------------------------------------------------------------------------ end getCurrentMonth
    
    
    
    
    public function getCurrentDay()
    {
        
        return $this->current_calendar['day'];
        
    }// end getCurrentDay -------------------------------------------------------------------------------------------------------------- end getCurrentDay
    
    
    
    
    public function getCurrentCalendar()
    {
    
    
        return                 $this->generateCalendar($this->current_calendar);
                                                                                 
        
    }// end getCurrentCalendar() ------------------------------------------------------------------------------------------------------- end getCurrentCalendar
    
    

    
    public function getCalendar($year, $month, $day)
    {
        
        
        $this->setNewCalendar($year, $month, $day);
        
        
        return                      $this->generateCalendar($this->new_calendar);
        
        
    }// end getCalendar ---------------------------------------------------------------------------------------------------------------- end getCalendar
    
    


    public function render($array)
    {
        $c                                        =  $array;
        
        ob_start();
        
        require($this->view_url);
        
        $rendered_calendar  = ob_get_contents();
        
        ob_end_clean();
        
        
        return              $rendered_calendar;
        
    }// end render -------------------------------------------------------------------------------------------------------------------- end render
        
    
    
    
    private function setNewCalendar($year, $month, $day)
    {
        

        $this->new_calendar['year']               = $year;
        $this->new_calendar['month_num']          = $month;
        $this->new_calendar['day']                = $day;
        
        $offset                                   = mktime(0, 0, 0, $this->new_calendar['month_num'], 1, $this->new_calendar['year']);
        
        $this->new_calendar['month']              = date("F", $offset);
        $this->new_calendar['month_len']          = date("t", $offset);
        $this->new_calendar['start_day']          = date("w", $offset);
        
        // some months may get "longer" if the start day is late in the week, compensate here
        $total_month_length                       = $this->new_calendar['start_day'] + $this->new_calendar['month_len'];
        $this->new_calendar['num_weeks']          = ceil($total_month_length/7);
        
    }// end setNewCalendar ------------------------------------------------------------------------------------------------------------ end setNewCalendar
    
    
    
    private function generateCalendar($c)
    {
        
        $cal_array  = array();
        $n = 0;
        for($i = 0; $i < $c['num_weeks']; $i++){
           
           $cal_array[$i] = range($n, $n+6);
	       $n += 7;
        }     
        
        $cal_output['year']                     = $c['year'];
        $cal_output['month']                    = $c['month'];
        $cal_output['today']                    = $c['day'];
        
        for($i=0; $i<count($cal_array); $i++)
        {
            
           for($x=0; $x<count($cal_array[$i]); $x++)
           {
                
                if($cal_array[$i][$x] >= $c['start_day'] &&
                   $cal_array[$i][$x] <= ($c['start_day'] + $c['month_len'])-1 )
                {

                    // if day is inside of month, show day
                    $cal_output['week'][$i][$x] = $cal_array[$i][$x] - ($c['start_day'] - 1);
                    
                }
                else
                {
                    //if day is outside of month, show nothing
                    $cal_output['week'][$i][$x] = "";
                }
            
           } 
            
        }
        
        return $cal_output;
        
    }// end generateCalendar ----------------------------------------------------------------------------------------------------------- end generateCalendar
    
    
}// end class


/* end file
*/