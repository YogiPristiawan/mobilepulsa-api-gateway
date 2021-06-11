<?php

$router->group(['prefix' => 'transaction', 'middleware' => 'auth'], function () use ($router) {
	$router->get('balance', 'TransactionController@balance');
});
