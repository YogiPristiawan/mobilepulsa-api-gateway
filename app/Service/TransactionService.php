<?php

namespace App\Service;

use App\Traits\RequestService;

class TransactionService
{
	use RequestService;

	protected $base_uri;
	protected $username;
	protected $sign;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->username = config('mobilepulsa.username');
		$this->sign = md5(config('mobilepulsa.username') . config('mobilepulsa.apiKey') . 'bl');
	}

	public function balance()
	{
		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'balance',
				'username' => $this->username,
				'sign'	   => $this->sign
			]
		]);
		return $response;
	}
}
