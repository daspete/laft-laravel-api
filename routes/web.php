<?php
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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



// Authentication route
Route::post('authenticate', 'AuthJWTController@authenticate');
Route::post('logout', 'AuthJWTController@logout');

// API route group that we need to protect
Route::group(['prefix' => 'api', 'middleware' => ['ability:admin,create-users,true']], function(){

    Route::get('users', 'ApiController@users');

});





// // Route to create a new role
// Route::post('role', 'AuthJWTController@createRole');

// // Route to create a new permission
// Route::post('permission', 'AuthJWTController@createPermission');

// // Route to assign role to user
// Route::post('attach-role', 'AuthJWTController@attachRole');

// // Route to attache permission to a role
// Route::post('attach-permission', 'AuthJWTController@attachPermission');

















/*

Route::group(['middleware' => []], function(){

    Route::post('auth/login', 'ApiController@login');


    Route::group(['middleware' => ['jwt.auth']], function(){

        Route::get('user', 'ApiController@getAuthUser');

    });

});
*/















/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

// Route::post('/login', function(Request $req){
//     if($req->input('username') == 'demo' && $req->input('password') == 'demo'){
//         session()->put('authUser', json_encode(array(
//             'username' => 'demo'
//         )));

//         return response()->json(array(
//             'authUser' => 'demo'
//         ), 200);
//     }

//     return response()->json(array(
//         'message' => 'Bad credentials'
//     ), 401);
// });

// Route::post('/logout', function(Request $req){
//     //session()->forget('authUser');
//     session()->flush();

//     return response()->json(array(
//         'success' => true
//     ), 200);
// });

// Route::get('/auth', function(Request $req){

//     if(!session()->get('authUser')){
//         return response()->json(array(
//             'message' => 'no sesssion'
//         ), 401);
//     }

//     return response()->json(session()->get('authUser'));
// });