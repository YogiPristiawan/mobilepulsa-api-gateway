<?php

namespace App\Service;

use App\Traits\RequestService;

class TransactionService
{
	use RequestService;

	protected $base_uri;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
	}

	public function balance()
	{
		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'balance',
				'username' => config('mobilepulsa.username'),
				'sign'	   => md5(config('mobilepulsa.username') . config('mobilepulsa.apiKey') . 'bl')
			]
		]);
		return $response;
	}
}
