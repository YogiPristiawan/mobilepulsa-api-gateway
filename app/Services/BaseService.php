<?php

namespace App\Services;

class BaseService
{
	public $base_uri;
	public $username;
	public $apiKey;
	public $notFailedResponse;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->apiKey = config('mobilepulsa.apiKey');
		$this->username = config('mobilepulsa.username');
		$this->notFailedResponse = [00, 39, 201];
	}
}
