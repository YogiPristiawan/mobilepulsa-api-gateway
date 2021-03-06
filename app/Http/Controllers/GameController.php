<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\BadRequestException;
use App\Traits\ResponseService;
use App\Services\MobilePulsa\GameService;
use GuzzleHttp\Exception\RequestException;

class GameController extends Controller
{
	use ResponseService;

	protected $gameService;

	public function __construct(GameService $gameService)
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->gameService = $gameService;
	}

	public function checkId(Request $request)
	{
		$validator = Validator::make(
			$request->only(['game_code', 'hp']),
			[
				'game_code' => ['required'],
				'hp'		=> ['required']
			]
		);

		if ($validator->fails()) return $this->badRequest(['message' => $validator->errors()->all()]);

		try {
			$response = $this->gameService->checkId($request);

			return $this->success(['data' => $response]);
		} catch (RequestException $err) {

			return response()->json(['message' => $err->getMessage()], $err->getResponse()->getStatusCode());
		} catch (BadRequestException $err) {

			return $this->badRequest(['message' => $err->getMessage()]);
		}
	}

	public function serverList(Request $request)
	{
		$validator = Validator::make(
			$request->only(['game_code']),
			[
				'game_code' => ['required']
			]
		);

		if ($validator->fails()) return $this->badRequest(['message' => 'Game code is required.']);

		try {
			$response = $this->gameService->serverList($request);

			return $this->success(['data' => $response]);
		} catch (RequestException $err) {

			return response()->json(['message' => $err->getMessage()], $err->getResponse()->getStatusCode());
		} catch (BadRequestException $err) {

			return $this->badRequest(['message' => $err->getMessage()]);
		}
	}
}
