<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllCandidatesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/all_candidates', function () {
    return view('all_candidates', ['candidates' => \App\Models\AllCandidate::all()]);
})->name('all_candidates');

Route::get('/edit/{id}', [AllCandidatesController::class, 'editID'])->name('edit');

Route::get('/show/{id}', [AllCandidatesController::class, 'show'])->name('show');

Route::put('/update/{id}', [AllCandidatesController::class, 'updateCandidate'])->name('update');

Route::get('/delete/{id}', [AllCandidatesController::class, 'deleteID'])->name('delete');