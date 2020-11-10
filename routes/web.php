<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostViewController;

Route::resource('posts', PostViewController::class);
