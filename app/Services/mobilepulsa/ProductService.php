<?php

namespace App\Services\MobilePulsa;

use Illuminate\Http\Request;
use App\Exceptions\BadRequestException;
use App\Services\BaseService;
use App\Traits\RequestService;
use App\Traits\ResponseService;


class ProductService extends BaseService
{
	use RequestService, ResponseService;

	public function __construct()
	{
		parent::__construct();
	}

	public function priceList(Request $request)
	{
		$sign = md5($this->username . $this->apiKey . 'pl');

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
				'sign' 	   => $sign,
				'status'   => $status
			]
		]);

		$data = json_decode($response->getBody())->data;

		if (isset($data->rc)) {
			if (!in_array($data->rc, $this->notFailedResponse)) throw new BadRequestException($data->message);
		}

		return $data;
	}
}
