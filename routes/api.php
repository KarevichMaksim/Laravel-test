<?php

use App\Http\Controllers\v1\AuthController;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function ($api) {

    $api->post('login', [AuthController::class, 'login']);

    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->get('profile', [AuthController::class, 'profile']);
        $api->post('register', [AuthController::class, 'register']);
        $api->get('logout', [AuthController::class, 'logout']);
    });

});
