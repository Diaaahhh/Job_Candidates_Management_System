<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllCandidatesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/all_candidates', function () {
    return view('all_candidates', ['candidates' => \App\Models\AllCandidate::all()]);
});

Route::put('/edit/{id}', [AllCandidatesController::class, 'editID'])->name('edit');

Route::get('/delete/{id}', [AllCandidatesController::class, 'deleteID'])->name('delete');