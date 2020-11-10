<?php

use Illuminate\Support\Facades\Route;
use App\Http\Api\Controllers\PostController;

Route::resource('posts', PostController::class);

