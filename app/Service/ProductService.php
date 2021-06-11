<?php

namespace App\Service;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\InvalidArgumentException;
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

	public function priceList(Request $request)
	{
		$type = $request->query('type');
		$operator = $request->query('operator');
		$status = $request->query('status', 'all');

		if ($type && $operator) {
			$this->base_uri .= "/$type/$operator";
		} else if ($type) {
			$this->base_uri .= "/$type";
		}

		$response = $this->post($this->base_uri, [
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
