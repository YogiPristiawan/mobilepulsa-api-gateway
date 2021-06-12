<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service\MobilePulsa\PlnService;
use App\Traits\ResponseService;

class PlnController extends Controller
{
	use ResponseService;

	protected $plnService;

	public function __construct(PlnService $plnService)
	{
		$this->plnService = $plnService;
	}

	public function subscriberCheck(Request $request)
	{
		$validator = Validator::make(
			$request->only(['customer_id']),
			[
				'customer_id' => ['required']
			]
		);

		if ($validator->fails()) return $this->badRequest(['message' => $validator->errors()->all()]);

		try {
			$response = $this->plnService->subscriberCheck($request);
			$data = json_decode($response->getBody())->data;

			return $this->success(['data' => $data]);
		} catch (RequestException $err) {

			return $this->serverError(['message' => $err->getMessage()]);
		}
	}
}
