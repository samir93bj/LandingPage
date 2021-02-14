<?php

use App\Http\Controllers\SubscriberController;
use App\Models\Subscriber;
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
});


Route::get('/subscribers/verify/{subscriber}',[SubscriberController::class,'verify'])
->middleware('signed') // una vez que el suscriptor de la click al enlace pasa al metodo
->name('subscribers.verify');

require __DIR__.'/auth.php';
