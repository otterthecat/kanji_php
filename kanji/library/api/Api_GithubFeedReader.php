<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GithubFeedReader
 *
 * @author servo
 */
class Api_GithubFeedReader {

	private $githubBaseString = "https://github.com/%s.atom";
	private $userName = "";
	private $feedUrl = "";
	private $itemLimit = 3;

	public function __construct($user = null){

		if(isset($user)){

			$this->setUserName($user);
			$this->setFeedUrl();
		}

	}



	public function getUserName(){

		return $this->userName;
	}



	public function setUserName($string){

		if(is_string($string)){

			$this->userName = $string;
			$this->setFeedUrl();
		}

	}



	protected function setFeedUrl(){

		$this->feedUrl = sprintf($this->githubBaseString, $this->userName);
	}



	public function getFeedlUrl(){

		return $this->feedUrl;
	}



	public function getFeed($xml = true){

		if($xml){
			$feedObj = simplexml_load_string($this->doCurl());

			$tmp_array = array ();

			for($i=0; $i < $this->itemLimit; $i++){

				array_push($tmp_array, $feedObj->entry[$i]->title);
			}

			return $tmp_array;

		} else {

			return $this->doCurl();
		}
	}


	public function setItemLimit($num){

		if(is_numeric($num)){

			$this->itemLimit = $num;
		}
	}


	public function getItemLimit(){

		return $this->itemLimit;
	}


	private function doCurl(){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->feedUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        curl_close($curl);

        return  $result;
	}

} // end classs


