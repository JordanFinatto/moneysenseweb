<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicoController;
use App\Http\Controllers\OrientadorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//TOPICOS --------------------------------------------------------------------------------------------------------------------------------

Route::get('/topico', function ()
{
    return view('topico/listagem', ['topicos' => \App\Models\Topico::findAll()]);
})->middleware(['auth', 'verified'])->name('topico.listagem');

Route::get('/topico/adicionar', function ()
{
    return view('topico/edit', ['orientadores' => \App\Models\Topico::getOrientadoresAtivos()]);
})->middleware(['auth', 'verified'])->name('topico.adicionar');

Route::get('/topico/editar/{id}', function ()
{
    $id = request()->route()->parameter('id');
    return view('topico/edit', ['topico' => \App\Models\Topico::findOneById($id), 'orientadores' => \App\Models\Topico::getOrientadoresAtivos()]);
})->middleware(['auth', 'verified'])->name('topico.editar');

Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::post('/topico', [TopicoController::class, 'create'])->name('topico.create');
    Route::patch('/topico', [TopicoController::class, 'update'])->name('topico.update');
});

//ORIENTADORES --------------------------------------------------------------------------------------------------------------------------------

Route::get('/orientador', function ()
{
    return view('orientador/listagem', ['orientadores' => \App\Models\Orientador::findAll()]);
})->middleware(['auth', 'verified'])->name('orientador.listagem');

Route::get('/orientador/adicionar', function ()
{
    return view('orientador/edit', ['cidades' => \App\Models\Cidade::findAll()]);
})->middleware(['auth', 'verified'])->name('orientador.adicionar');

Route::get('/orientador/editar/{id}', function ()
{
    $id = request()->route()->parameter('id');
    return view('orientador/edit', ['orientador' => \App\Models\Orientador::findOneById($id), 'cidades' => \App\Models\Cidade::findAll()]);
})->middleware(['auth', 'verified'])->name('orientador.editar');

Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::post('/orientador', [OrientadorController::class, 'create'])->name('orientador.create');
    Route::patch('/orientador', [OrientadorController::class, 'update'])->name('orientador.update');
});

require __DIR__ . '/auth.php';
