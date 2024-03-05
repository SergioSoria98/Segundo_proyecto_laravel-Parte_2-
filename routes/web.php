<?php

use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LoginController;
use App\Models\User;
use App\Http\Controllers\UsersController;
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


/*
App\Models\User::create([
    'name' => 'Moderador',
    'email' => 'moderador@gmail.com',
    'password' => bcrypt('Sergio123'),
    'role' => 'moderador',
]);
*/

Route::get('roles', function(){
    return Role::with('user')->get();
});

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('saludos/{nombre?}', [PagesController::class, 'saludo'])->name('saludos')->where('nombre', "[A-Za-z]+");


Route::resource('mensajes', MessagesController::class);
Route::resource('usuarios', UsersController::class);



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');