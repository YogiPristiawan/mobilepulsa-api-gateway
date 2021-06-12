<?php

namespace App\Services\MobilePulsa;

use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Traits\RequestService;
use App\Exceptions\BadRequestException;

class PlnService extends BaseService
{
	use RequestService;

	public function __construct()
	{
		parent::__construct();
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

		$data = json_decode($response->getBody())->data;

		if (isset($data->rc)) {
			if (!in_array($data->rc, $this->notFailedResponse)) throw new BadRequestException($data->message);
		}

		return $data;
	}
}
