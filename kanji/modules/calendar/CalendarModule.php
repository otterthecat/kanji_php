<?php
require_once("kanji/core/Module.php");
class CalendarModule extends Module {

	// Methods
	///////////////////////////////////////////////////////////////

	public function init()
	{
		$calendarModule = $this->loadKanji('Date_Calendar');
		$this->setData("c", $calendarModule -> getCurrentCalendar());
		
		return $this -> renderView ();
	}


}// end class

/* end file
*/