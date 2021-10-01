<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/', [App\Http\Controllers\Mail\FeedbackController::class, 'send'])->name('sendFeedback');

//Auth::routes();

//Точки доступа к авторизации на сайте
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Точки доступа к регистрации на сайте
Route::get('register', [App\Http\Controllers\Auth\RegisterCadastrEnginerController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterCadastrEnginerController::class, 'register']);
//Точки доступа к регистрации для клиента на сайте
Route::post('/reg-with-order/{type}', [App\Http\Controllers\Auth\RegisterClientController::class, 'register'])->name('register-order');
//Точки доступа к регистрации для клиента на сайте
Route::post('/login-with-order/{type}', [App\Http\Controllers\Auth\LoginwithorderController::class, 'login'])->name('login-order');
// Показ ссылки Восстановить пароль
Route::get('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'update'])->name('password.update');

Route::group(['middleware' => 'role:admin'], function() {
   Route::get('/admin', [App\Http\Controllers\AdminController::class, 'showIndex'])->name('admin');
   Route::get('/admin/finances', [App\Http\Controllers\AdminController::class, 'showFinance'])->name('admin.finance');
   Route::get('/admin/orders/{type}', [App\Http\Controllers\AdminController::class, 'showOrders'])->name('admin.orders');
   Route::get('/admin/price/{type}', [App\Http\Controllers\AdminController::class, 'showPrice'])->name('admin.price');
   Route::post('/admin/price/{type}', [App\Http\Controllers\AdminController::class, 'updatePrice'])->name('admin.updateprice');
   Route::get('/admin/order/{id}', [App\Http\Controllers\AdminController::class, 'showOrder'])->name('admin.order');
   Route::get('/admin/calculator/{type}/{region}', [App\Http\Controllers\AdminController::class, 'showCalc'])->name('admin.showcalc');
   Route::get('/admin/app', [App\Http\Controllers\AdminController::class, 'showApp'])->name('admin.app');
   Route::post('/admin/app', [App\Http\Controllers\AdminController::class, 'addApp'])->name('admin.addapp');
});

Route::group(['middleware' => 'role:ki'], function() {
   Route::get('/ki', [App\Http\Controllers\KiController::class, 'showIndex'])->name('ki');
   Route::post('/ki', [App\Http\Controllers\KiController::class, 'saveBio'])->name('ki.savebio');
   Route::get('/ki/personality', [App\Http\Controllers\KiController::class, 'showPersonality'])->name('ki.personality');
   Route::post('/ki/personality', [App\Http\Controllers\KiController::class, 'updateBio']);
   Route::get('/ki/orders/{type}', [App\Http\Controllers\KiController::class, 'showOrders'])->name('ki.orders');
   Route::get('/ki/myorders', [App\Http\Controllers\KiController::class, 'showMyOrders'])->name('ki.myorders');
   Route::post('/ki/myorders', [App\Http\Controllers\KiController::class, 'addMyOrders'])->name('ki.addmyorders');
   Route::get('/ki/myorders/{id}', [App\Http\Controllers\KiController::class, 'showMyOrder'])->name('ki.myorder');
   Route::post('/ki/myorders/{id}/act', [App\Http\Controllers\KiController::class, 'makeAct'])->name('ki.makeAct');
   Route::post('/ki/myorders/{id}/quote', [App\Http\Controllers\KiController::class, 'createQuote'])->name('ki.createquote');
   Route::post('/ki/myorders/{id}/refuse', [App\Http\Controllers\KiController::class, 'createRefuse'])->name('ki.createrefuse');
   Route::post('/ki/myorders/{id}/doc', [App\Http\Controllers\KiController::class, 'LoadDoc'])->name('ki.loaddoc');
   Route::post('/ki/myorders/{id}/arivedtoobj', [App\Http\Controllers\KiController::class, 'arivedtoObj'])->name('ki.arivedtoobj');
   Route::post('/ki/myorders/{id}/takepay', [App\Http\Controllers\KiController::class, 'takePay'])->name('ki.takepay');
   Route::post('/ki/myorders/{id}/closeorder', [App\Http\Controllers\KiController::class, 'closeOrder'])->name('ki.closeorder');
   Route::get('/ki/mycloseorders', [App\Http\Controllers\KiController::class, 'showCloseOrders'])->name('ki.mycloseorders');
});

Route::group(['middleware' => 'role:client'], function() {
   Route::get('/lk', [App\Http\Controllers\ClientController::class, 'showIndex'])->name('client');
   Route::get('/lk/personality', [App\Http\Controllers\ClientController::class, 'showPersonality'])->name('personality');
   Route::post('/lk/personality', [App\Http\Controllers\ClientController::class, 'saveBio']);
   Route::get('/lk/pay', [App\Http\Controllers\ClientController::class, 'showPay'])->name('pay');
   Route::get('/lk/documents', [App\Http\Controllers\ClientController::class, 'showDocs'])->name('docs');
});

//Услуги - шаг 1
Route::get('/search-obj/{type}', [App\Http\Controllers\ServicesController::class, 'showSearchobj'])->name('searchobj');
Route::post('/search', [App\Http\Controllers\Ajax\SearchobjController::class, 'rosreestrAPI'])->name('search');
//Уточнение адреса
Route::get('/phonetic-obj/{type}', [App\Http\Controllers\ServicesController::class, 'showPhoeneticobj'])->name('phoneticobj');



//Оформление заказа - шаг 2
Route::get('/order/{type}/{cadnomer}', [App\Http\Controllers\ServicesController::class, 'showOrder'])->name('order');
Route::post('/itogcost', [App\Http\Controllers\Ajax\SearchobjController::class, 'calcItogcost'])->name('itogcost');

//Оформление заказа - шаг 3
Route::post('/realty-data-save', [App\Http\Controllers\Ajax\SearchobjController::class, 'saveRealtydata'])->name('saverealtydata');
Route::post('/geo-data-save', [App\Http\Controllers\Ajax\SearchobjController::class, 'saveGeodata'])->name('savegeodata');
Route::post('/plot-data-save', [App\Http\Controllers\Ajax\SearchobjController::class, 'savePlotdata'])->name('saveplotdata');
Route::get('/reg-with-order/{type}', [App\Http\Controllers\ServicesController::class, 'showRegwithorderform'])->name('formregorder');
