<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use App\Exceptions\BadRequestException;
use App\Traits\ResponseService;
use App\Services\MobilePulsa\ProductService;

class ProductController extends Controller
{
	use ResponseService;

	protected $productService;

	public function __construct(ProductService $productService)
	{
		$this->productService = $productService;
	}

	public function priceList(Request $request)
	{
		try {
			$response = $this->productService->priceList($request);

			return $this->success(['data' => ['count' => count($response), 'results' => $response]]);
		} catch (RequestException $err) {

			return response()->json(['message' => $err->getMessage()], $err->getResponse()->getStatusCode());
		} catch (BadRequestException $err) {

			return $this->badRequest(['message' => $err->getMessage()]);
		}
	}
}
