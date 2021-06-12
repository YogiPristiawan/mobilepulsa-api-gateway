<?php

namespace App\Service\MobilePulsa;

use Illuminate\Http\Request;
use App\Traits\RequestService;

class GameService
{
	use RequestService;

	protected $base_uri;
	protected $username;
	protected $apiKey;
	protected $sign;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
		$this->username = config('mobilepulsa.username');
		$this->apiKey = config('mobilepulsa.apiKey');
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

		return $response;
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

		return $response;
	}
}
