<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptio\Handler;
use GuzzleHttp\Exception\RequestException;
use App\Traits\ResponseService;
use App\Service\MobilePulsa\ProductService;

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
			$data = json_decode($response->getBody())->data;

			return $this->success(['data' => ['count' => count($data), 'results' => $data]]);
		} catch (RequestException $err) {

			return $this->serverError(['message' => $err->getMessage()]);
		}
	}
}
