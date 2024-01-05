<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Address;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Create user first on the database in order for this to function
Route::get('/insert/{id}/{addr}', function($id, $addr) {

    $user = User::findOrFail($id);

    $address = new Address(['name'=>$addr]);
    $result = $user->address()->save($address);
    return $result ? true : false;

});