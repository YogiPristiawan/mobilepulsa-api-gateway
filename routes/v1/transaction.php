<?php

$router->group(['prefix' => 'transaction', 'middleware' => 'auth'], function () use ($router) {
	$router->get('balance', 'TransactionController@balance');
	$router->post('top-up', 'TransactionController@topUp');
	$router->post('status', 'TransactionController@status');
});
