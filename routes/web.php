<?php

use App\Http\Controllers\web\HelpController;
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

Route::get('/', [\App\Http\Controllers\web\homeController::class, 'index'])->name('index');

Route::get('/login', function () {
    return view('pages.web.login.login',['section' => '1']);
})->name('weblogin');

Route::get('auth/google', [\App\Http\Controllers\authController::class, 'signInwithGoogle']);
Route::get('callback', [\App\Http\Controllers\authController::class, 'callbackToGoogle']);
Route::post('/complete-registration', [\App\Http\Controllers\authController::class,  'completeRegistration'])->name('complete.registration');
Route::get('/qna/{first_timer}', [\App\Http\Controllers\authController::class, 'qna'])->name('qna');
Route::post('/postqna', [\App\Http\Controllers\authController::class, 'postqna'])->name('postqna');
Route::get('/logout', [\App\Http\Controllers\authController::class, 'logout'])->name('logout');

Route::get('/faq', [\App\Http\Controllers\web\FaqController::class, 'index'])->name('faq');

//linkedin
Route::get('auth/linkedin', [\App\Http\Controllers\SocialiteController::class, 'redirectToLinkedin']);
Route::get('auth/linkedin/callback', [\App\Http\Controllers\SocialiteController::class, 'handleLinkedinCallback']);

