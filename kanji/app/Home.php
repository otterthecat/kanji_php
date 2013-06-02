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
	
	// url path /home/one will execute this method
	// add a title argument by using path /home/one/title
	public function one ($title)
	{

		if($title == "")
		{
			$this->setData("title", "Kanji Page One");
		}
		else 
		{
			$this->setData("title", $title);
		}

		$this->renderView();
	}

	// url path /home/two will execute this method
	// add a title argument by using path /home/two/title
	public function two ($title)
	{

		if($title == "")
		{
			$this->setData("title", "Kanji Page Two");
		}
		else 
		{
			$this->setData("title", $title);
		}

		$this->renderView();
	}

}// end class

/* end file
*/