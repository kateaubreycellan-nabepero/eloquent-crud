<?php

use Illuminate\Support\Facades\Route;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Staff;

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

function evaluate($result)
{
    return $result ? true : false;
}

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create/{id}', function($id) {

    $staff = Staff::findOrFail($id);
    $result = $staff->photos()->create(['path'=>'example.jpg']);
    return evaluate($result);

});