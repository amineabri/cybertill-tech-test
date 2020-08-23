<?php

/** @var Router $router */

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

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laravel\Lumen\Application;
use Laravel\Lumen\Routing\Router;

/**
 * @return RedirectResponse
 */
$router->get( '/', function () {
    return redirect()->to('/view-log/without-pagination');
});

/**
 * @return View|Application
 */
$router->get('/view-log/without-pagination', function ()  {
    return view('logs.without-pagination');
});

/**
 * @return View|Application
 */
$router->get( '/view-log/with-pagination', function ()  {
    return view('logs.with-pagination');
});

// web-based API documentation
$router->get('api/v1/documentation', [
    'as'    => 'api.documentation',
    'uses'  => 'ApiDocumentationController@index'
]);
