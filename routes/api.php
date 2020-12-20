<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

#默认配置指定的是v1版本，可以直接通过 {host}/api/version 访问到
//$api->version('v1', function ($api) {
//    $api->get('version', function () {
//        return 'v1';
//    });
//});

#如果v2不是默认版本，需要设置请求头
#Accept: application/[配置项 standardsTree].[配置项 subtype].v2+json
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
],function($api){
    $api->group(
        [
            'middleware' => 'api.throttle',
            'limit' => config('api.rate_limits.sign.limit'),
            'expires' => config('api.rate_limits.sign.expires'),
        ],function($api) {
        // 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')->name('api.users.store');
        }
    );
});
