<?php

$router->group(['prefix' => 'product', 'middleware' => 'auth'], function () use ($router) {
	$router->get('price-list', 'ProductController@priceList');
});
