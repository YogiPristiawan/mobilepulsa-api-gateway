<?php

namespace App\Service\MobilePulsa;

use Illuminate\Http\Request;
use App\Traits\RequestService;

class TransactionService
{
	use RequestService;

	protected $base_uri;
	protected $username;
	protected $sign;
	protected $apiKey;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->username = config('mobilepulsa.username');
		$this->apiKey = config('mobilepulsa.apiKey');
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

	public function topUp(Request $request)
	{
		$ref_id = $request->input('ref_id');
		$hp = $request->input('hp');
		$pulsa_code = $request->input('pulsa_code');

		$sign = md5($this->username . $this->apiKey . $ref_id);

		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'topup',
				'username' => $this->username,
				'ref_id' => $ref_id,
				'hp' => $hp,
				'pulsa_code' => $pulsa_code,
				'sign' => $sign
			]
		]);

		return $response;
	}
}
