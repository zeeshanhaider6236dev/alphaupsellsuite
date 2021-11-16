<?php
namespace App\Http\Traits;


trait ShopifyApiTrait {

	private $shop;

	public function shopifyApiRequest($api = "" ,$api_get_fields = null, $api_post_fields = null  ,$api_required_fields = null,$shop = null,$method = "GET" )
	{
		$this->shop($shop);
		$response =  $this->shop->api()->rest($method, $this->makeUrl($api , $api_get_fields),$api_post_fields);
		if($response['errors'] === true):
			return $response['errors'];
		endif;
		if($api_required_fields):
			return $this->getRequiredFields($api_required_fields,$response);
		endif;
		return $response;
	}

	public function makeUrl($api,$data = [])
	{
		$url = [];
		foreach (config("shopifyApi.apis.$api") as $value) {
			if($data) :
				$url[]=$value;
				$url[] = $data;
				$data = null;
			else:
				$url[] = $value;
			endif;
		}
		// info(implode('', $url));
		return implode('', $url);
	}

	public function shopifyApiGraphQuery($api = "" ,$api_get_fields = null,$api_post_fields = null,$api_required_fields = null,$shop = null)
	{
		$this->shop($shop);
		// info($this->makeGraphUrl($api , $api_get_fields));
		if($api_post_fields):
			$response =  $this->shop->api()->graph($this->makeGraphUrl($api , $api_get_fields),$api_post_fields);
		else:
			$response =  $this->shop->api()->graph($this->makeGraphUrl($api , $api_get_fields));
		endif;
		// info($response);
		if($response['errors'] === true):
			return $response['errors'];
		endif;
		if($api_required_fields):
			return $this->getRequiredFields($api_required_fields,$response);
		endif;
		return $response;
	}

	public function getRequiredFields($api_required_fields,$response)
	{
		foreach ($api_required_fields as $key => $value) {
			if(!isset($response[$value])):
				return $response;
			endif;
			$response = $response[$value];
		}
		return $response;
	}

	public function makeGraphUrl($api,$data = null)
	{
		$url = [];
		foreach (config("shopifyApi.graphQl.apis.$api") as $key => $aPart) {
			$url[] = $aPart;
			if($data) :
				if(isset($data[$key])):
					$url[] = $data[$key];
				endif;
			endif;
		}
		return implode('', $url);
	}

	public function shop($shop = null){
		if(!$this->shop):
			$this->shop = $shop ?? auth()->user();
		endif;
	}
}
