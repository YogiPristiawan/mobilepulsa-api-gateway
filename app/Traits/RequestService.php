<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

trait RequestService
{
	public function request($method, $path, $option = [])
	{
		$client = new Client(['base_uri' => $this->base_uri]);
		$response = $client->request($method, $path, $option);

		return $response;
	}

	public function post($uri, $option = [])
	{
		$client = new Client();
		$response = $client->post($uri, $option);

		return $response;
	}

	public function get($uri, $option = [])
	{
		$client = new Client();
		$response = $client->get($uri, $option);

		return $response;
	}
}
