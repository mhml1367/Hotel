<?php


// Route::get('/', function () {
//     return view('hotel');
// });


Route::get ('/'   , 'indexController@index')->name('index'); 
Route::POST('reserve/'   , 'indexController@reserve')->name('post.hotels.reserve'); 
Route::get ('/confirmation'   , 'indexController@confirmation')->name('hotels.confirmation'); 
