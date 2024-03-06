<?php

use App\Http\Controllers\admin\Services\EventRequestController;
use App\Http\Controllers\admin\Services\GeneralReservationRequest;
use App\Http\Controllers\admin\Services\IdeaRequestController;
use App\Http\Controllers\admin\Services\IncubatorRequestController;
use App\Http\Controllers\admin\Services\IdeaRequestTechnologyController;
use App\Http\Controllers\admin\Services\ImplementationLevelController;
use App\Http\Controllers\admin\Services\RequiredResourcesController;
use App\Http\Controllers\admin\Services\ResourceRequestController;
use App\Http\Controllers\admin\Services\ScheduleVisitRequestController;
use App\Http\Controllers\admin\Services\WorkshopRequestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin-login', function () {
    // return view('pages.admin.login');
    return view('pages.admin.dashboard');
})->name('login');
Route::get('/history', function () {
    return view('pages.web.history');
})->name('history');

// Route::get('/general-control', function () {
//     return view('pages.web.general-control');
// })->name('general-control');
// Route::get('/user-control-new', function () {
//     return view('pages.web.user-control-new');
// })->name('user-control-new');
// Route::get('/user-control-settings', function () {
//     return view('pages.web.user_control.user-control-settings');
// })->name('user-control-settings');
// Route::get('/bulk-user-control-settings', function () {
//     return view('pages.web.bulk-user-control-settings');
// })->name('bulk-user-control-settings');
// Route::get('/register', function () {
//     return view('pages.admin.register');
// })->name('register');
// Route::get('services/manage-schedule-visit', function () {
//     return view('pages.web.services.manage-schedule-visit');
// })->name('services/manage-schedule-visit');
// Route::get('services/manage-schedule-visit-form', function () {
//     return view('pages.web.services.manage-schedule-visit-form');
// })->name('services/manage-schedule-visit-form');
// Route::get('services/manage-service-hosted-event', function () {
//     return view('pages.web.services.manage-service-hosted-event');
// })->name('services/manage-service-hosted-event');
// Route::get('services/manage-service-hosted-event-form', function () {
//     return view('pages.web.services.manage-service-hosted-event-form');
// })->name('services/manage-service-hosted-event-form');
// Route::get('services/manage-allocated-computing-resources', function () {
//     return view('pages.web.services.manage-allocated-computing-resources');
// })->name('services/manage-allocated-computing-resources');
// Route::get('services/manage-allocated-compute-resources-form', function () {
//     return view('pages.web.services.manage-allocated-compute-resources-form');
// })->name('services/manage-allocated-compute-resources-form');
// Route::get('services/manage-reserved-incubator', function () {
//     return view('pages.web.services.manage-reserved-incubator');
// })->name('services/manage-reserved-incubator');

// Route::get('services/manage-incubator-service-form', function () {
//     return view('pages.web.services.manage-incubator-service-form');
// })->name('services/manage-incubator-service-form');

// Route::get('services/manage-reserved-technology-workshop', function () {
//     return view('pages.web.services.manage-reserved-technology-workshop');
// })->name('services/manage-reserved-technology-workshop');

// Route::get('services/manage-technology-workshop-form', function () {
//     return view('pages.web.services.manage-technology-workshop-form');
// })->name('services/manage-technology-workshop-form');

// Route::get('services/manage-submitted-idea', function () {
//     return view('pages.web.services.manage-submitted-idea');
// })->name('services/manage-submitted-idea');

// Route::get('services/manage-submit-idea-form', function () {
//     return view('pages.web.services.manage-submit-idea-form');
// })->name('services/manage-submitted-idea-form');

// Route::get('services/manage-general-reservation', function () {
//     return view('pages.web.services.manage-general-reservation');
// })->name('services/manage-general-reservation');

// Route::get('services/manage-general-reservation-form', function () {
//     return view('pages.web.services.manage-general-reservation-form');
// })->name('services/manage-general-reservation-form');

// Route::get('services/manage-cancellation-schedule-visit', function () {
//     return view('pages.web.services.manage-cancellation-schedule-visit');
// })->name('services/manage-cancellation-schedule-visit');

// Route::get('services/manage-cancellation-schedule-visit-form', function () {
//     return view('pages.web.services.manage-cancellation-schedule-visit-form');
// })->name('services/manage-cancellation-schedule-visit-form');

