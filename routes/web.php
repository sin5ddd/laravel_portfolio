<?php
	
	use Illuminate\Support\Facades\Route;
	
	Route::get('/', [
		\App\Http\Controllers\UrlsController::class,
		'index',
	]);
	Route::get('/show/{id}', [
		\App\Http\Controllers\UrlsController::class,
		'show',
	]);