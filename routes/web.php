<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

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


Route::get('/create/{id}/{role_name}', function($id, $role_name){

    $user = User::findOrFail($id);
    $role = new Role(['name'=>$role_name]);

    $result = $user->roles()->save($role);
    return $result ? true : false;

});