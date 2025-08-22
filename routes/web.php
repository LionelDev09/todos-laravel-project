<?php

use App\Http\Controllers\Web\TodoPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoPageController::class, 'index']);