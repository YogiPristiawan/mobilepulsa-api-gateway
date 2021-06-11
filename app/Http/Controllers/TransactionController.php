<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use App\Service\TransactionService;
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
}
