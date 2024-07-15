<?php
use App\Http\Controllers\admincontroller;
use Illuminate\Support\Facades\Route;
use App\Models\car_product;




Route::fallback(function () {
    return response()->view('404', [], 404);
});

Route::get('/', function () {
    return redirect('/login');
});

//Route::get('/about', [admincontroller::class, 'about'])->name('about');
//Route::get('/searchs', [admincontroller::class, 'searchs'])->name('searchs');



Route::group(['middleware' => 'auth'], function () {

    Route::get('/car/{id}', [admincontroller::class, 'show'])->name('show');
    Route::get('create', [admincontroller::class, 'create']);
    Route::post('insert', [admincontroller::class, 'insert'])->name('insert');
    Route::post('delete/{id}', [admincontroller::class, 'delete'])->name('delete');
    Route::get('edit/{id}', [admincontroller::class, 'edit'])->name('edit');
    Route::post('update/{id}', [admincontroller::class, 'update'])->name('update');
    Route::post('/search', [admincontroller::class, 'search'])->name('search');
    Route::get('/home', [admincontroller::class, 'index'])->name('home');

    
});
Auth::routes();

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');