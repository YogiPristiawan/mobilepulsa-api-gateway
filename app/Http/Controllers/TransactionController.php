<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TransactionController extends Controller
{
	public function balance()
	{
		try {
			$client = new Client();
			$response = $client->request('POST', config('mobilepulsa.prepaidUrl'), [
				'json' => [
					'commands' => 'balance',
					'username' => '08813896779',
					'sign' => 'db1d14ff171dfcafb18311831bcd62fc'
				]
			]);

			$body = json_decode($response->getBody());

			/**
			 * sebenarnya kondisi ini ngga diperlukan, ini karena API Mobile pulsa ada bug yaitu response code 200 ketika Wrong Auth terjadi.
			 */
			if (isset($body->data->rc)) {
				return response()->json([
					'status' => [
						'code' => 204,
						'message' => 'engga muncul broo'
					]
				], 204);
			} else {
				return response()->json([
					'status' => [
						'code' => 200,
						'message' => 'Success'
					],
					'data' => $body->data
				], 200);
			}
		} catch (ClientException $e) {
			$err_status = json_decode($e->getResponse()->getStatusCode());
			$err_body = json_decode($e->getResponse()->getBody());

			return response()->json([
				'status' => [
					'code' => $e->getResponse()->getStatusCode(),
					'message' => $err_body->data->message
				]
			], $err_status);
		}
	}
}
