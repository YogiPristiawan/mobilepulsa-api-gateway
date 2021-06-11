<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseService;
use App\Service\ProductService;

class ProductController extends Controller
{
	use ResponseService;

	protected $productService;

	public function __construct(ProductService $productService)
	{
		$this->productService = $productService;
	}

	public function data(Request $request)
	{
		$response = $this->productService->data($request);
		$data = json_decode($response->getBody())->data;
		return $this->success(['data' => $data]);
	}
}
