<?php
private function getCityStateCountry($latitude,$longitude){
	$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&amp;sensor=false"; 
	$response = file_get_contents($url);
	$json = json_decode($response,TRUE); //set json response to array based
	$address_arr = $json['results'][0]['address_components'];

	$address = "";
	$city = "";
	$state = "";
	$zip_code = "";
	$country = "";

	foreach ($address_arr as $arr1){
		if(strcmp($arr1['types'][0],"street_number") == 0){
		$address .= $arr1['long_name']." ";
		continue;
		}
		if(strcmp($arr1['types'][0],"route") == 0){
		$address .= $arr1['long_name'];
		continue;
		}
		if(strcmp($arr1['types'][0],"locality") == 0){
		$city = $arr1['long_name'];
		continue;
		}
		if(strcmp($arr1['types'][0],"administrative_area_level_1") == 0){
		$state = $arr1['long_name'];
		continue;
		}
		if(strcmp($arr1['types'][0],"administrative_area_level_2") == 0){
		$state2 = $arr1['long_name'];
		continue;
		}
		if(strcmp($arr1['types'][0],"postal_code") == 0){
		$zip_code = $arr1['long_name'];
		continue;
		}
		if(strcmp($arr1['types'][0],"country") == 0){
		$country = $arr1['long_name'];
		continue;
		}	 
	}
	$response = array("address"=>$address, "city"=>$city, "state"=>$state, "zipcode"=>$zip_code, "country"=>$country);
	return $response;
 }
 
$latitude=$_POST['YOUR_LATTITUDE'];
$longitude=$_POST['YOUR_LONGITUDE'];

$array = getCityStateCountry($latitude,$longitude);//call function

$getcitiy = $array['city'];
$getstate = $array['state'];
$getcountriy = $array['country'];	

?>
