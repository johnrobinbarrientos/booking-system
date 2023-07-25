<?php

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PumpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubbieController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientReportsController;
use App\Http\Controllers\ConcreteSupplier;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceGroupController;
use App\Http\Controllers\PumpCategoryController;
use App\Http\Controllers\PumpMakeController;
use App\Http\Controllers\SubContractorController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\ConcreteSupplierController;
use App\Http\Controllers\ConcreteTypeController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PumpReportsController;
use App\Http\Controllers\PumpPriceController;
use App\Http\Controllers\WorkerReportsController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
    Route::get('login', 'loginView')->name('login');
    Route::post('login', 'login')->name('login.check');
});

Route::get('logout', [AuthController::class, 'logout'])->name('user.logout')->middleware('auth');

Route::middleware('auth', 'verified',)->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'dashboardOverview')->name('dashboard');
        Route::get('account', 'profile')->name('profile');
        Route::get('calendar', 'calendar')->name('calendar');
        Route::get('add-booking', 'addBooking')->name('add-booking');
        Route::get('all-booking', 'listOfBookings')->name('all-booking');
        Route::get('edit-booking', 'editBooking')->name('edit');
        //fetch bookings by date
        Route::post('fetch-bookings', 'fetchBookings')->name('fetch-bookings');
        //export booking from today
        Route::get('today-booking-export', 'todayBookingExport')->name('bookings.todayBookingExport');
    });

    //Booking Controller Group 
    Route::controller(BookingController::class)->group(function () {
        Route::post('route_to_update_booking_status/{bookingId}', 'updateBookingStatus');
        Route::post('update_booking_date', 'updateBookingDate')->name('updateBookingDate');

        Route::post('duplicate_booking', 'duplicateBooking')->name('duplicateBooking');

        Route::post('/bookings/{id}', 'updatePump')->name('updatePump');

        Route::get('hist/{booking}',  'hist')->name('hist');
        Route::get('booking-export', 'export')->name('bookings.export');
        Route::get('pricing-table',  'table')->name('pricing-table');
        Route::get('get/details/{id}', 'getDetails')->name('getDetails');

        Route::get('get/project-latest-order-number', 'getProjectLatestOrderNumber')->name('getProjectLatestOrderNumber');
        Route::get('get/pump-latest-order-number/{id}', 'getPumpLatestOrderNumber')->name('getPumpLatestOrderNumber');

    });

    //booking resource
    Route::resource('bookings', BookingController::class)->names('bookings');

    //Clients Route Resource
    Route::get('clients-export/{download_type}', [ClientController::class, 'export'])->name('clients.export');
    Route::post('clients-import', [ClientController::class, 'import'])->name('clients.import');
    Route::resource('clients', ClientController::class)->names('clients');
    Route::get('/clients/{client}/bad_credit', [ClientController::class, 'checkBadCredit'])->name('clients.bad_credit');
    Route::get('client-projects/{id}', [ClientController::class, 'getClientProjects'])->name('getClientProjects');

    //Project Route Resource
    Route::get('projects-export/{download_type}', [ProjectController::class, 'export'])->name('projects.export');
    Route::post('projects-import', [ProjectController::class, 'import'])->name('projects.import');
    Route::resource('projects', ProjectController::class)->names('projects');
    //Route::get('get/project/details/{id}', [ProjectController::class,'getProjectDetails'])->name('getProjectDetails');

    //Pumps Route Resource 
    Route::get('pumps-export/{download_type}', [PumpController::class, 'export'])->name('pumps.export');
    Route::post('pumps-import', [PumpController::class, 'import'])->name('pumps.import');
    Route::resource('pumps', PumpController::class)->names('pumps');
    Route::get('get/boompumps', [PumpController::class, 'getBoomPumps'])->name('getBoomPumps');
    Route::get('pumpTotalMetresPumped/{id}', [PumpController::class, 'getPumpTotalMetresPumped'])->name('getPumpTotalMetresPumped');

    //Pricing resource
    //Route::resource('pricing', PricingController::class)->names('pricing');

    Route::resource('pumpMake', PumpMakeController::class)->names('pumpMake');

    //Workers Route Resource 
    Route::post('workers-import', [WorkerController::class, 'import'])->name('workers.import');
    Route::get('workers-export/{download_type}', [WorkerController::class, 'export'])->name('workers.export');
    Route::resource('workers', WorkerController::class)->names('workers');
    Route::get('/checkBookingWorker/{workerId}', [WorkerController::class, 'checkBookingWorker']);


    //Workers Exports
    Route::get('expiringLicenses', [WorkerReportsController::class, 'getExpiringLicenses'])->name('expiringLicenses');
    Route::get('expiring-license-export/{license_id}', [WorkerReportsController::class, 'exportExpiringLicense'])->name('exportExpiringLicense');
    Route::get('workerHistory', [WorkerReportsController::class, 'getworkerHistory'])->name('workerHistory');
    Route::get('worker-export-job-history', [WorkerReportsController::class, 'exportWorkerJobHistory'])->name('exportWorkerJobHistory');

    //User Route Resource 
    //Route::get('users-export', [UserController::class, 'export'])->name('users.export');
    Route::resource('users', UserController::class)->names('users');
    Route::get('resetpassword/{user_id}', [UserController::class, 'resetPassword'])->name('resetPassword');
    Route::put('save-resetpassword/{user_id}', [UserController::class, 'saveResetPassword'])->name('saveResetPassword');

    Route::put('disable-2fa/{user_id}', [UserController::class, 'disable2fa'])->name('disable2fa');

    //Sub Contractors Resource
    Route::get('subbies-export/{download_type}', [SubbieController::class, 'export'])->name('subbies.export');
    Route::post('subbies-import', [SubbieController::class, 'import'])->name('subbies.import');
    Route::resource('subbies', SubbieController::class)->names('subbies');
    // Route::resource('reports', ReportController::class)->names('reports');

    //price group/ Pump pricing and Jobs
    //Route::resource('pricingTable', PricingController::class)->names('pricing-table');
    Route::resource('priceGroups', PriceGroupController::class)->names('price-groups');
    Route::get('/getPriceGroupDetails/{priceGroupId}', [PriceGroupController::class, 'getPriceGroupDetails']);
    Route::resource('pumpCategories', PumpCategoryController::class)->names('pump-categories');
    //Route::resource('extras', ExtraController::class)->names('extras');
    Route::resource('pump-prices', PumpPriceController::class)->names('pump-prices');
    Route::get('price-hist', [PumpPriceController::class, 'hist'])->name('price-hist');
    Route::post('pumpPriceList', [PumpPriceController::class, 'getPumpPriceList'])->name('getPumpPriceList');
    Route::get('pumpPrice/{id}', [PumpPriceController::class, 'getPumpPrice'])->name('getPumpPrice');


    //financial history for client
    Route::get('clientFinancialHistory', [ClientReportsController::class, 'getClientFinancialHistory'])->name('clientFinancialHistory');
    Route::get('clients-history-export', [ClientReportsController::class, 'export'])->name('clientFinancialHistory.export');
    Route::get('clients-jobs/{client_id}', [ClientReportsController::class, 'exportClientJobs'])->name('clientJobs');

    //Health history for pump
    Route::get('pumpHealth', [PumpReportsController::class, 'getpumpHealth'])->name('pumpHealth');
    Route::get('generate-pdf', [PumpReportsController::class, 'createPDF'])->name('generatePDF');

    Route::get('generate-word', [PumpReportsController::class, 'createWord'])->name('generateWord');


    Route::get('/download/{id}', [PumpReportsController::class, 'download'])->name('download');
    Route::get('/delete-pdf/{id}', [PumpReportsController::class, 'deletePdf'])->name('deletePdf');
    Route::get('/download-docx/{id}', [PumpReportsController::class, 'downloadDocx'])->name('downloadDocx');
    Route::get('/delete-docx/{id}', [PumpReportsController::class, 'deleteDocx'])->name('deleteDocx');
    Route::get('/createPDF', [PumpReportsController::class, 'createPDF'])->name('createPDF');

    //financial history for pump
    Route::get('pumpFinancialHistory', [PumpReportsController::class, 'getPumpFinancialHistory'])->name('pumpFinancialHistory');
    Route::get('pumps-history-export', [PumpReportsController::class, 'export'])->name('pumpFinancialHistory.export');

    //Docket pump history
    Route::get('pumpHistory', [PumpReportsController::class, 'getpumpHistory'])->name('pumpHistory');
    Route::get('pump-docket-history-export/{client_id}/{docket_no}/{job_date}/{pump_id}', [PumpReportsController::class, 'exportPumpHistory'])->name('exportHistory');

    //concrete suppliers
    Route::resource('concreteSuppliers', ConcreteSupplierController::class)->names('concreteSuppliers');
    Route::get('concrete-suppliers-export/{download_type}', [ConcreteSupplierController::class, 'export'])->name('concreteSuppliers.export');
    Route::post('concrete-suppliers-import', [ConcreteSupplierController::class, 'import'])->name('concreteSuppliers.import');

    //concrete types 
    Route::resource('concreteTypes', ConcreteTypeController::class)->names('concreteTypes');
    Route::get('concrete-types-export/{download_type}', [ConcreteTypeController::class, 'export'])->name('concreteTypes.export');
    Route::post('concrete-types-import', [ConcreteTypeController::class, 'import'])->name('concreteTypes.import');
});

//Two Factor Authentication
Route::post('/2fa-confirm', [TwoFactorAuthController::class, 'confirm'])->name('two-factor-auth.confirm');
