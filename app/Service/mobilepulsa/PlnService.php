<?php

namespace App\Service\MobilePulsa;

use Illuminate\Http\Request;
use App\Traits\RequestService;
use GuzzleHttp\Exception\RequestException;

class PlnService
{
	use RequestService;

	protected $base_uri;
	protected $username;
	protected $apiKey;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->username = config('mobilepulsa.username');
		$this->apiKey = config('mobilepulsa.apiKey');
	}

	public function subscriberCheck(Request $request)
	{
		$hp = $request->input('customer_id');

		$sign = md5($this->username . $this->apiKey . $hp);

		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'inquiry_pln',
				'username' => $this->username,
				'hp' => $hp,
				'sign' => $sign
			]
		]);

		return $response;
	}
}