//linkedin
Route::get('auth/twitter', [\App\Http\Controllers\SocialiteController::class, 'redirectToTwitter']);
Route::get('auth/twitter/callback', [\App\Http\Controllers\SocialiteController::class, 'handleTwitterCallback']);


Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'user', 'as' => 'user-', 'prefix' => 'user'], function () {
        Route::get('/profile', [\App\Http\Controllers\web\UserManagement::class, 'profile'])->name('profile');
        Route::post('/postprofile', [\App\Http\Controllers\web\UserManagement::class, 'postprofile'])->name('postprofile');
    });
    Route::middleware(['role:Super Admin|Admin'])->group(function () {
        Route::get('/profile_completion_list/{status?}', [\App\Http\Controllers\web\UserManagement::class, 'profile_list'])->name('profile_list');
        Route::get('/pending_user/{id}', [\App\Http\Controllers\web\UserManagement::class, 'pending_user'])->name('pending_user');
        Route::post('/change_status', [\App\Http\Controllers\web\UserManagement::class, 'change_status'])->name('change_status');
        Route::get('/users_list/{status?}', [\App\Http\Controllers\web\UserManagement::class, 'users_list'])->name('users_list');
        Route::get('/user_details/{id}', [\App\Http\Controllers\web\UserManagement::class, 'user_details'])->name('user_details');

        // User Control
        Route::group(['namespace' => 'user-control', 'as' => 'user-control-', 'prefix' => 'user-control'], function () {
            Route::get('/general', [\App\Http\Controllers\web\UserManagement::class, 'generalControl'])->name('general');
            Route::get('/users', [\App\Http\Controllers\web\UserManagement::class, 'usersControl'])->name('users');
            Route::post('/general-post', [\App\Http\Controllers\web\UserManagement::class, 'generalPost'])->name('general-post');
            Route::get('/user-control-settings/{id}', [\App\Http\Controllers\web\UserManagement::class, 'userControlSettings'])->name('user-control-settings');
            Route::post('/user-control-post', [\App\Http\Controllers\web\UserManagement::class, 'userControlPost'])->name('user-control-post');
            Route::post('/multiple-user-control-settings', [\App\Http\Controllers\web\UserManagement::class, 'multipleUserControlSettings'])->name('multiple-user-control-settings');
            Route::post('/multiple-user-control-settings-post', [\App\Http\Controllers\web\UserManagement::class, 'multipleUserControlPost'])->name('multiple-user-control-settings-post');
        });
    });
    Route::middleware(['role:Super Admin|Admin|Full Access User'])->group(function () {


        Route::group(['namespace' => 'services', 'as' => 'services-', 'prefix' => 'services'], function () {
            Route::get('/schedule-visit', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'requestScheduleVisit'])->name('schedule-visit');
            Route::post('/postScheduleVisit', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'postScheduleVisit'])->name('postScheduleVisit');

            Route::get('/host-event', [\App\Http\Controllers\web\Services\HostEventController::class, 'hostEvent'])->name('host-event');
            Route::post('/host-event-store', [\App\Http\Controllers\web\Services\HostEventController::class, 'hostEventStore'])->name('host-event-store');

            Route::get('/allocate-resource', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'allocateResource'])->name('allocate-resource');
            Route::post('/allocate-resource-store', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'allocateResourceStore'])->name('allocate-resource-store');

            Route::get('/reserve-incubator', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'reserveIncubator'])->name('reserve-incubator');
            Route::post('/reserve-incubator-store', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'reserveIncubatorStore'])->name('reserve-incubator-store');

            Route::get('/reserve-technology', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'reserveTech'])->name('reserve-technology');
            Route::post('/reserve-technology-store', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'reserveTechStore'])->name('reserve-technology-store');
            // Route::get('/reserve-technology', [\App\Http\Controllers\web\ServiceController::class, 'reserveTech'])->name('reserve-technology');
            // Route::get('/general-reservation', [\App\Http\Controllers\web\ServiceController::class, 'generalResrvation'])->name('general-reservation');

            Route::get('/general-reservation', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'generalResrvation'])->name('general-reservation');
            Route::post('/general-reservation-store', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'generalReserveStore'])->name('general-reservation-store');

            Route::get('/submit-idea', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'submitIdea'])->name('submit-idea');
            Route::post('/submit-idea-store', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'submitIdeaStore'])->name('submit-idea-store');

            Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {
                //Manage Schedule Visit...
                Route::get('/schedule-visit-list', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'scheduleVisitList'])->name('schedule-visit-list');
                Route::get('/schedule-visit-view/{id}', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'scheduleVisitDetail'])->name('schedule-visit-view');
                Route::post('/schedule-visit-change-status', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'scheduleVisitChangeStatus'])->name('schedule-visit-change-status');

                // Cancel routes
                Route::get('/cancel-schedule-visit-list', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'cancelscheduleVisitList'])->name('cancel-schedule-visit-list');
                Route::get('/cancel-schedule-visit-view/{id}', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'canclescheduleVisitDetail'])->name('cancel-schedule-visit-view');
                Route::post('/cancel-schedule-visit-post', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'cancelscheduleVisiPost'])->name('cancel-schedule-visit-post');

                //Manage Hosted Event...
                Route::get('/hosted-event-list', [\App\Http\Controllers\web\Services\HostEventController::class, 'hostedEventList'])->name('hosted-event-list');
                Route::get('/hosted-event-view/{id}', [\App\Http\Controllers\web\Services\HostEventController::class, 'hostedEventView'])->name('hosted-event-view');
                Route::post('/hosted-event-change-status', [\App\Http\Controllers\web\Services\HostEventController::class, 'hostedEventChangeStatus'])->name('hosted-event-change-status');
                Route::get('/send-invite/{module}/{id}', [\App\Http\Controllers\web\Services\SendInvitationController::class, 'sendInvite'])->name('send-invite');
                Route::post('/store-invite-data', [\App\Http\Controllers\web\Services\SendInvitationController::class, 'storeInviteData'])->name('store-invite-data');

                //Cancel Hosted Event routes
                Route::get('/cancel-hosted-event-list', [\App\Http\Controllers\web\Services\HostEventController::class, 'cancelHostedEventList'])->name('cancel-hosted-event-list');
                Route::get('/cancel-hosted-event-view/{id}', [\App\Http\Controllers\web\Services\HostEventController::class, 'cancelHostedEventView'])->name('cancel-hosted-event-view');
                Route::post('/cancel-hosted-event', [\App\Http\Controllers\web\Services\HostEventController::class, 'cancelHostedEvent'])->name('cancel-hosted-event');


                //Manage allocate computing resources
                Route::get('/allocate-resources-list', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'allocateResourceList'])->name('allocate-resources-list');
                Route::get('/allocate-resources-view/{id}', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'allocateResourceView'])->name('allocate-resources-view');
                Route::post('/allocate-resources-change-status', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'allocateResourceChangeStatus'])->name('allocate-resources-change-status');

                // Cancel allocate computing resources
                Route::get('/cancel-allocate-resources-list', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'cancelAllocateResourceList'])->name('cancel-allocate-resources-list');
                Route::get('/cancel-allocate-resources-view/{id}', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'cancelAllocateResourceView'])->name('cancel-allocate-resources-view');
                Route::post('/cancel-allocate-resources', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'cancelAllocateResource'])->name('cancel-allocate-resources');

                //Manage reserve incubator ..
                Route::get('/reserve-incubator-list', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'reserveIncubatorList'])->name('reserve-incubator-list');
                Route::get('/reserve-incubator-view/{id}', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'reserveIncubatorView'])->name('reserve-incubator-view');
                Route::post('/reserve-incubator-change-status', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'reserveIncubatorChangeStatus'])->name('reserve-incubator-change-status');

                // Cancel reserve incubator
                Route::get('/cancel-reserve-incubator-list', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'cancelReserveIncubatorList'])->name('cancel-reserve-incubator-list');
                Route::get('/cancel-reserve-incubator-view/{id}', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'cancelReserveIncubatorView'])->name('cancel-reserve-incubator-view');
                Route::post('/cancel-reserve-incubator', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'cancelReserveIncubator'])->name('cancel-reserve-incubator');

                //Manage reserve technology workshop ..
                Route::get('/reserve-technology-list', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'reserveTechnologyList'])->name('reserve-technology-list');
                Route::get('/reserve-technology-view/{id}', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'reserveTechnologyView'])->name('reserve-technology-view');
                Route::post('/reserve-technology-change-status', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'reserveTechnologyChangeStatus'])->name('reserve-technology-change-status');

                // Cancel technology workshop
                Route::get('/cancel-reserve-technology-list', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'cancelReserveTechnologyList'])->name('cancel-reserve-technology-list');
                Route::get('/cancel-reserve-technology-view/{id}', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'cancelReserveTechnologyView'])->name('cancel-reserve-technology-view');
                Route::post('/cancel-reserve-technology', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'cancelReserveTechnology'])->name('cancel-reserve-technology');

                //Manage submit idea
                Route::get('/submit-idea-list', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'submitIdeaList'])->name('submit-idea-list');
                Route::get('/submit-idea-view/{id}', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'submitIdeaView'])->name('submit-idea-view');
                Route::post('/submit-idea-change-status', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'submitIdeaChangeStatus'])->name('submit-idea-change-status');

                // Cancel submit idea
                Route::get('/cancel-submit-idea-list', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'cancelSubmitIdeaList'])->name('cancel-submit-idea-list');
                Route::get('/cancel-submit-idea-view/{id}', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'cancelSubmitIdeaView'])->name('cancel-submit-idea-view');
                Route::post('/cancel-submit-idea', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'cancelSubmitIdea'])->name('cancel-submit-idea');

                //Manage general reservation
                Route::get('/general-reservation-list', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'generalReservationList'])->name('general-reservation-list');
                Route::get('/general-reservation-view/{id}', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'generalReservationView'])->name('general-reservation-view');
                Route::post('/general-reservation-change-status', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'generalReservationChangeStatus'])->name('general-reservation-change-status');

                // Cancel general reservation
                Route::get('/cancel-general-reservation-list', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'cancelGeneralReservationList'])->name('cancel-general-reservation-list');
                Route::get('/cancel-general-reservation-view/{id}', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'cancelGeneralReservationView'])->name('cancel-general-reservation-view');
                Route::post('/cancel-general-reservation', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'cancelGeneralReservation'])->name('cancel-general-reservation');


            });

            Route::group(['namespace' => 'my-schedule-visits', 'as' => 'my-schedule-visits-', 'prefix' => 'my-schedule-visits'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'getUserScheduleVisits'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'editScheduleVisits'])->name('edit');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'editScheduleVisitsPost'])->name('edit-post');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\ScheduleVisitController::class, 'showScheduleVisits'])->name('show');
            });
            Route::group(['namespace' => 'my-hosted-events', 'as' => 'my-hosted-events-', 'prefix' => 'my-hosted-events'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\HostEventController::class, 'getUserHostedEvents'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\HostEventController::class, 'editHostVisits'])->name('edit');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\HostEventController::class, 'editHostVisitsPost'])->name('edit-post');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\HostEventController::class, 'showHostVisits'])->name('show');
            });
            Route::group(['namespace' => 'my-alocating-computing-events', 'as' => 'my-alocating-computing-events-', 'prefix' => 'my-alocating-computing-events'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'getUserComputingEvents'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'editComputingVisits'])->name('edit');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'editAllocatedVisitPost'])->name('edit-post');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\AllocateResourceController::class, 'showComputingVisits'])->name('show');
            });
            Route::group(['namespace' => 'my-reserve-incubator-events', 'as' => 'my-reserve-incubator-events-', 'prefix' => 'my-reserve-incubator-events'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'getReserveIncubatorEvents'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'editIncubatorVisits'])->name('edit');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'showIncubatorVisits'])->name('show');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\ReserveIncubatorController::class, 'editIncubatorPost'])->name('edit-post');
            });
            Route::group(['namespace' => 'my-reserve-tech-events', 'as' => 'my-reserve-tech-events-', 'prefix' => 'my-reserve-tech-events'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'getReserveTechEvents'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'editReserveTechReq'])->name('edit');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'showReserveTechReq'])->name('show');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\ReserveTechnologyWorkshopController::class, 'editReserveTechPost'])->name('edit-post');
            });
            Route::group(['namespace' => 'my-submit-idea', 'as' => 'my-submit-idea-', 'prefix' => 'my-submit-idea'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'getMySubmitIdea'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'editSubmitIdeaReq'])->name('edit');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'showSubmitIdeaReq'])->name('show');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\SubmitIdeaController::class, 'editSubmitIdeaPost'])->name('edit-post');
            });
            Route::group(['namespace' => 'my-general-reservation', 'as' => 'my-general-reservation-', 'prefix' => 'my-general-reservation'], function () {
                Route::get('/index', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'getMyGeneralReservation'])->name('index');
                Route::get('/edit/{id}', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'editGenResReq'])->name('edit');
                Route::get('/show/{id}', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'showGenResReq'])->name('show');
                Route::post('/edit-post', [\App\Http\Controllers\web\Services\GeneralReservationController::class, 'editGeneralResReqEditPost'])->name('edit-post');
            });
        });

        Route::get('/my-activity', [\App\Http\Controllers\web\ServiceController::class, 'myactivity'])->name('my-activity');
        Route::get('/my-activity-del-req', [\App\Http\Controllers\web\ServiceController::class, 'getDeleteRequeste'])->name('my-activity-del-req');

        Route::group(['namespace' => 'calender', 'as' => 'calender-', 'prefix' => 'calender'], function () {
            Route::get('/calendar', [\App\Http\Controllers\web\CalenderController::class, 'calendar'])->name('calendar');
            Route::get('/registerEvent', [\App\Http\Controllers\web\CalenderController::class, 'registerEvent'])->name('registerEvent');

            Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {
                Route::get('/create', [\App\Http\Controllers\web\CalenderController::class, 'index'])->name('create');
                Route::post('/createPost', [\App\Http\Controllers\web\CalenderController::class, 'createPost'])->name('createPost');
                Route::get('/deleteEvent', [\App\Http\Controllers\web\CalenderController::class, 'deleteEvent'])->name('deleteEvent');
                Route::get('/edit-event/{id}', [\App\Http\Controllers\web\CalenderController::class, 'editEvent'])->name('edit-event');
                Route::post('update-event', [\App\Http\Controllers\web\CalenderController::class, 'updateEvent'])->name('update-event');
                Route::get('event-management', [\App\Http\Controllers\web\CalenderController::class, 'eventManagement'])->name('event-management');
                Route::get('event-details/{id}/{userid}', [\App\Http\Controllers\web\CalenderController::class, 'eventDetails'])->name('event-details');
                Route::post('single-event-status-change', [\App\Http\Controllers\web\CalenderController::class, 'singleEventStatusChange'])->name('single-event-status-change');
                Route::post('event-status-change', [\App\Http\Controllers\web\CalenderController::class, 'eventStatusChange'])->name('event-status-change');
            });
        });

        Route::group(['namespace' => 'connect', 'as' => 'connect-', 'prefix' => 'connect'], function () {

            Route::get('/connect', [\App\Http\Controllers\web\ConnectController::class, 'connect'])->name('connect');
            Route::get('/newpost/{id}',[\App\Http\Controllers\web\ConnectController::class, 'newPost'])->name('newpost');
            Route::post('/createpost',[\App\Http\Controllers\web\ConnectController::class, 'createpost'])->name('createpost');
            Route::get('/internalChannels/{id}',[\App\Http\Controllers\web\ConnectController::class, 'internalChannels'])->name('internalChannels');
            Route::get('/myPosts',[\App\Http\Controllers\web\ConnectController::class, 'myPosts'])->name('myPosts');

            Route::post('/createComment',[\App\Http\Controllers\web\ConnectController::class, 'createComment'])->name('createComment');
            Route::post('/createLike',[\App\Http\Controllers\web\ConnectController::class, 'createLike'])->name('createLike');
            Route::post('/deletePost',[\App\Http\Controllers\web\ConnectController::class, 'deletePost'])->name('deletePost');
            Route::get('/getReceiverNotifications',[\App\Http\Controllers\web\ConnectController::class, 'getReceiverNotifications'])->name('getReceiverNotifications');

            //Admin
            Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {
                Route::get('/add-channel', [\App\Http\Controllers\web\ConnectController::class, 'addChannel'])->name('add-channel');
                Route::post('add-channel-post', [\App\Http\Controllers\web\ConnectController::class, 'addChannelPost'])->name('add-channel-post');
                Route::post('delete-channel', [\App\Http\Controllers\web\ConnectController::class, 'deleteChannel'])->name('delete-channel');
                Route::post('block-unblock-channel', [\App\Http\Controllers\web\ConnectController::class, 'blockUnblockChannel'])->name('block-unblock-channel');
                // Route::post('unblock-channel', [\App\Http\Controllers\web\ConnectController::class, 'deleteChannel'])->name('unblock-channel');
            });
        });

        //help route
        Route::group(['namespace' => 'help', 'as' => 'help-', 'prefix' => 'help'], function () {
            Route::get('/submit-request', [HelpController::class, 'index'])->name('submit-request');
            Route::post('/store-submit-request', [HelpController::class, 'storeSubmitRequest'])->name('store-submit-request');
            Route::get('/old-request', [HelpController::class, 'oldRequest'])->name('old-request');

        // Help System Management
            Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {
                Route::get('/help-system-management', [\App\Http\Controllers\web\HelpController::class, 'showHelprequests'])->name('help-system-management');
                Route::get('/help-system-query/{id}', [\App\Http\Controllers\web\HelpController::class, 'showHelprequestsDetail'])->name('help-system-query');
                Route::post('/help-system-query-store', [\App\Http\Controllers\web\HelpController::class, 'adminHelprequestComment'])->name('help-system-query-store');

            });
        });



        Route::group(['namespace' => 'notification', 'as' => 'notification-', 'prefix' => 'notification'], function () {
            Route::get('/index', [\App\Http\Controllers\web\NotificationController::class, 'index'])->name('index');
            Route::get('/feedback-form/{id}', function () {
                return view('pages.web.notification.feedback-form');
            })->name('feedback-form');
            Route::post('/sendFeedback', [\App\Http\Controllers\web\NotificationController::class, 'sendFeedback'])->name('sendFeedback');
            Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {
                Route::get('/pushNotification', [\App\Http\Controllers\web\NotificationController::class, 'pushNotification'])->name('pushNotification');
                Route::post('/pushNotificationPost', [\App\Http\Controllers\web\NotificationController::class, 'pushNotificationPost'])->name('pushNotificationPost');

                Route::get('/notificationDetail/{id}', [\App\Http\Controllers\web\NotificationController::class, 'notificationDetail'])->name('notificationDetail');
                Route::get('/notificationHistory', [\App\Http\Controllers\web\NotificationController::class, 'notificationHistory'])->name('notificationHistory');
            });
        });

    });
});

