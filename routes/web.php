<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\SearchController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::middleware('auth')->group(function (){
    Route::get('/ch/{channel}/edit', [ChannelController::class, 'edit'])->name('channel.edit');

    Route::get('/ch/{channel}/v', \App\Livewire\Video\AllVideos::class)->name('channel.view');
    Route::get('/ch/{channel}/v/create', \App\Livewire\Video\CreateVideo::class)->name('video.create');
    Route::get('/ch/{channel}/v/{video}/edit', \App\Livewire\Video\EditVideo::class)->name('video.edit');

});

Route::get('/watch/{video}', \App\Livewire\Video\WatchVideo::class)->name('video.watch');
Route::get('/ch/{channel}', [ChannelController::class, 'index'])->name('channel.index');
Route::get('/search/', [SearchController::class, 'search'])->name('search');
