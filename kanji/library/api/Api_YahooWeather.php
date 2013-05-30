<?php

/* *******************

	Put in APIS folder
	
	Double check for tidiness

******************** */


class Api_YahooWeather {

	// Properties
	////////////////////////////////////////////////////////////////
	
	// yahoo's weather api url
	private $yahooUrl 				= "http://weather.yahooapis.com/forecastrss?w=%s&c=%s";
	
	// woeid is the target location - found via Yahoo
	private $woeid 					= "12784107";
	// Farenheit (f) or Celsius (c)
	private $units 					= "f";
	
	// the final url used to get the data after sprintf with the above
	private $rssUrl 				= "";

	// codes for weather description
	// provided by Yahoo (http://developer.yahoo.com/weather/index.html)
	private $conditionCodes			= array();

	// Methods
	///////////////////////////////////////////////////////////////

	public function __construct($woeid = false, $units = false)
	{
		if($woeid)
		{
			$this->woeid = $woeid;
		}
		
		if($units)
		{
			$this->units = $units;
		}
		
		$this->rssUrl = sprintf($this->yahooUrl, $this->woeid, $this->units);
		
		
		// codes for weather description
		// provided by Yahoo (http://developer.yahoo.com/weather/index.html)
		$this->conditionCodes[0]		= "tornado";
		$this->conditionCodes[1]		= "tropical storm";
		$this->conditionCodes[2]		= "hurricane";
		$this->conditionCodes[3]		= "severe thunderstorms";
		$this->conditionCodes[4]		= "thunderstorms";
		$this->conditionCodes[5]		= "mixed rain and snow";
		$this->conditionCodes[6]		= "mixed rain and sleet";
		$this->conditionCodes[7]		= "mixed snow and sleet";
		$this->conditionCodes[8]		= "freezing drizzle";
		$this->conditionCodes[9]		= "drizzle";
		$this->conditionCodes[10]		= "freezing rain";
		$this->conditionCodes[11]		= "showers";
		$this->conditionCodes[12]		= "showers"; // duplicate exists in yahoo data as of 5/1/11
		$this->conditionCodes[13]		= "snow flurries";
		$this->conditionCodes[14]		= "light snow showers";
		$this->conditionCodes[15]		= "blowing snow";
		$this->conditionCodes[16]		= "snow";
		$this->conditionCodes[17]		= "hail";
		$this->conditionCodes[18]		= "sleet";
		$this->conditionCodes[19]		= "dust";
		$this->conditionCodes[20]		= "foggy";
		$this->conditionCodes[21]		= "haze";
		$this->conditionCodes[22]		= "smoky";
		$this->conditionCodes[23]		= "blustery";
		$this->conditionCodes[24]		= "windy";
		$this->conditionCodes[25]		= "cold";
		$this->conditionCodes[26]		= "cloudy";
		$this->conditionCodes[27]		= "mostly cloudy (night)";
		$this->conditionCodes[28]		= "mostly cloudy (day)";
		$this->conditionCodes[29]		= "partly cloudy (night)";
		$this->conditionCodes[30]		= "partly cloudy (day)";
		$this->conditionCodes[31]		= "clear night";
		$this->conditionCodes[32]		= "sunny";
		$this->conditionCodes[33]		= "fair (night)";
		$this->conditionCodes[34]		= "fair (day)";
		$this->conditionCodes[35]		= "mixed rain and hail";
		$this->conditionCodes[36]		= "hot";
		$this->conditionCodes[37]		= "isolated thunderstorms";
		$this->conditionCodes[38]		= "scattered thunderstorms";
		$this->conditionCodes[39]		= "scattered thunderstorms"; // duplicate exists in yahoo data as of 5/1/11
		$this->conditionCodes[40]		= "scattered showers";
		$this->conditionCodes[41]		= "heavy snow";
		$this->conditionCodes[42]		= "scattered snow showers";
		$this->conditionCodes[43]		= "heavy snow";
		$this->conditionCodes[44]		= "partly cloudy";
		$this->conditionCodes[45]		= "thundershowers";
		$this->conditionCodes[46]		= "snow showers";
		$this->conditionCodes[47]		= "isolated thundershowers";
		$this->conditionCodes[3200]		= "not available";
		
	}// end constructor 
	
	
	public function getTemp()
	{

 		$curl                               = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->rssUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result                       = curl_exec($curl);

        curl_close($curl);
        
        return $this->parseFeed($result);

	}
	
	
	public function getForecast()
	{
	
	
	}
	
	
	private function parseFeed($yahooFeed)
	{
	
		$yahooFeed = simplexml_load_string($yahooFeed);
		$item_yweather = $yahooFeed->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0");
		
		foreach($item_yweather as $x => $yw_item)
		{
			foreach($yw_item->attributes() as $k => $attr)
			{
				if($k == 'day') $day = $attr;
				if($x == 'forecast')
				{
					$yw_forecast[$x][$day . ''][$k] = $attr;
				} 
				else
				{
					$yw_forecast[$x][$k] = $attr;
				}
			}
		}
		
		return $yw_forecast;
	}


}// end class

/* end file
*/