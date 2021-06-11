<?php

namespace App\Service;

use Illuminate\Http\Request;
use App\Traits\RequestService;
use App\Traits\ResponseService;


class ProductService
{
	use RequestService, ResponseService;

	protected $base_uri;
	protected $username;
	protected $sign;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->username = config('mobilepulsa.username');
		$this->sign 	= md5(config('mobilepulsa.username') . config('mobilepulsa.apiKey') . 'pl');
	}

	public function data(Request $request)
	{
		if (!$request->query('operator')) return $this->badRequest(['message' => 'Operator is required.']);
		$operator = $request->query('operator');
		$status = $request->query('status', 'all');

		$uri = $this->base_uri . "/data/$operator";

		$response = $this->post($uri, [
			'json' => [
				'commands' => 'pricelist',
				'username' => $this->username,
				'sign' 	   => $this->sign,
				'status'   => $status
			]
		]);

		return $response;
	}
}
