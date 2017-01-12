<?php

namespace RedCrown\Http\Controllers;

class MediaController extends Controller
{
    public function store()
    {
        dd(request()->all());
    }
}