// Route::get('services/manage-cancellation-host-event', function () {
//     return view('pages.web.services.manage-cancellation-host-event');
// })->name('services/manage-cancellation-host-event');

// Route::get('services/manage-cancellation-host-event-form', function () {
//     return view('pages.web.services.manage-cancellation-host-event-form');
// })->name('services/manage-cancellation-host-event-form');

// Route::get('services/manage-cancellation-allocate-resources', function () {
//     return view('pages.web.services.manage-cancellation-allocate-resources');
// })->name('services/manage-cancellation-allocate-resources');

// Route::get('services/manage-cancellation-allocate-resources-form', function () {
//     return view('pages.web.services.manage-cancellation-allocate-resources-form');
// })->name('services/manage-cancellation-allocate-resources-form');

// Route::get('services/manage-cancellation-reserve-incubator', function () {
//     return view('pages.web.services.manage-cancellation-reserve-incubator');
// })->name('services/manage-cancellation-reserve-incubator');

// Route::get('services/manage-cancellation-reserve-incubator-form', function () {
//     return view('pages.web.services.manage-cancellation-reserve-incubator-form');
// })->name('services/manage-cancellation-reserve-incubator-form');

// Route::get('services/manage-cancellation-reserved-technology-workshop', function () {
//     return view('pages.web.services.manage-cancellation-reserved-technology-workshop');
// })->name('services/manage-cancellation-reserved-technology-workshop');

// Route::get('services/manage-cancellation-reserved-technology-workshop-form', function () {
//     return view('pages.web.services.manage-cancellation-reserved-technology-workshop-form');
// })->name('services/manage-cancellation-reserved-technology-workshop-form');

// Route::get('services/manage-cancellation-general-reservation', function () {
//     return view('pages.web.services.manage-cancellation-general-reservation');
// })->name('services/manage-cancellation-general-reservation');

// Route::get('services/manage-cancellation-general-reservation-form', function () {
//     return view('pages.web.services.manage-cancellation-general-reservation-form');
// })->name('services/manage-cancellation-general-reservation-form');

// Route::get('services/manage-cancellation-submitted-idea', function () {
//     return view('pages.web.services.manage-cancellation-submitted-idea');
// })->name('services/manage-cancellation-submitted-idea');

// Route::get('services/manage-cancellation-submitted-idea-form', function () {
//     return view('pages.web.services.manage-cancellation-submitted-idea-form');
// })->name('services/manage-cancellation-submitted-idea-form');

// Route::get('/edit-schedule-visit', function () {
//     return view('pages.web.edit-schedule-visit');
// })->name('/edit-schedule-visit');
// Route::get('/edit-host-event', function () {
//     return view('pages.web.edit-host-event');
// })->name('/edit-host-event');
// Route::get('/edit-allocate-resources', function () {
//     return view('pages.web.edit-allocate-resources');
// })->name('/edit-allocate-resources');
// Route::get('/edit-reserve-incubator', function () {
//     return view('pages.web.edit-reserve-incubator');
// })->name('/edit-reserve-incubator');
// Route::get('/edit-reserve-workshop', function () {
//     return view('pages.web.edit-reserve-workshop');
// })->name('/edit-reserve-workshop');
// Route::get('/edit-submit-idea', function () {
//     return view('pages.web.edit-submit-idea');
// })->name('/edit-submit-idea');
// Route::get('/edit-general-reservation', function () {
//     return view('pages.web.edit-general-reservation');
// })->name('/edit-general-reservation');
// Route::get('/about', function () {
//     return view('pages.web.about');
// })->name('about');

