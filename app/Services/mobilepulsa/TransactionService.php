<?php

namespace App\Services\MobilePulsa;

use Illuminate\Http\Request;
use App\Traits\RequestService;

class TransactionService
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

	public function balance()
	{
		$sign = md5($this->username . $this->apiKey . 'bl');

		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'balance',
				'username' => $this->username,
				'sign'	   => $sign
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

	public function status(Request $request)
	{
		$ref_id = $request->input('ref_id');

		$sign = md5($this->username . $this->apiKey . $ref_id);

		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'inquiry',
				'username' => $this->username,
				'ref_id' => $ref_id,
				'sign' => $sign
			]
		]);

		return $response;
	}
}
