<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;


class TransactionController extends Controller
{
	public function balance()
	{
		// try{
			$client = new Client(['base_uri' => config('mobilepulsa.prepaidUrl')]);
			$response = $client->request('POST','',[
				'json' => [
					'commands' => 'balance',
					'username' => '08813896779',
					'sign' => 'db1d14ff171dfcafb18311831bcd62fc'
				]
			]);
			
			var_dump($response->getStatusCode());
			die;
			$body = $response->getBody();
			// var_dump(json_decode($body)->data);
			// die;
			return response()->json([
				'status' => [
					'code' => 200,
					'message' => 'Success'
				],
				'data' => json_decode($body)
			], 200);
		// }catch(ClientException $e){
		// 	$error = json_decode($e->getResponse()->getBody()->getContents());
		// 	return response()->json([
		// 		'status' => [
		// 			'code' => $error->data->rc,
		// 			'message' => $error->data->message
		// 		]
		// 	], $error->data->rc);
			
		// }
	}
		
}

