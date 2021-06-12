<?php

namespace App\Traits;

trait ResponseService
{
	public function success(array $response = [])
	{
		$response['message'] = $response['message'] ?? 'Success';
		if (isset($data['data'])) $response['data'] = $response['data'];

		return response()->json($response, 200);
	}

	public function created(array $response = [])
	{
		$response['message'] = $response['message'] ?? 'Created';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 201);
	}

	public function badRequest(array $response = [])
	{
		$response['message'] = $response['message'] ?? 'Bad Request';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 400);
	}

	public function unauthorized(array $response = [])
	{
		$response['message'] = $response['message'] ?? 'Unauthorized';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 401);
	}

	public function notFound(array $response = [])
	{
		$response['message'] = $response['message'] ?? 'Unauthorized';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 404);
	}

	public function serverError(array $response = [])
	{
		$response['message'] = $response['message'] ?? 'Server Error';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 500);
	}
}
