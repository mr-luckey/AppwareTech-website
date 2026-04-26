<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TestimonialController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{slug}/apply', [JobController::class, 'apply'])->name('jobs.apply');
Route::get('/services', [FrontendServiceController::class, 'index'])->name('services.index');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{slug}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/jobs/{slug}/apply', [JobController::class, 'apply'])->name('jobs.apply');

// Admin Routes
Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Jobs Management
        Route::resource('jobs', AdminJobController::class);
        
        // Job Applications Management
        Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
        Route::get('/job-applications/{application}', [JobApplicationController::class, 'show'])->name('job-applications.show');
        Route::patch('/job-applications/{application}/status', [JobApplicationController::class, 'updateStatus'])->name('job-applications.update-status');
        Route::delete('/job-applications/{application}', [JobApplicationController::class, 'destroy'])->name('job-applications.destroy');
        Route::post('/job-applications-bulk-delete', [JobApplicationController::class, 'bulkDelete'])->name('job-applications.bulk-delete');
        
        // Courses Management
        Route::resource('courses', AdminCourseController::class);
        Route::post('/courses-bulk-delete', [AdminCourseController::class, 'bulkDelete'])->name('courses.bulk-delete');
        
        // Enrollments Management
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('/enrollments/{enrollment}', [EnrollmentController::class, 'show'])->name('enrollments.show');
        Route::patch('/enrollments/{enrollment}/status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.update-status');
        Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
        Route::post('/enrollments-bulk-delete', [EnrollmentController::class, 'bulkDelete'])->name('enrollments.bulk-delete');
        
        // FAQs Management
        Route::resource('faqs', FaqController::class);
        
        // Services Management
        Route::resource('services', ServiceController::class);
        
        // Team Members Management
        Route::resource('team-members', TeamMemberController::class);
        
        // Partners Management
        Route::resource('partners', PartnerController::class);
        
        // Testimonials Management
        Route::resource('testimonials', TestimonialController::class);
        
        // Contact Page Management
        Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
        Route::post('/contact', [AdminContactController::class, 'update'])->name('contact.update');
        
        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        
        // Admin Profile
        Route::get('/settings/profile', [SettingController::class, 'showProfile'])->name('settings.profile');
        Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->name('settings.profile.update');
        
        // Change Password
        Route::get('/settings/password', [SettingController::class, 'showPasswordForm'])->name('settings.password');
        Route::post('/settings/password', [SettingController::class, 'updatePassword'])->name('settings.password.update');
        
        // Legacy password routes (for backward compatibility)
        Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.edit');
        Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');
        
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});