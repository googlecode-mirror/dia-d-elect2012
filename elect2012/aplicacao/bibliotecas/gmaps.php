<?php

final class gmaps{

	public static function getLatLong($enderecoCompleto){
		$enderecoCompletoUrl = urlencode($enderecoCompleto);
		$url = "http://maps.google.com/maps/api/geocode/json?address=$enderecoCompletoUrl&sensor=false&region=Brasil";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);	
		if($response_a->status == 'OK'){
			$lat = $response_a->results[0]->geometry->location->lat;
			$long = $response_a->results[0]->geometry->location->lng;
			return array($lat,$long);
		}else{
			return false;
		}
		
	}
	
}
