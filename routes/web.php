<?php

Route::get('/', function () {
    return redirect()->route('media.index');
});

Route::resource('media', 'MediaController', ['only' => ['store', 'index']]);
