<?php
require_once("kanji/core/Module.php");
class FormModule extends Module  {


	// Methods
	///////////////////////////////////////////////////////////////

	public function init ()
	{
	
		$elements[0]["type"] = "text";
		$elements[0]["name"] = "someText";
		$elements[0]["class"] = "inputText";
		
		$elements[1]["type"] = "submit";
		$elements[1]["name"] = "submit";
		$elements[1]["class"] = "submit";
		
		$this->setData("elements", $elements);
		
		return $this->renderView ();
	
	}


}// end class

/* end file
*/