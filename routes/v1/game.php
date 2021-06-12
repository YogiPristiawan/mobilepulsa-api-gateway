<?php

$router->group(['prefix' => 'game', 'middleware' =>  'auth'], function () use ($router) {
	$router->group(['prefix' => 'id'], function () use ($router) {
		$router->post('check', 'GameController@checkId');
	});

	$router->group(['prefix' => 'server'], function () use ($router) {
		$router->post('list', 'GameController@serverList');
	});
});
