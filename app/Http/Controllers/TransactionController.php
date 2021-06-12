<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service\MobilePulsa\TransactionService;
use App\Traits\ResponseService;

class TransactionController extends Controller
{
	use ResponseService;

	protected $transactionService;

	public function __construct(TransactionService $transactionService)
	{
		$this->transactionService = $transactionService;
	}

	public function balance()
	{
		try {
			$response = $this->transactionService->balance();
			$data = json_decode($response->getBody())->data;

			return $this->success(['data' => $data]);
		} catch (RequestException $err) {

			return $this->serverError(['message' => $err->getMessage()]);
		}
	}

	public function topUp(Request $request)
	{
		$validator = Validator::make(
			$request->only(['ref_id', 'hp', 'pulsa_code']),
			[
				'ref_id' => ['required'],
				'hp' => ['required'],
				'pulsa_code' => ['required']
			]
		);

		if ($validator->fails()) return $this->badRequest(['message' => $validator->errors()->all()]);

		try {
			$response = $this->transactionService->topUp($request);
			$data = json_decode($response->getBody())->data;

			return $this->success(['data' => $data]);
		} catch (RequestException $err) {

			return $this->serverError(['message' => $err->getMessage()]);
		}
	}

	public function status(Request $request)
	{
		$validator = Validator::make(
			$request->only(['ref_id']),
			[
				'ref_id' => ['required']
			]
		);

		if ($validator->fails()) return $this->badRequest(['message' => $validator->errors()->all()]);
		try {
			$response = $this->transactionService->status($request);
			$data = json_decode($response->getBody())->data;

			return $this->success(['data' => $data]);
		} catch (RequestException $err) {

			return $this->serverError(['message' => $err->getMessage()]);
		}
	}
}
