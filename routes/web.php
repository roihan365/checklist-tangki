<?php

use App\Http\Controllers\Admin\ChecklistScheduleController;
use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\Admin\TankTruckController;
use App\Http\Controllers\Distributor\ChecklistScheduleController as DistributorChecklistScheduleController;
use App\Http\Controllers\Distributor\DocumentsController as DistributorDocumentsController;
use App\Http\Controllers\Distributor\TankTruckController as DistributorTankTruckController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    if (!auth()->check()) {
        return redirect()->route('login');
    } else {
        if (auth()->user()->hasRole('admin-pertamina')) {
            return redirect()->route('dashboard');
        } elseif (auth()->user()->hasRole('admin-distributor')) {
            return redirect()->route('home');
        }
    }
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin-pertamina'])
    ->group(function () {
        Route::get('/', function () {
            return view('pages.admin.index');
        })->name('dashboard');

        Route::resource('distributor', DistributorController::class);
        Route::get('checklist-schedule/by-date/{date}', [ChecklistScheduleController::class, 'showByDate'])->name('checklist-schedule.by-date');
        Route::resource('checklist-schedule', ChecklistScheduleController::class)->except('show');
        Route::get('checklist-schedule/document/{checklistSchedule}/{tankTruck}', [ChecklistScheduleController::class, 'checklistForm'])->name('checklist-schedule.document');
        Route::post('checklist-schedule/document/{checklistSchedule}/{tankTruck}', [ChecklistScheduleController::class, 'storeChecklist'])->name('checklist-schedule.store-document');


        Route::resource('tank-trucks', TankTruckController::class);

        // Document Review
        Route::get('tank-trucks/{tank_truck}/documents/', [TankTruckController::class, 'documentForm'])
            ->name('tank-trucks.document-form');
        Route::post('tank-trucks/{tank_truck}/documents', [TankTruckController::class, 'storeDocument'])
            ->name('tank-trucks.store-document');
        Route::post('/tank-trucks/documents/{document}/review', [TankTruckController::class, 'documentReview'])
            ->name('tank-trucks.document-review');
    });

Route::prefix('distributor')
    ->name('distributor.')
    ->middleware(['auth', 'role:admin-distributor'])
    ->group(function () {
        Route::get('/', function () {
            // return view('pages.distributor.index');
            if (!auth()->check()) {
                return redirect()->route('login');
            } else {
                if (auth()->user()->hasRole('admin-distributor')) {
                    return redirect()->route('distributor.checklist-schedule.index');
                }
            }
        })->name('dashboard');

        Route::get('checklist-schedule', [DistributorChecklistScheduleController::class, 'index'])->name('checklist-schedule.index');
        Route::get('checklist-schedule/by-date/{date}', [DistributorChecklistScheduleController::class, 'showByDate'])->name('checklist-schedule.by-date');
        Route::get('checklist-schedule/document/{checklistSchedule}/{tankTruck}', [DistributorChecklistScheduleController::class, 'checklistForm'])->name('checklist-schedule.document');


        Route::resource('tank-trucks', DistributorTankTruckController::class);

        Route::get('tank-truck/document', [DistributorDocumentsController::class, 'index'])
            ->name('document.index');
        Route::get('tank-truck/document/{tank_truck}', [DistributorDocumentsController::class, 'show'])
            ->name('document.show');

        Route::get('tank-truck/history', [DistributorDocumentsController::class, 'history'])
            ->name('document.history');
        Route::get('tank-truck/rejected', [DistributorDocumentsController::class, 'rejected'])
            ->name('document.rejected');


        // Document Review
        Route::get('tank-trucks/{tank_truck}/documents/', [DistributorTankTruckController::class, 'documentForm'])
            ->name('tank-trucks.document-form');
        Route::post('tank-trucks/{tank_truck}/documents', [DistributorTankTruckController::class, 'storeDocument'])
            ->name('tank-trucks.store-document');
    });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
