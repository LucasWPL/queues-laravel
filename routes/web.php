<?php

use App\Jobs\RandomImage;
use GuzzleHttp\Client;
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

Route::get('/proccess', function () {
    // $fileManager = new App\Models\FileManager();
    // $fileManager->saveRandomPhoto();
    RandomImage::dispatch()->delay(now()->addSecond(1));
});
