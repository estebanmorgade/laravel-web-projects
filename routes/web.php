<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;
//use Illuminate\Support\Facades\Route;

/*DB::listen(function($query){
    var_dump($query->sql);
});*/ //ESTO ES PARA DEBUGGEAR LAS CONSULTAS QUE SE GENERAN EN EL TODO EL PROYECTO
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

Route::get('/', function(){
    return view('home');
})->name('home');

/*Route::get('saludos/{nombre?}', function ($nombre = 'Invitado'){
    return "Saludos " . $nombre;
});*/


Route::view('/about', 'about')->name('about');

/*
Route::get('/portfolio', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/portfolio/crear', [ProjectController::class, 'create'])->name('projects.create');
Route::get('/portfolio/{project}/editar', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/portfolio/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::post('/portfolio', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/portfolio/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::delete('/portfolio/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
*/
// FORMA DE HACERLO CON ROUTE resource para simplificar todo

Route::resource('portafolio', ProjectController::class)
->names('projects')->parameters(['portafolio' => 'project']);

Route::get('/portafolio/{project}/show-deleted', [ProjectController::class, 'showDeleted'])
->name('projects.show-deleted');

Route::patch('/portafolio/{project}/restore', [ProjectController::class, 'restore'])
->name('projects.restore');
Route::delete('/portafolio/{project}/force-delete', [ProjectController::class, 'forceDelete'])
->name('projects.force-delete');

Route::resource('categorias', CategoryController::class)
->names('categories')->parameters(['categorias' => 'category']);

Route::view('/contact', 'contact')->name('contact');
Route::post('contact', [MessageController::class, 'store']);

Auth::routes();
