<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllCandidatesController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcelController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Candidates routes
    Route::get('/all_candidates', function () {
        return view('all_candidates', ['candidates' => \App\Models\AllCandidate::all()]);
    })->name('all_candidates');

    Route::get('/edit/{id}', [AllCandidatesController::class, 'editID'])->name('edit');
    Route::get('/show/{id}', [AllCandidatesController::class, 'show'])->name('show');
    Route::put('/update/{id}', [AllCandidatesController::class, 'updateCandidate'])->name('update');
    Route::get('/delete/{id}', [AllCandidatesController::class, 'deleteID'])->name('delete');

    // Interview routes
    Route::prefix('interviews')->name('interviews.')->group(function () {
        Route::get('/create', [InterviewController::class, 'create'])->name('create');
        Route::post('/store', [InterviewController::class, 'store'])->name('store');
        Route::get('/upcoming', [InterviewController::class, 'upcoming'])->name('upcoming');
        Route::get('/completed', [InterviewController::class, 'completed'])->name('completed');
        Route::get('/download-phones', [InterviewController::class, 'downloadPhones'])->name('download-phones');
        Route::post('/{id}/cancel', [InterviewController::class, 'cancel'])->name('cancel');
    });

    // Candidate status routes
    Route::prefix('candidates')->name('candidates.')->group(function () {
        Route::get('/hired', [StatusController::class, 'hired'])->name('hired');
        Route::get('/rejected', [StatusController::class, 'rejected'])->name('rejected');
        Route::get('/passed', [StatusController::class, 'passed'])->name('passed');
        Route::post('/{id}/mark-passed', [StatusController::class, 'markAsPassed'])->name('mark-passed');
        Route::post('/{id}/mark-rejected', [StatusController::class, 'markAsRejected'])->name('mark-rejected');
        Route::post('/{id}/mark-hired', [StatusController::class, 'markAsHired'])->name('mark-hired');
    });

    // Excel upload routes (Staff and Admin only)
    Route::middleware(['role:Admin,Staff'])->group(function () {
        Route::get('/excel/upload', [ExcelController::class, 'showUploadForm'])->name('excel.upload');
        Route::post('/excel/import', [ExcelController::class, 'import'])->name('excel.import');
        Route::get('/excel/template', [ExcelController::class, 'downloadTemplate'])->name('excel.template');
    });
});