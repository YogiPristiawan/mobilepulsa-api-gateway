<?php

namespace App\Service;

use App\Traits\RequestService;

class TransactionService
{
	use RequestService;

	protected $base_uri;

	public function __construct()
	{
		$this->base_uri = config('mobilepulsa.prepaidUrl');
	}

	public function balance()
	{
	}
}
