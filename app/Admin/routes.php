<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('product-types', ProductTypeController::class);
    $router->resource('products', ProductController::class);
    $router->resource('view-abouts', AboutController::class);
    $router->resource('view-contacts', ContactController::class);
    $router->resource('lookbook', LookbookController::class);
    $router->resource('broadcasts', BroadcastController::class);
    $router->resource('sizes', SizeController::class);
    $router->resource('text-berjalans', TextBerjalanController::class);
    $router->resource('stockists', StockistController::class);
    $router->resource('shippings', ShippingController::class);
});
