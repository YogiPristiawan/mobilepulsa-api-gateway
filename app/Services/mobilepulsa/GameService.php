<?php

namespace App\Services\MobilePulsa;

use Illuminate\Http\Request;
use App\Exceptions\BadRequestException;
use App\Services\BaseService;
use App\Traits\RequestService;

class GameService extends BaseService
{
	use RequestService;

	public function __construct()
	{
		parent::__construct();
	}

	public function checkId(Request $request)
	{
		$game_code = $request->input('game_code');
		$hp = $request->input('hp');

		$sign = md5($this->username . $this->apiKey . $game_code);

		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'check-game-id',
				'username' => $this->username,
				'game_code' => $game_code,
				'hp' 		=> $hp,
				'sign' 		=> $sign
			]
		]);

		$data = json_decode($response->getBody())->data;

		if (isset($data->rc)) {
			if (!in_array($data->rc, $this->notFailedResponse)) throw new BadRequestException($data->message);
		}

		return $data;
	}

	public function serverList(Request $request)
	{
		$game_code = $request->input('game_code');

		$sign = md5($this->username . $this->apiKey . $game_code);

		$response = $this->post($this->base_uri, [
			'json' => [
				'commands' => 'game-server-list',
				'username' => $this->username,
				'game_code' => $game_code,
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
