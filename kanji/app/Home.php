<?php

class Home extends Kanji  {

	// Properties
	////////////////////////////////////////////////////////////////




	// Methods
	///////////////////////////////////////////////////////////////
	
	public function init ()
	{
	
		$this->setData("title", "Kanji Default Page");
		$this->renderView();	
	
	}
	
	
	public function tags ($tag="")
	{
		if($tag == "")
		{
			$this->setData("title", "Kanji Tags: ".$tag);
		}
		else 
		{
			$this->setData("title", "Tags: $tag");
		}

		$this->renderView();
	
	}


}// end class

/* end file
*/