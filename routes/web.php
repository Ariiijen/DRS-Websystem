<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('reports.index');
});

Route::resource('reports', ReportController::class)->only(['index', 'create', 'store', 'update']);