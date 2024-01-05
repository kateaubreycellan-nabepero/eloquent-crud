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

Route::get('/read/{id}', function($id) {

    $user = User::findOrFail($id);

    return $user->roles;

});

Route::get('/update/{id}', function($id) {

    $user = User::findOrFail($id);

    if ($user->has('roles'))
    {
        foreach ($user->roles as $role)
        {
            if ($role->name == 'Administrators')
            {
                $role->name = "Some random role";
                $result = $role->save();
                return $result ? true : false;
            }
        }
    }
    return false;

});

Route::get('/delete/{id}/{role_id}', function($id, $role_id) {

    $user = User::findOrFail($id);

    // $result = $user->roles()->delete();

    foreach ($user->roles as $role)
    {
        $result = $role->where('id', $role_id)->delete();
        return $result ? true : false;
    }
    return false;

});
