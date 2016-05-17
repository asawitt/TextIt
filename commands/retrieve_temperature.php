<?php

if ($args[0] == null) { 
	return "Please try again with a location"; 
	exit; 
}
if ($args[0] == "in") {
	if ($args[1] == null) { 
		return "Please try again with a location";
		exit; 
	}
	$city = $args[1]; //Gets rid of "in" i.e. what's the temperature in Montreal; 
}
else {
	$city = $args[0];
}

$weather_data = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=e3caf277a5de8dfd098c88f73c03ae71");
$json= json_decode($weather_data);
$temp = $json->main->temp;
$temp -= 273.15;
return "The temperature in " . $city . " is: " . $temp . " degree Celsius."; 

?>