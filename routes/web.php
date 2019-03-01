<?php

use App\User;
use App\Http\Middleware\AuthenticateWithBasicAuth;

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

Route::get('/register', function() {
    return view('register');
});

Route::post('/register', function() {
    $user = new User;
    $user->email = Input::get('email');
    $user->username = Input::get('username');
    $user->password = Hash::make(Input::get('password'));
    $user->save();
    $theEmail = Input::get('email');
    return view('thanks')->with('theEmail',$theEmail);
});

Route::get('/login', function() {
    return view('login');
});

Route::post('/login', function() {
    $credentials = Input::only('username', 'password');
    if(Auth::attempt($credentials) {
      return Redirect::intended('/');
    });
});

Route::get('/logout', function() {
    Auth::logout();
    return view('logout');
});

Route::get('spotlight', array(
  'before' => 'auth',
  function() {
    return view('spotlight');
    }
));