//Feedback route
Route::group(['namespace' => 'feedback', 'as' => 'feedback-', 'prefix' => 'feedback'], function () {
   // Feedback Management
    Route::group(['namespace' => 'admin', 'as' => 'admin-', 'prefix' => 'admin'], function () {
        Route::get('/', [\App\Http\Controllers\web\FeedbackController::class, 'index'])->name('index');
        Route::get('/admin-feedback/{id}', [\App\Http\Controllers\web\FeedbackController::class, 'showFeedbackDetail'])->name('admin-feedback');
        Route::post('/feedback-system-response-store', [\App\Http\Controllers\web\FeedbackController::class, 'adminFeedbackrequestComment'])->name('feedback-system-response-store');

    });
});

Route::get('/about-lab/{pageid?}', [\App\Http\Controllers\web\AboutLabController::class, 'index'])->name('about-lab');


Route::get('/privacy-policy', [\App\Http\Controllers\web\homeController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [\App\Http\Controllers\web\homeController::class, 'terms'])->name('terms');
Route::get('/cookie-notices', [\App\Http\Controllers\web\homeController::class, 'cookies'])->name('cookies');


// Route::get('/submit-request', function () {
//     return view('pages.web.submit-request');
// })->name('submit-request');

// Route::get('/old-requests', function () {
//     return view('pages.web.old-requests');
// })->name('old-requests');




Route::get('/my-posts', function () {
    return view('pages.web.my-posts');
})->name('my-posts');




Route::get('/all-activities', function () {
    return view('pages.web.all-activities');
})->name('all-activities');

// Route::get('/schedule-visit', function () {
//     return view('pages.web.schedule-visit');
// })->name('schedule-visit');

// Route::get('/hosted-events', function () {
//     return view('pages.web.hosted-events');
// })->name('hosted-events');

// Route::get('/alocated-computing-resources', function () {
//     return view('pages.web.alocated-computing-resources');
// })->name('alocated-computing-resources');

// Route::get('/reserved-incubator', function () {
//     return view('pages.web.reserved-incubator');
// })->name('reserved-incubator');

// Route::get('/reserved-technology-workshop-space', function () {
//     return view('pages.web.reserved-technology-workshop-space');
// })->name('reserved-technology-workshop-space');

// Route::get('/submit-an-idea', function () {
//     return view('pages.web.submit-an-idea');
// })->name('submit-an-idea');

// Route::get('/general-reservations', function () {
//     return view('pages.web.general-reservations');
// })->name('general-reservations');

Route::get('/about', function () {
    return view('pages.web.about');
})->name('about');


// Route::get('/user-profiles', function () {
//     return view('pages.web.user-profiles');
// })->name('user-profiles');

// Route::get('/user-profile-form', function () {
//     return view('pages.web.user-profile-form');
// })->name('user-profile-form');

// Route::get('/user-completion', function () {
//     return view('pages.web.user-completion');
// })->name('user-completion');

// Route::get('/user-completion-form', function () {
//     return view('pages.web.user-completion-form');
// })->name('user-completion-form');

//Route::get('/faq', function () {
//    return view('pages.web.faq');
//})->name('faq');

// Route::get('/add-channel', function () {
//     return view('pages.web.add-channel');
// })->name('add-channel');

Route::get('/user-control', function () {
    return view('pages.web.user-control');
})->name('user-control');

Route::get('/manage-service-scheduled-visit', function () {
    return view('pages.web.manage-service-scheduled-visit');
})->name('manage-service-scheduled-visit');

Route::get('/manage-service-scheduled-visit-form', function () {
    return view('pages.web.manage-service-scheduled-visit-form');
})->name('manage-service-scheduled-visit-form');

Route::get('/manage-service-hosted-event', function () {
    return view('pages.web.manage-service-hosted-event');
})->name('manage-service-hosted-event');

Route::get('/manage-service-hosted-event-form', function () {
    return view('pages.web.manage-service-hosted-event-form');
})->name('manage-service-hosted-event-form');

Route::get('/manage-allocated-computing-resources', function () {
    return view('pages.web.manage-allocated-computing-resources');
})->name('manage-allocated-computing-resources');

Route::get('/manage-allocated-computing-resources-form', function () {
    return view('pages.web.manage-allocated-computing-resources-form');
})->name('manage-allocated-computing-resources-form');

Route::get('/manage-reserved-incubator', function () {
    return view('pages.web.manage-reserved-incubator');
})->name('manage-reserved-incubator');

Route::get('/manage-reserved-incubator-form', function () {
    return view('pages.web.manage-reserved-incubator-form');
})->name('manage-reserved-incubator-form');

Route::get('/manage-reserved-technology-workshop', function () {
    return view('pages.web.manage-reserved-technology-workshop');
})->name('manage-reserved-technology-workshop');

Route::get('/manage-reserved-technology-workshop-form', function () {
    return view('pages.web.manage-reserved-technology-workshop-form');
})->name('manage-reserved-technology-workshop-form');

Route::get('/manage-submitted-idea', function () {
    return view('pages.web.manage-submitted-idea');
})->name('manage-submitted-idea');

Route::get('/manage-submitted-idea-form', function () {
    return view('pages.web.manage-submitted-idea-form');
})->name('manage-submitted-idea-form');

Route::get('/manage-general-reservation', function () {
    return view('pages.web.manage-general-reservation');
})->name('manage-general-reservation');

Route::get('/manage-general-reservation-form', function () {
    return view('pages.web.manage-general-reservation-form');
})->name('manage-general-reservation-form');

Route::get('/send-invities', function () {
    return view('pages.web.send-invities');
})->name('send-invities');


Route::get('/feedback-management', function () {
    return view('pages.web.feedback-management');
})->name('feedback-management');


Route::get('/event-management', function () {
    return view('pages.web.event-management');
})->name('event-management');

Route::get('/help-system-management', function () {
    return view('pages.web.help-system-management');
})->name('help-system-management');

// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// });
// Route::get('/login', function () {
//     return view('pages.login.login');
// });
// Route::get('/register', function () {
//     return view('pages.register.register');
// });
// Route::get('/profile', function () {
//     return view('pages.admin.profile');
// });


Route::get('/profile', [\App\Http\Controllers\admin\ApiController::class, 'login']);


Route::post('/fcm-token', [\App\Http\Controllers\admin\Apis\UserController::class, 'updateToken'])->name('fcmToken');
Route::post('/send-notification',[\App\Http\Controllers\admin\Apis\UserController::class, 'notification'])->name('notification');
Route::get('/giveAccessToUser', [\App\Http\Controllers\web\UserManagement::class, 'giveUserAccess'])->name('giveAccessToUser');
