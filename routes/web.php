<?php
	
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Session;
	use App\Http\Controllers\UrlsController;
	use App\Http\Controllers\ProfileController;
	use Illuminate\Support\Facades\Route;
	
	
	// dd(__FILE__.__LINE__);
	
	
	Route::get('/', function () {
		return view('top');
	});
	// Route::get('/', function () {
	// 	redirect()->intended(route('index', absolute: false));
	// })->middleware('auth');
	Route::middleware([
		                  'auth',
		                  'verified',
	                  ])
	     ->group(function () {
		     Route::get('/index', [
			     UrlsController::class,
			     'index',
		     ])
		          ->name('index')
		     ;
		     Route::get('/show/{id}', [
			     UrlsController::class,
			     'show',
		     ]);
		     Route::get('/create', [
			     UrlsController::class,
			     'create',
		     ]);
				 Route::post('/insert',[UrlsController::class,'insert']);
		     Route::post('/store', [
			     UrlsController::class,
			     'store',
		     ]);
		     Route::post('/delete/{id}', [
			     UrlsController::class,
			     'delete',
		     ]);
		     Route::get('/login', function () {
			     return view('auth.login');
		     });
		     Route::get('/logout', function () {
			     Auth::logout();
			     return redirect('/');
		     });
	     })
	;
	Route::get('/{hash}', [
		UrlsController::class,
		'redirect',
	]);
	
	
	Route::group(['middleware' => 'guest'], function () {
	
	});
	// Route::get('/', function () {
	//     return view('welcome');
	// });
	// Route::get('/index', [UrlsController::class, '/index'])->middleware(['auth', 'verified'])->name('index');
	//
	Route::middleware('auth')
	     ->group(function () {
		     Route::get('/profile', [
			     ProfileController::class,
			     'edit',
		     ])
		          ->name('profile.edit')
		     ;
		     Route::patch('/profile', [
			     ProfileController::class,
			     'update',
		     ])
		          ->name('profile.update')
		     ;
		     Route::delete('/profile', [
			     ProfileController::class,
			     'destroy',
		     ])
		          ->name('profile.destroy')
		     ;
	     })
	;
	
	require __DIR__ . '/auth.php';
