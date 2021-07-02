<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\ForgotPasswordController;
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
    $api->post('password/email', [ForgotPasswordController::class, 'forgot']);
    $api->post('password/reset', [ForgotPasswordController::class, 'reset']);

    $api->group(['middleware' => 'api.auth|api'], function ($api) {
        $api->get('companies/{company}', [\App\Http\Controllers\v1\CompanyController::class, 'show']);
        $api->group(['middleware' => 'role:admin'], function ($api) {
            $api->post('register', [AuthController::class, 'register']);

            $api->group(['prefix' => 'users'], function ($api) {
                $api->get('/', [UserController::class, 'index']);
                $api->put('/{user}', [UserController::class, 'update']);
                $api->delete('/{user}', [UserController::class, 'destroy']);
            });
        });

        $api->get('profile', [UserController::class, 'profile']);
        $api->get('logout', [AuthController::class, 'logout']);
    });

});
