<?php
return config([
	'mobilepulsa' => [
		'username' => env('MOBILE_PULSA_USERNAME'),
		'apiKey' => env('MOBILE_PULSA_APIKEY'),
		'prepaidUrl' => env('MOBILE_PULSA_PREPAID_URL')
	]
]);
