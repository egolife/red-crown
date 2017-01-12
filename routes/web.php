<?php

Route::get('/', function () {
    return view('home')->with([
        'images' => collect()
    ]);
});

Route::resource('media', 'MediaController', ['only' => ['store']]);
