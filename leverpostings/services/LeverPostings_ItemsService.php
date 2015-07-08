<?php
namespace Craft;

use Guzzle\Http\Client;
/**
 * Lever Postings service
 */
class LeverPostings_ItemsService extends BaseApplicationComponent
{
	public function settings(){
		$settings = craft()->plugins->getPlugin('leverpostings')->getSettings();
		return $settings;
	}
	public function getJobs(){
		return callLever('https://api.lever.co/v0/postings/'.settings()->leverId.'?&mode=json&group=team');
	}
	public function callLever($url){
			$cachedResponse = craft()->fileCache->get($url);

			if ($cachedResponse) {
				return $cachedResponse;
			}
			try {
				$client = new Client();
				$request = $client->get($url);
				$response = $request->send();
				if (!$response->isSuccessful()) {
						return;
				}
				$items = $response->json();
				craft()->fileCache->set($url, $items);
				return $items;
			}
		  catch(\Guzzle\Http\Exception\ClientErrorResponseException $e)
		  {
		      Craft::log(__METHOD__." Couldn't get lever response", LogLevel::Info, true);
		  }
		  catch(\Guzzle\Http\Exception\CurlException $e)
		  {
		      Craft::log(__METHOD__." ".$e->getMessage(), LogLevel::Info, true);
		  }
		}
	// public function curlRequest($url)
	// {
	// 	$curl = curl_init(); 
	// 	$header[] = "Cache-Control: max-age=0"; 
	// 	$header[] = "Connection: keep-alive"; 
	// 	$header[] = "Keep-Alive: 300"; 
	// 	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
	// 	$header[] = "Accept-Language: en-us,en;q=0.5"; 
	// 	$header[] = "Pragma: ";

	// 	curl_setopt($curl, CURLOPT_URL, $url); 
	// 	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0'); 
	// 	curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
	// 	curl_setopt($curl, CURLOPT_REFERER, ''); 
	// 	curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
	// 	curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
	// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	// 	curl_setopt($curl, CURLOPT_TIMEOUT, 10); 

	// 	$response = curl_exec($curl); 
	// 	curl_close($curl);

	// 	return $response;
	// }

}
