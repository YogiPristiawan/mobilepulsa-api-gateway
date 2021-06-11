<?php

$router->group(['prefix' => 'product', 'middleware' => 'auth'], function () use ($router) {
	$router->group(['prefix' => 'data'], function () use ($router) {
		$router->get('price-list', 'ProductController@data');
	});
});
