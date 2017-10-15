<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'middleware' => ['auth:api', 'hasTeam']
], function () {
    Route::get('lists', 'ListController@index');
    Route::post('lists', 'ListController@store');

    Route::post('lists/{cardList}/cards', 'CardController@store');
    Route::get('lists/{cardList}/cards/{card}', 'CardController@show');

    Route::post('lists/{cardList}/cards/{card}/comments', 'CommentController@store');
});
