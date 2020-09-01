<?php

use App\ProductDetailTable;
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

//api routes
Route::post('login/authenticate',"AuthController@login");
Route::post('user/register',"AuthController@signup");
Route::post('logout',"AuthController@logout");
Route::post('kit/{url}/product/create',"ProductController@createProduct");
Route::post('kit/{url}/product/save',"ProductController@saveProductInfo");
Route::post('kit/{url}/product/delete',"ProductController@deleteProduct");
Route::post('kit/{url}/product/get',"ProductController@getProducts");
Route::post('kit/{url}/product/files/save',"ProductController@saveFile");
Route::post('poll/save',"HomeController@savePoll");

Route::post('kit/{url}/company/get',"CompanyController@index");

Route::get('/', function () {
    return view('welcome');
});

Route::get('/copy-urls/{url}', function ($url) {
    return view('copy-screen')->with(['url' => $url]);
});

Route::get('/show-poll/{url}', function ($url) {
    $poll = \App\Poll::where('id', base64_decode($url))->first();
    $answers = \App\PollAnswers::where('id_poll', $poll->id)->get();
    return view('show-screen')->with(['poll' => $poll, 'answers' => $answers]);
});
Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/signup', function () {
    return view('auth/signup');
})->middleware('checkAuth');
Route::get('new-product', "ProductController@newProduct");
Route::get('profile', "ProductController@getProfileAndProducts");
Route::post('products/save', "ProductController@saveProductInfo");
Route::get('edit/product/{productId}', "ProductController@editProductInfo");
Route::get('product/{productId}/details', "ProductController@detailProductInfo");
Route::post('logo/update', "ProductController@updateLogo");
Route::post('products/details/save', "ProductController@saveProductDetails");
Route::get('get/tagsData/{productId}', "ProductController@getTags");
Route::get('get/platforms/{productId}', "ProductController@getPlatforms");
Route::get('get/funding/{productId}', "ProductController@getFunding");
Route::get('get/business/model/{productId}', "ProductController@getBusiness");
