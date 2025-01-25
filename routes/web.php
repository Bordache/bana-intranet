<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StageFormationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\PasswordChangeController;

use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\AcademicPathController;
use App\Http\Controllers\MilitaryPathController;
use App\Http\Controllers\ProfessionalCareerController;
use App\Http\Controllers\MilitaryDetailController;
use App\Http\Controllers\RankHistoryController;
use App\Http\Controllers\MilitaryCampaignController;
use App\Http\Controllers\ChildrenDetailController;
use App\Http\Controllers\HonoraryDistinctionController;
use App\Http\Controllers\SpouseDetailController;
use Illuminate\Support\Facades\Route;

use App\Models\Profile;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/check-national-id/{national_id}', function ($national_id) {
    $exists = Profile::where('national_id', $national_id)->exists();
    return response()->json(['isUnique' => !$exists]);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'password.changed'])->name('dashboard');

/*
* Administrator index
*/
Route::get('/admin', function () {
    return view('administration');
})->middleware(['auth', 'password.changed'])->name('admin');

/*
* Profile
*/
Route::middleware(['auth', 'password.changed'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('myprofile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('myprofile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('myprofile.destroy');
});

/*
* Website Blades
*/
Route::middleware(['auth', 'password.changed'])->group(function () {

    Route::resource('documentation', DocumentController::class);
    Route::resource('stg-formation', StageFormationController::class);
});

/*
* All Blades
*/
Route::middleware(['auth', 'password.changed'])->group(function () {

    // Routes pour la communication
    Route::prefix('communication')->group(function () {
        Route::get('/', [CommunicationController::class, 'index'])->name('communication.index');
        Route::get('/create', [CommunicationController::class, 'create'])->name('communication.create');
        Route::post('/', [CommunicationController::class, 'store'])->name('communication.store');
        Route::get('/{id}', [CommunicationController::class, 'show'])->name('communication.show');
        Route::get('/{id}/edit', [CommunicationController::class, 'edit'])->name('communication.edit');
        Route::put('/{id}', [CommunicationController::class, 'update'])->name('communication.update');
        Route::delete('/{id}', [CommunicationController::class, 'destroy'])->name('communication.destroy');
    });


    // Routes pour la documentation
    Route::prefix('documentation')->group(function () {
        Route::get('/', [DocumentationController::class, 'index'])->name('documentation.index');
        Route::get('/create', [DocumentationController::class, 'create'])->name('documentation.create');
        Route::post('/', [DocumentationController::class, 'store'])->name('documentation.store');
        Route::get('/{id}', [DocumentationController::class, 'show'])->name('documentation.show');
        Route::get('/{id}/edit', [DocumentationController::class, 'edit'])->name('documentation.edit');
        Route::put('/{id}', [DocumentationController::class, 'update'])->name('documentation.update');
        Route::delete('/{id}', [DocumentationController::class, 'destroy'])->name('documentation.destroy');
    });


    // Routes pour le personnel
    Route::prefix('personnel')->group(function () {
        // Recherche de profil
        Route::get('/custom-search', [PersonnelController::class, 'customSearch'])->name('personnel.search');

        // Gestion des profils
        Route::get('/', [PersonnelController::class, 'index'])->name('personnel.index');
        Route::get('/profile/list', [PersonnelController::class, 'list'])->name('personnel.list');
        Route::get('/profile/create', [PersonnelController::class, 'create'])->name('personnel.create');
        Route::post('/profile', [PersonnelController::class, 'store'])->name('personnel.store');
        Route::get('/profile/{id}', [PersonnelController::class, 'show'])->name('personnel.show');
        Route::get('/profile/{id}/edit', [PersonnelController::class, 'edit'])->name('personnel.edit');
        Route::put('/profile/{id}', [PersonnelController::class, 'update'])->name('personnel.update');
        Route::delete('/profile/{id}', [PersonnelController::class, 'destroy'])->name('personnel.destroy');
        Route::post('/profile/{id}/update-calculations', [PersonnelController::class, 'updateCalculations'])->name('personnel.update.calculations');
/*         Route::get('/check-national-id/{national_id}', [PersonnelController::class, 'checkNationalId']); */

        // Routes pour les renseignements militaires
        Route::prefix('/profile/{profile}/military_details')->group(function () {
            Route::get('/', [MilitaryDetailController::class, 'index'])->name('military_details.index');
            Route::get('/create', [MilitaryDetailController::class, 'create'])->name('military_details.create');
            Route::post('/', [MilitaryDetailController::class, 'store'])->name('military_details.store');
            Route::get('/{id}', [MilitaryDetailController::class, 'show'])->name('military_details.show');
            Route::get('/{id}/edit', [MilitaryDetailController::class, 'edit'])->name('military_details.edit');
            Route::put('/{id}', [MilitaryDetailController::class, 'update'])->name('military_details.update');
            Route::delete('/{id}', [MilitaryDetailController::class, 'destroy'])->name('military_details.destroy');
        });

        // Routes pour le conjoint
        Route::prefix('/profile/{profile}/spouse_details')->group(function () {
            Route::get('/', [SpouseDetailController::class, 'index'])->name('spouse_details.index');
            Route::get('/create', [SpouseDetailController::class, 'create'])->name('spouse_details.create');
            Route::post('/', [SpouseDetailController::class, 'store'])->name('spouse_details.store');
            Route::get('/{id}', [SpouseDetailController::class, 'show'])->name('spouse_details.show');
            Route::get('/{id}/edit', [SpouseDetailController::class, 'edit'])->name('spouse_details.edit');
            Route::put('/{id}', [SpouseDetailController::class, 'update'])->name('spouse_details.update');
            Route::delete('/{id}', [SpouseDetailController::class, 'destroy'])->name('spouse_details.destroy');
        });

        // Routes pour les renseignements des enfants
        Route::prefix('/profile/{profile}/children_details')->group(function () {
            Route::get('/', [ChildrenDetailController::class, 'index'])->name('children_details.index');
            Route::get('/create', [ChildrenDetailController::class, 'create'])->name('children_details.create');
            Route::post('/', [ChildrenDetailController::class, 'store'])->name('children_details.store');
            Route::get('/{id}', [ChildrenDetailController::class, 'show'])->name('children_details.show');
            Route::get('/{id}/edit', [ChildrenDetailController::class, 'edit'])->name('children_details.edit');
            Route::put('/{id}', [ChildrenDetailController::class, 'update'])->name('children_details.update');
            Route::delete('/{id}', [ChildrenDetailController::class, 'destroy'])->name('children_details.destroy');
            Route::delete('/', [ChildrenDetailController::class, 'destroyAll'])->name('children_details.destroyAll');
        });

        // Routes pour les parcours scolaires liés à un profil
        Route::prefix('/profile/{profile}/academic_paths')->group(function () {
            Route::get('/', [AcademicPathController::class, 'index'])->name('academic_paths.index');
            Route::get('/create', [AcademicPathController::class, 'create'])->name('academic_paths.create');
            Route::post('/', [AcademicPathController::class, 'store'])->name('academic_paths.store');
            Route::get('/{id}', [AcademicPathController::class, 'show'])->name('academic_paths.show');
            Route::get('/{id}/edit', [AcademicPathController::class, 'edit'])->name('academic_paths.edit');
            Route::put('/{id}', [AcademicPathController::class, 'update'])->name('academic_paths.update');
            Route::delete('/{id}', [AcademicPathController::class, 'destroy'])->name('academic_paths.destroy');
        });

        // Routes pour les parcours militaire liés à un profil
        Route::prefix('/profile/{profile}/military_paths')->group(function () {
            Route::get('/', [MilitaryPathController::class, 'index'])->name('military_paths.index');
            Route::get('/create', [MilitaryPathController::class, 'create'])->name('military_paths.create');
            Route::post('/', [MilitaryPathController::class, 'store'])->name('military_paths.store');
            Route::get('/{id}', [MilitaryPathController::class, 'show'])->name('military_paths.show');
            Route::get('/{id}/edit', [MilitaryPathController::class, 'edit'])->name('military_paths.edit');
            Route::put('/{id}', [MilitaryPathController::class, 'update'])->name('military_paths.update');
            Route::delete('/{id}', [MilitaryPathController::class, 'destroy'])->name('military_paths.destroy');
        });

         // Routes pour les parcours professionnel liés à un profil
         Route::prefix('/profile/{profile}/professional_careers')->group(function () {
            Route::get('/', [ProfessionalCareerController::class, 'index'])->name('professional_careers.index');
            Route::get('/create', [ProfessionalCareerController::class, 'create'])->name('professional_careers.create');
            Route::post('/', [ProfessionalCareerController::class, 'store'])->name('professional_careers.store');
            Route::get('/{id}', [ProfessionalCareerController::class, 'show'])->name('professional_careers.show');
            Route::get('/{id}/edit', [ProfessionalCareerController::class, 'edit'])->name('professional_careers.edit');
            Route::put('/{id}', [ProfessionalCareerController::class, 'update'])->name('professional_careers.update');
            Route::delete('/{id}', [ProfessionalCareerController::class, 'destroy'])->name('professional_careers.destroy');
        });

        // Routes pour les historiques de grades
        Route::prefix('/profile/{profile}/rank_histories')->group(function () {
            Route::get('/', [RankHistoryController::class, 'index'])->name('rank_histories.index');
            Route::get('/create', [RankHistoryController::class, 'create'])->name('rank_histories.create');
            Route::post('/', [RankHistoryController::class, 'store'])->name('rank_histories.store');
            Route::get('/{id}', [RankHistoryController::class, 'show'])->name('rank_histories.show');
            Route::get('/{id}/edit', [RankHistoryController::class, 'edit'])->name('rank_histories.edit');
            Route::put('/{id}', [RankHistoryController::class, 'update'])->name('rank_histories.update');
            Route::delete('/{id}', [RankHistoryController::class, 'destroy'])->name('rank_histories.destroy');
        });

        // Routes pour les distinctions honorifiques
        Route::prefix('/profile/{profile}/honorary_distinctions')->group(function () {
            Route::get('/', [HonoraryDistinctionController::class, 'index'])->name('honorary_distinctions.index');
            Route::get('/create', [HonoraryDistinctionController::class, 'create'])->name('honorary_distinctions.create');
            Route::post('/', [HonoraryDistinctionController::class, 'store'])->name('honorary_distinctions.store');
            Route::get('/{id}', [HonoraryDistinctionController::class, 'show'])->name('honorary_distinctions.show');
            Route::get('/{id}/edit', [HonoraryDistinctionController::class, 'edit'])->name('honorary_distinctions.edit');
            Route::put('/{id}', [HonoraryDistinctionController::class, 'update'])->name('honorary_distinctions.update');
            Route::delete('/{id}', [HonoraryDistinctionController::class, 'destroy'])->name('honorary_distinctions.destroy');
        });

        // Routes pour les campagnes militaires
        Route::prefix('/profile/{profile}/campaign_histories')->group(function () {
            Route::get('/', [MilitaryCampaignController::class, 'index'])->name('campaign_histories.index');
            Route::get('/create', [MilitaryCampaignController::class, 'create'])->name('campaign_histories.create');
            Route::post('/', [MilitaryCampaignController::class, 'store'])->name('campaign_histories.store');
            Route::get('/{id}', [MilitaryCampaignController::class, 'show'])->name('campaign_histories.show');
            Route::get('/{id}/edit', [MilitaryCampaignController::class, 'edit'])->name('campaign_histories.edit');
            Route::put('/{id}', [MilitaryCampaignController::class, 'update'])->name('campaign_histories.update');
            Route::delete('/{id}', [MilitaryCampaignController::class, 'destroy'])->name('campaign_histories.destroy');
        });
    });
});

/*
* Setting blades
*/
Route::middleware(['auth', 'password.changed'])->prefix('admin')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
});

/*
* First password must be changed
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/password/change', [PasswordChangeController::class, 'edit'])->name('newpassword.change');
    Route::post('/password/change', [PasswordChangeController::class, 'update'])->name('newpassword.update');
});


require __DIR__.'/auth.php';
