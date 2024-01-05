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


Route::get('/create/{id}/{photo_name}', function($id, $photo_name) {

    $staff = Staff::findOrFail($id);
    $result = $staff->photos()->create(['path'=>$photo_name]);
    return evaluate($result);

});

Route::get('/read/{id}', function($id) {

    $staff = Staff::findOrFail($id);

    foreach ($staff->photos as $photo)
    {
        return $photo->path;
    }

});

Route::get('/update/{id}/{name}', function($id, $name) {

    $staff = Staff::findOrFail($id);

    $photo = $staff->photos()->where('id', $id)->first();
    $photo->path = $name;
    $result = $photo->save();
    return evaluate($result);

});

Route::get('/delete/{id}/{photo_id}', function($id, $photo_id) {

    $staff = Staff::findOrFail($id);

    $result = $staff->photos()->where('id', $photo_id)->delete();
    return evaluate($result);

});


Route::get('/assign/{staff_id}/{photo_id}', function($staff_id, $photo_id) {

    $staff = Staff::findOrFail($staff_id);
    $photo = Photo::findorFail($photo_id);

    $result = $staff->photos()->save($photo);
    return evaluate($result);

});

Route::get('/unassign/{staff_id}/{photo_id}', function($staff_id, $photo_id) {

    $staff = Staff::findOrFail($staff_id);
    // $photo = Photo::findorFail($photo_id);

    $result = $staff->photos()->whereId($photo_id)->update(['imageable_id'=>0, 'imageable_type'=>'']);
    return evaluate($result);

});