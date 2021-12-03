<?php


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
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('admin/songs/new', 'AdminController@newSongs')->middleware(checkauth::class);
Route::get('admin/songs', 'AdminController@songs')->middleware(checkauth::class);
Route::get('admin/users/update/{id}', 'AdminController@userUpdate')->name('admin.userUpdate')->middleware(checkauth::class);

Route::get('admin/users', 'AdminController@users')->middleware(checkauth::class);

Route::get('admin/complaints/update/{id}', 'AdminController@updateComplaint')->name('admin.updateComplaint')->middleware(checkauth::class);
Route::get('admin/complaints/new', 'AdminController@newComplaints')->middleware(checkauth::class);
Route::get('admin/complaints', 'AdminController@complaints')->middleware(checkauth::class);

Route::resource('category', 'CategoriesController');
Route::resource('songs', 'SongsController');
Route::resource('complaints', 'ComplaintsController');
Route::resource('admin', 'AdminController')->middleware(checkauth::class);


Route::post('songs/search', 'SongsController@search');
Route::post('complaint', 'AdminController@updateComplaint');


//Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/complaints/{id}', 'ComplaintsController@index');
//Route::get('/songs/search', 'SongsController@search');