Route::group(['middleware' => 'auth'], function () {
Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {

    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');



    Route::group(['namespace' => 'aboutlab', 'as' => 'aboutlab-', 'prefix' => 'aboutlab'], function () {

            Route::get('/pages', [\App\Http\Controllers\admin\AboutLabController::class, 'index'])->name('pages');
            Route::get('/addpage', [\App\Http\Controllers\admin\AboutLabController::class, 'addPage'])->name('addpage');
            Route::get('/edit-page/{id}', [\App\Http\Controllers\admin\AboutLabController::class, 'editPage'])->name('editpage');
            Route::post('/updatepage', [\App\Http\Controllers\admin\AboutLabController::class, 'updatePage'])->name('updatepage');

            Route::post('/delete-page', [\App\Http\Controllers\admin\AboutLabController::class, 'DeletePage'])->name('deletepage');
            Route::post('/savepage', [\App\Http\Controllers\admin\AboutLabController::class, 'savePage'])->name('savepage');
            Route::post('/changepagestatus', [\App\Http\Controllers\admin\AboutLabController::class, 'changePageStatus'])->name('changepagestatus');




            Route::get('/pagecomponents/{pageid}', [\App\Http\Controllers\admin\AboutLabController::class, 'pageComponents'])->name('pagecomponents');
            Route::get('/edit-component/{pageid}/{id}', [\App\Http\Controllers\admin\AboutLabController::class, 'editComponent'])->name('editcomponent');
            Route::get('/addcomponent/{pageid}', [\App\Http\Controllers\admin\AboutLabController::class, 'addComponent'])->name('addcomponent');
            Route::post('/savecomponent', [\App\Http\Controllers\admin\AboutLabController::class, 'saveComponent'])->name('savecomponent');
            Route::post('/updatecomponent', [\App\Http\Controllers\admin\AboutLabController::class, 'updateComponent'])->name('updatecomponent');
            Route::post('/deletecomponent', [\App\Http\Controllers\admin\AboutLabController::class, 'deleteComponent'])->name('deletecomponent');
            Route::post('/updatecomponentorder', [\App\Http\Controllers\admin\AboutLabController::class, 'updateComponentOrder'])->name('updatecomponentorder');
            Route::post('/changecomponentstatus', [\App\Http\Controllers\admin\AboutLabController::class, 'changeComponentStatus'])->name('changecomponentstatus');

   });


    Route::group(['namespace' => 'faqs', 'as' => 'faqs-', 'prefix' => 'faqs'], function () {
        Route::get('/all', [\App\Http\Controllers\admin\faqController::class, 'Faqs'])->name('all');
        Route::get('/add/{id?}', [\App\Http\Controllers\admin\faqController::class, 'add'])->name('add');
        Route::post('/add/{id?}', [\App\Http\Controllers\admin\faqController::class, 'store'])->name('store');
        Route::post('/delete', [\App\Http\Controllers\admin\faqController::class, 'DeleteFAQ'])->name('delete');
    });

    Route::group(['namespace' => 'ar', 'as' => 'ar-', 'prefix' => 'ar'], function () {
        Route::get('/all', [\App\Http\Controllers\admin\ArController::class, 'list'])->name('all');
        Route::get('/add/{id?}', [\App\Http\Controllers\admin\ArController::class, 'add'])->name('add');
        Route::post('/add/{id?}', [\App\Http\Controllers\admin\ArController::class, 'store'])->name('store');
    });



        Route::group(['namespace' => 'users', 'as' => 'users-', 'prefix' => 'users'], function () {














        Route::get('/users', [\App\Http\Controllers\admin\UserController::class, 'index'])->name('index');
        Route::get('/add/{id?}', [\App\Http\Controllers\admin\UserController::class, 'add'])->name('add');
        Route::post('/add/{id?}', [\App\Http\Controllers\admin\UserController::class, 'store'])->name('store');
        Route::get('/view/{id?}', [\App\Http\Controllers\admin\UserController::class, 'View'])->name('view');
        Route::get('/profile/{id?}', [\App\Http\Controllers\admin\UserController::class, 'profile'])->name('profile');
        Route::post('/updateprofile', [\App\Http\Controllers\admin\UserController::class, 'updateprofile'])->name('updateprofile');

        Route::get('/pending-requests', [\App\Http\Controllers\admin\UserController::class, 'pendingIndex'])->name('pending-requests');
        Route::get('/pending-add/{id}', [\App\Http\Controllers\admin\UserController::class, 'pendingAdd'])->name('pending-add');
        Route::get('/approval/{id}', [\App\Http\Controllers\admin\UserController::class, 'approval'])->name('approval');
        Route::post('/approvalPost/{id}', [\App\Http\Controllers\admin\UserController::class, 'approvalPost'])->name('approvalPost');

        Route::get('/change-role/{id}', [\App\Http\Controllers\admin\UserController::class, 'changeUserRoleModal'])->name('change-role');
        Route::post('/change-role/{id}', [\App\Http\Controllers\admin\UserController::class, 'changeUserRoleSave'])->name('change-role');
    });

    Route::group(['namespace' => 'roles', 'as' => 'roles-', 'prefix' => 'roles'], function () {
        Route::get('/roles', [\App\Http\Controllers\admin\RoleController::class, 'index'])->name('index');
        Route::get('/add/{id?}', [\App\Http\Controllers\admin\RoleController::class, 'add'])->name('add');
        Route::post('/add/{id?}', [\App\Http\Controllers\admin\RoleController::class, 'store'])->name('store');
    });

});

    //services
    Route::group(['namespace' => 'service', 'as' => 'service-', 'prefix' => 'service'], function () {

        //resources request
        Route::group(['namespace' => 'resource', 'as' => 'resource-', 'prefix' => 'resource'], function () {
            Route::get('/index', [ResourceRequestController::class, 'index'])->name('index');
            Route::get('/add', [ResourceRequestController::class, 'add'])->name('add');
            Route::post('/store', [ResourceRequestController::class, 'store'])->name('store');
            Route::post('/update', [ResourceRequestController::class, 'store'])->name('update');
            Route::get('/list', [ResourceRequestController::class, 'getList'])->name('list');
            Route::get('/view/{id?}', [ResourceRequestController::class, 'action'])->name('view');
            Route::get('/change-status/{id?}', [ResourceRequestController::class, 'changeStatus'])->name('change-status');
            Route::post('/change-status', [ResourceRequestController::class, 'changeStatusUpdate'])->name('change-status-update');
        });

        //Visit Request
        Route::group(['namespace' => 'visit', 'as' => 'visit-', 'prefix' => 'visit'], function () {
            Route::get('/index', [ScheduleVisitRequestController::class, 'index'])->name('index');
            Route::get('/add', [ScheduleVisitRequestController::class, 'add'])->name('add');
            Route::get('/list', [ScheduleVisitRequestController::class, 'getList'])->name('list');
            Route::post('/store', [ScheduleVisitRequestController::class, 'store'])->name('store');
            Route::get('/view/{id?}', [ScheduleVisitRequestController::class, 'action'])->name('view');
            Route::post('/update', [ScheduleVisitRequestController::class, 'store'])->name('update');

            Route::get('/change-status/{id?}', [ScheduleVisitRequestController::class, 'changeStatus'])->name('change-status');
            Route::post('/change-status', [ScheduleVisitRequestController::class, 'changeStatusUpdate'])->name('change-status-update');
        });

        //required resources
        Route::group(['namespace' => 'required-resources', 'as' => 'required-resources-', 'prefix' => 'required-resources'], function () {
            Route::get('/index', [RequiredResourcesController::class, 'index'])->name('index');
            Route::get('/add', [RequiredResourcesController::class, 'add'])->name('add');
            Route::post('/store', [RequiredResourcesController::class, 'store'])->name('store');
            Route::get('/list', [RequiredResourcesController::class, 'getList'])->name('list');
            Route::get('/edit/{id?}', [RequiredResourcesController::class, 'edit'])->name('edit');
            Route::post('/delete', [RequiredResourcesController::class, 'delete'])->name('delete');
        });

        //event request
        Route::group(['namespace' => 'event-request', 'as' => 'event-request-', 'prefix' => 'event-request'], function () {
            Route::get('/index', [EventRequestController::class, 'index'])->name('index');
            Route::get('/add', [EventRequestController::class, 'add'])->name('add');
            Route::post('/store', [EventRequestController::class, 'store'])->name('store');
            Route::get('/list', [EventRequestController::class, 'getList'])->name('list');
            Route::get('/view/{id?}', [EventRequestController::class, 'action'])->name('view');
            Route::get('/change-status/{id?}', [EventRequestController::class, 'changeStatus'])->name('change-status');
            Route::post('/change-status', [EventRequestController::class, 'changeStatusUpdate'])->name('change-status-update');
        });

        //workshop request
        Route::group(['namespace' => 'workshop-request', 'as' => 'workshop-request-', 'prefix' => 'workshop-request'], function () {
            Route::get('/index', [WorkshopRequestController::class, 'index'])->name('index');
            Route::get('/add', [WorkshopRequestController::class, 'add'])->name('add');
            Route::post('/store', [WorkshopRequestController::class, 'store'])->name('store');
            Route::get('/list', [WorkshopRequestController::class, 'getList'])->name('list');
            Route::get('/view/{id?}', [WorkshopRequestController::class, 'action'])->name('view');
            Route::get('/change-status/{id?}', [WorkshopRequestController::class, 'changeStatus'])->name('change-status');
            Route::post('/change-status', [WorkshopRequestController::class, 'changeStatusUpdate'])->name('change-status-update');
        });

        //General reservation request
        Route::group(['namespace' => 'general-reservation', 'as' => 'general-reservation-', 'prefix' => 'general-reservation'], function () {
            Route::get('/index', [GeneralReservationRequest::class, 'index'])->name('index');
            Route::get('/add', [GeneralReservationRequest::class, 'add'])->name('add');
            Route::post('/store', [GeneralReservationRequest::class, 'store'])->name('store');
            Route::get('/list', [GeneralReservationRequest::class, 'getList'])->name('list');
            Route::get('/view/{id?}', [GeneralReservationRequest::class, 'action'])->name('view');
            Route::get('/change-status/{id?}', [GeneralReservationRequest::class, 'changeStatus'])->name('change-status');
            Route::post('/change-status', [GeneralReservationRequest::class, 'changeStatusUpdate'])->name('change-status-update');
        });

        //Idea request
        Route::group(['namespace' => 'idea-request', 'as' => 'idea-request-', 'prefix' => 'idea-request'], function () {
            Route::get('/index', [IdeaRequestController::class, 'index'])->name('index');
            Route::get('/add', [IdeaRequestController::class, 'add'])->name('add');
            Route::post('/store', [IdeaRequestController::class, 'store'])->name('store');
            Route::get('/list', [IdeaRequestController::class, 'getList'])->name('list');
            Route::get('/view/{id?}', [IdeaRequestController::class, 'action'])->name('view');
            Route::get('/change-status/{id?}', [IdeaRequestController::class, 'changeStatus'])->name('change-status');
            Route::post('/change-status', [IdeaRequestController::class, 'changeStatusUpdate'])->name('change-status-update');
//            Route::get('/edit/{id?}', [ImplementationLevelController::class, 'edit'])->name('edit');
//            Route::post('/delete', [ImplementationLevelController::class, 'delete'])->name('delete');
        });

        //Idea request technology
        Route::group(['namespace' => 'technology', 'as' => 'technology-', 'prefix' => 'technology'], function () {
            Route::get('/index', [IdeaRequestTechnologyController::class, 'index'])->name('index');
            Route::get('/add', [IdeaRequestTechnologyController::class, 'add'])->name('add');
            Route::post('/store', [IdeaRequestTechnologyController::class, 'store'])->name('store');
            Route::get('/list', [IdeaRequestTechnologyController::class, 'getList'])->name('list');
            Route::get('/edit/{id?}', [IdeaRequestTechnologyController::class, 'edit'])->name('edit');
            Route::post('/delete', [IdeaRequestTechnologyController::class, 'delete'])->name('delete');
        });

        //Idea request current implementation level
        Route::group(['namespace' => 'implementation-level', 'as' => 'implementation-level-', 'prefix' => 'implementation-level'], function () {
            Route::get('/index', [ImplementationLevelController::class, 'index'])->name('index');
            Route::get('/add', [ImplementationLevelController::class, 'add'])->name('add');
            Route::post('/store', [ImplementationLevelController::class, 'store'])->name('store');
            Route::get('/list', [ImplementationLevelController::class, 'getList'])->name('list');
            Route::get('/edit/{id?}', [ImplementationLevelController::class, 'edit'])->name('edit');
            Route::post('/delete', [ImplementationLevelController::class, 'delete'])->name('delete');
        });
        //Incubator request
        Route::group(['namespace' => 'incubator-request', 'as' => 'incubator-request-', 'prefix' => 'incubator-request'], function () {
            Route::get('/index', [IncubatorRequestController::class, 'index'])->name('index');
            Route::get('/add', [IncubatorRequestController::class, 'add'])->name('add');
            Route::post('/store', [IncubatorRequestController::class, 'store'])->name('store');
            Route::get('/view/{id?}', [IncubatorRequestController::class, 'action'])->name('view');
            Route::get('/change-status/{id?}', [IncubatorRequestController::class, 'changeStatus'])->name('change-status');
            // Route::post('/change-status', [WorkshopRequestController::class, 'changeStatusUpdate'])->name('change-status-update');
        });

    });

});
