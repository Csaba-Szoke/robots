<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () {
    return redirect()->route('robots.all');
});

$app->get('/overview', [
    'as' => 'robots.all', 'uses' => 'RobotController@all'
]);

$app->group(['prefix' => 'api'], function () use ($app) {
    $app->get('robots',  [
        'as' => 'api.robots.all', 'uses' => 'Api\RobotController@all'
    ]);
    $app->get('robots/search/{name}',  [
        'as' => 'api.robots.search-by-name', 'uses' => 'Api\RobotController@searchByName'
    ]);
    $app->get('robots/filter',  [
        'as' => 'api.robot-types.all', 'uses' => 'Api\RobotTypeController@all'
    ]);
    $app->get('robots/filter/{typeOrStatus}',  [
        'as' => 'api.robots.filter-by-type-or-status', 'uses' => 'Api\RobotController@filterByTypeOrStatus'
    ]);
    $app->get('robots/{id}',  [
        'as' => 'api.robots.get-robot', 'uses' => 'Api\RobotController@getRobot'
    ]);
    $app->post('robots',  [
        'as' => 'api.robots.create', 'uses' => 'Api\RobotController@create'
    ]);
    $app->put('robots/{id}',  [
        'as' => 'api.robots.update', 'uses' => 'Api\RobotController@update'
    ]);
    $app->delete('robots/{id}',  [
        'as' => 'api.robots.delete', 'uses' => 'Api\RobotController@delete'
    ]);
});
