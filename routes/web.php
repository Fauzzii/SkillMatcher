<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\UserEducationsController;
use App\Models\Applications;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/skills', [SkillsController::class, 'store'])->name('skills.store');
    Route::delete('/skills/{id}', [SkillsController::class, 'destroy'])->name('skills.destroy');
    Route::post('/educations', [UserEducationsController::class, 'store'])->name('educations.store');
    Route::delete('/educations/{id}', [UserEducationsController::class, 'destroy'])->name('educations.destroy');
    Route::post('/resume', [AuthController::class, 'storeResume'])->name('resume.store');
    Route::post('/companies', [CompaniesController::class, 'store'])->name('companies.store');
    Route::put('/company/{id}', [CompaniesController::class, 'update'])->name('companies.update');
    Route::post('/jobsadd', [JobsController::class, 'store'])->name('jobs.store');
    Route::delete('/jobsdelete/{id}', [JobsController::class, 'destroy'])->name('jobs.destroy');
    Route::put('/jobsEdit/{id}', [JobsController::class, 'update'])->name('jobs.update');
    Route::get('/jobs/{id}/applicants', [JobsController::class, 'viewApplicants'])->name('jobs.applicants');
    Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{id}', [JobsController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{id}/apply', [ApplicationsController::class, 'store'])->name('jobs.apply');
    Route::patch('/applications/{id}/update-status', [ApplicationsController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::get('/chatbot', function () {
        return view('chatbot');
    })->name('chatbot.show');
    Route::post('/chatbot/consult', [ChatbotController::class, 'consult'])->name('chatbot.consult');
    Route::get('/cek-model', function () {
        $apiKey = config('services.gemini.key');

        $response = Http::withoutVerifying()
            ->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

        return $response->json();
    });
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
