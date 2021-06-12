<?php

namespace App\Traits;

trait ResponseService
{
	public function success(array $data = [])
	{
		$response['message'] = $data['message'] ?? 'Success';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 200);
	}

	public function created(array $data = [])
	{
		$response['message'] = $data['message'] ?? 'Created';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 201);
	}

	public function badRequest(array $data = [])
	{
		$response['message'] = $data['message'] ?? 'Bad Request';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 400);
	}

	public function unauthorized(array $data = [])
	{
		$response['message'] = $data['message'] ?? 'Unauthorized';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 401);
	}

	public function notFound(array $data = [])
	{
		$response['message'] = $data['message'] ?? 'Unauthorized';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 404);
	}

	public function serverError(array $data = [])
	{
		$response['message'] = $data['message'] ?? 'Server Error';
		if (isset($data['data'])) $response['data'] = $data['data'];

		return response()->json($response, 500);
	}
}
