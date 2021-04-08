<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait RequestService
{
	public function request($method, $path, $option = [])
	{
		$client = new Client([
			'base_uri' => $this->base_uri
		]);

		$response = $client->request($method, $path, $option);

		return json_decode($response->getBody());
	}
}
