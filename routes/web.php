<?php

use App\Http\Controllers\ApiHeroController;
use App\Http\Controllers\HeroController;
use Illuminate\Support\Facades\Route;

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

Route::controller(HeroController::class)->group(function () {
    Route::get('/', 'index')->name('heroes.index');
    Route::get('/heroes/create', 'create')->name('heroes.create');
    Route::post('/heroes', 'store')->name('heroes.store');
    Route::get('/heroes/{hero}', 'show')->name('heroes.show');
    Route::delete('/heroes/{hero}', 'destroy')->name('heroes.destroy');

    Route::post('/heroes/api', 'storeApiHero')->name('store.api.hero');
});

//Route::get('/heroes/api', [ApiHeroController::class, 'getHero'])->name('store.api.hero');
