<?php
	
	use Illuminate\Support\Facades\Route;
	use App\Http\Controllers\UrlsController;
	
	Route::get('/', [UrlsController::class, 'index',]);
	Route::get('/show/{id}', [UrlsController::class, 'show',]);
	Route::get('/create', [UrlsController::class, 'create',]);
	Route::post('/store', [UrlsController::class, 'store',]);
	Route::post('/delete/{id}', [UrlsController::class, 'delete',]);
	Route::get('/{hash}', [UrlsController::class, 'redirect',]);