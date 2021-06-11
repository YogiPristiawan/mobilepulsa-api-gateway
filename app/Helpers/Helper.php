<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

class Helper
{
	public static function decodeJwt($jwt)
	{
		$privateKey = env('JWT_SECRET');
		$jwt = preg_replace('/Bearer\s/', '', $jwt);
		$payload = JWT::decode($jwt, $privateKey, ['HS256']);

		return $payload;
	}

	public static function generateJwt(array $data)
	{
		$privateKey = env('JWT_SECRET');
		$jwt = JWT::encode($data, $privateKey, 'HS256');

		return $jwt;
	}
}
