<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function (Request $request) {
    return ['name' => 'John Doe', 'email' => 'johndoe@example.com'];
});
