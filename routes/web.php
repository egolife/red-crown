<?php

Route::get('/', function () {
    return redirect()->route('media.index');
});

Route::get('media/random', 'MediaController@showRandom');
Route::resource('media', 'MediaController', ['only' => ['store', 'index']]);
