<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\BadRequestException;
use App\Services\MobilePulsa\PlnService;
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

			return $this->success(['data' => $response]);
		} catch (RequestException $err) {

			return response()->json(['message' => $err->getMessage()], $err->getResponse()->getStatusCode());
		} catch (BadRequestException $err) {

			return $this->badRequest(['message' => $err->getMessage()]);
		}
	}
}
