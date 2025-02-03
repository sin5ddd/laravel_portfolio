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
	Route::get('/create', [
		\App\Http\Controllers\UrlsController::class,
		'create',
	]);
	Route::post('/store', [
		\App\Http\Controllers\UrlsController::class,
		'store',
	]);
	Route::post('/delete/{id}', [
		\App\Http\Controllers\UrlsController::class,
		'delete',
	]);
	Route::get('/{hash}',[
		\App\Http\Controllers\UrlsController::class,
		'redirect',
	]);