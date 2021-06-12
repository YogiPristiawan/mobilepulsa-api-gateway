<?php

$router->group(['prefix' => 'pln', 'middleware' => 'auth'], function () use ($router) {
	$router->group(['prefix' => 'subscriber'], function () use ($router) {
		$router->post('check', 'PlnController@subscriberCheck');
	});
});
