<?php

use Illuminate\Support\Facades\Route;


Route::get('/stores', [\App\Http\Controllers\Api\ApiController::class, 'index']);
