<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StageFormationController;


use App\Http\Controllers\Auth\PasswordChangeController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleDomainController;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolePermissionController;
use App\Http\Middleware\CheckPermission;

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
})->middleware([
    'auth',
    'password.changed',
    'checkRole:Administrateur',
    'checkRole:Collaborateur'
])->name('admin');


/*
* Website Blades
*/
Route::middleware(['auth', 'password.changed'])->group(function () {

    Route::resource('documentation', DocumentController::class);
    Route::resource('stg-formation', StageFormationController::class);
});

/*
* First password must be changed
*/
Route::middleware(['auth'])->group(function () {
    Route::get('user/password/change', [PasswordChangeController::class, 'edit'])->name('newpassword.change');
    Route::post('user/password/change', [PasswordChangeController::class, 'update'])->name('newpassword.update');
});

/*
* All Blades
*/
Route::middleware(['auth', 'password.changed'])->group(function () {

    // Admin
    Route::prefix('admin')->group(function () {
        // Roles
        Route::get('/roles', [RolePermissionController::class, 'index'])->name('admin.roles.index');
        Route::get('/roles/edit/{role_id}/{domain_id}', [RolePermissionController::class, 'edit'])->name('role-permissions.edit');
        Route::get('/roles/get-objects-permissions', [RolePermissionController::class, 'getObjectsAndPermissions']);
        Route::post('/roles/store', [RolePermissionController::class, 'store'])->name('role-permissions.store');


        // Users rôles and permissions
        Route::get('/users/manage', [UserController::class, 'adminManageUsers'])->name('users.manage');
        Route::get('/users/manage/search', [UserController::class, 'adminManageUsersSearch'])->name('users.manage.search');
        Route::post('/users/assign-role', [UserController::class, 'adminAssignRole'])->name('users.assignRole');
        Route::post('/users/remove-role', [UserController::class, 'adminRemoveRole'])->name('users.removeRole');
        Route::get('/users/admins', [UserController::class, 'manageAdmins'])->name('users.admins');
        Route::post('/users/assign-super-admin', [UserController::class, 'assignSuperAdmin'])->name('users.assignSuperAdmin');
        Route::post('/users/remove-super-admin', [UserController::class, 'removeSuperAdmin'])->name('users.removeSuperAdmin');

        // Users password init
        Route::get('users/password/init', [UserController::class, 'adminUserPasswordInitView'])->name('users.password.init');

        // Admin Logs
        Route::get('/logs', [LogController::class, 'adminLogsIndex'])->name('admin.logs');
        Route::get('/logs/search', [LogController::class, 'adminLogsSearch'])->name('admin.logs.search');

    });

    // Users account and profile
    Route::prefix('user')->group(function () {
        Route::get('/account', [ProfileController::class, 'edit'])->name('myprofile.edit');
        Route::patch('/account', [ProfileController::class, 'update'])->name('myprofile.update');
        Route::delete('/account', [ProfileController::class, 'destroy'])->name('myprofile.destroy');
        Route::get('/profile', [ProfileController::class, 'show'])->name('myprofile.show');
        Route::patch('/profile', [ProfileController::class, 'updateCivilStatus'])->name('myprofile.updateCivilStatus');
    });

    // Routes pour la communication
    Route::prefix('communication')->group(function () {
        Route::get('/', [CommunicationController::class, 'index'])->name('communication.index')->middleware('checkPermission:view,comm,posts');
        Route::get('/create', [CommunicationController::class, 'create'])->name('communication.create')->middleware('checkPermission:create,comm,posts');
        Route::post('/', [CommunicationController::class, 'store'])->name('communication.store')->middleware('checkPermission:create,comm,posts');
        Route::get('/{id}', [CommunicationController::class, 'show'])->name('communication.show')->middleware('checkPermission:view,comm,posts');
        Route::get('/{id}/edit', [CommunicationController::class, 'edit'])->name('communication.edit')->middleware('checkPermission:update,comm,posts');
        Route::put('/{id}', [CommunicationController::class, 'update'])->name('communication.update')->middleware('checkPermission:update,comm,posts');
        Route::delete('/{id}', [CommunicationController::class, 'destroy'])->name('communication.destroy')->middleware('checkPermission:destroy,comm,posts');
    });


    // Routes pour la documentation
    Route::prefix('documentation')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('documentation.index')->middleware('checkPermission:view,doc,file');
        Route::get('/create', [DocumentController::class, 'create'])->name('documentation.create')->middleware('checkPermission:create,doc,file');
        Route::post('/', [DocumentController::class, 'store'])->name('documentation.store')->middleware('checkPermission:create,doc,file');
        Route::get('/{id}', [DocumentController::class, 'show'])->name('documentation.show')->middleware('checkPermission:view,doc,file');
        Route::get('/{id}/edit', [DocumentController::class, 'edit'])->name('documentation.edit')->middleware('checkPermission:update,doc,file');
        Route::put('/{id}', [DocumentController::class, 'update'])->name('documentation.update')->middleware('checkPermission:update,doc,file');
        Route::delete('/{id}', [DocumentController::class, 'destroy'])->name('documentation.destroy')->middleware('checkPermission:destroy,doc,file');
    });


    // Routes pour le personnel
    Route::prefix('personnel')->group(function () {
        // Recherche de profil
        Route::get('/search', [PersonnelController::class, 'search'])->name('personnel.search');
        Route::get('/custom-search', [PersonnelController::class, 'customSearch'])->name('personnel.customSearch');

        // Exportation excel et pdf
        Route::post('/export', [PersonnelController::class, 'export'])->name('personnel.export');


        // Gestion des profils
        Route::get('/', [PersonnelController::class, 'index'])->name('personnel.index')->middleware('checkPermission:view,rh,personnel');
        Route::get('/profile/list', [PersonnelController::class, 'list'])->name('personnel.list')->middleware('checkPermission:view,rh,personnel');
        Route::get('/profile/list/ByUnit', [PersonnelController::class, 'listByUnit'])->name('personnel.listByUnit')->middleware('checkPermission:view,rh,personnel');
        Route::get('/profile/list/ByRank', [PersonnelController::class, 'listByRank'])->name('personnel.listByRank')->middleware('checkPermission:view,rh,personnel');
        Route::get('/profile/create', [PersonnelController::class, 'create'])->name('personnel.create')->middleware('checkPermission:create,rh,personnel');
        Route::post('/profile', [PersonnelController::class, 'store'])->name('personnel.store')->middleware('checkPermission:create,rh,personnel');
        Route::get('/profile/{id}', [PersonnelController::class, 'show'])->name('personnel.show')->middleware('checkPermission:view,rh,personnel');
        Route::get('/profile/{id}/edit', [PersonnelController::class, 'edit'])->name('personnel.edit')->middleware('checkPermission:update,rh,personnel');
        Route::put('/profile/{id}', [PersonnelController::class, 'update'])->name('personnel.update')->middleware('checkPermission:update,rh,personnel');
        Route::delete('/profile/{id}', [PersonnelController::class, 'destroy'])->name('personnel.destroy')->middleware('checkPermission:destroy,rh,personnel');
        Route::post('/profile/{id}/update-calculations', [PersonnelController::class, 'updateCalculations'])->name('personnel.update.calculations');

        // Routes pour les renseignements militaires
        Route::prefix('/profile/{profile}/military_details')->group(function () {
            Route::get('/', [MilitaryDetailController::class, 'index'])->name('military_details.index')->middleware('checkPermission:view,rh,personnel');
            Route::get('/create', [MilitaryDetailController::class, 'create'])->name('military_details.create')->middleware('checkPermission:create,rh,personnel');
            Route::post('/', [MilitaryDetailController::class, 'store'])->name('military_details.store')->middleware('checkPermission:create,rh,personnel');
            Route::get('/{id}', [MilitaryDetailController::class, 'show'])->name('military_details.show')->middleware('checkPermission:view,rh,personnel');
            Route::get('/{id}/edit', [MilitaryDetailController::class, 'edit'])->name('military_details.edit')->middleware('checkPermission:update,rh,personnel');
            Route::put('/{id}', [MilitaryDetailController::class, 'update'])->name('military_details.update')->middleware('checkPermission:update,rh,personnel');
            Route::delete('/{id}', [MilitaryDetailController::class, 'destroy'])->name('military_details.destroy')->middleware('checkPermission:destroy,rh,personnel');
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
            Route::delete('/', [AcademicPathController::class, 'destroyAll'])->name('academic_paths.destroyAll');
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
            Route::delete('/', [MilitaryPathController::class, 'destroyAll'])->name('military_paths.destroyAll');
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
            Route::delete('/', [ProfessionalCareerController::class, 'destroyAll'])->name('professional_careers.destroyAll');
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
            Route::delete('/', [RankHistoryController::class, 'destroyAll'])->name('rank_histories.destroyAll');
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
            Route::delete('/', [HonoraryDistinctionController::class, 'destroyAll'])->name('honorary_distinctions.destroyAll');
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
            Route::delete('/', [MilitaryCampaignController::class, 'destroyAll'])->name('campaign_histories.destroyAll');
        });

        //Logs
        Route::prefix('/logs')->group(function () {
            Route::get('/', [LogController::class, 'personnelLogsIndex'])->name('personnel.logs');
            Route::get('/search', [LogController::class, 'personnelLogsSearch'])->name('personnel.logs.search');
        });

        // Users
        Route::prefix('/users')->group(function () {
            Route::get('/manage', [UserController::class, 'personnelManageUsers'])->name('personnel.users.manage');
            Route::post('/assign-role', [UserController::class, 'personnelAssignRole'])->name('personnel.users.assignRole');
            Route::post('/remove-role', [UserController::class, 'personnelRemoveRole'])->name('personnel.users.removeRole');
            Route::get('/password/init', [UserController::class, 'personnelUserPasswordInitView'])->name('personnel.users.password.init');

        });
    });
});


require __DIR__.'/auth.php';
