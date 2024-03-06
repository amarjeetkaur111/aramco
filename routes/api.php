<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login'])->withoutMiddleware("throttle:api");


Route::middleware('auth:api')->group( function () {

    Artisan::call('optimize:clear');

    Route::post('/makeuser', [\App\Http\Controllers\admin\Apis\UserController::class, 'createUser'])->name('makeuser')->withoutMiddleware("throttle:api");
    Route::post('/updateuserprofile', [\App\Http\Controllers\admin\Apis\UserController::class, 'updateUserProfile'])->name('updateuserprofile')->withoutMiddleware("throttle:api");
    Route::post('/deleteuserprofile', [\App\Http\Controllers\admin\Apis\UserController::class, 'deleteUserProfile'])->name('deleteuserprofile')->withoutMiddleware("throttle:api");
    Route::post('/updatetwofactor', [\App\Http\Controllers\admin\Apis\UserController::class, 'updatetwofactor'])->name('updatetwofactor')->withoutMiddleware("throttle:api");
    Route::post('/changeRole', [\App\Http\Controllers\admin\Apis\UserController::class, 'changeRole'])->name('changeRole')->withoutMiddleware("throttle:api");
    Route::post('/getallusers', [\App\Http\Controllers\admin\Apis\UserController::class, 'getAllUsers'])->name('getallusers')->withoutMiddleware("throttle:api");
    Route::post('/getalluserslimiteddata', [\App\Http\Controllers\admin\Apis\UserController::class, 'getAllUsersLimitedData'])->name('getalluserslimiteddata')->withoutMiddleware("throttle:api");
    Route::get('/getallroles', [\App\Http\Controllers\admin\Apis\UserController::class, 'getAllRoles'])->name('getallroles')->withoutMiddleware("throttle:api");
    Route::get('/getquestionaire', [\App\Http\Controllers\admin\Apis\UserController::class, 'getQuestionaire'])->name('getquestionaire')->withoutMiddleware("throttle:api");
    Route::post('/postanswer', [\App\Http\Controllers\admin\Apis\UserController::class, 'postAnswer'])->name('postanswer')->withoutMiddleware("throttle:api");
    Route::post('/getuseranswers', [\App\Http\Controllers\admin\Apis\UserController::class, 'getuserAnswers'])->name('getuseranswers')->withoutMiddleware("throttle:api");
    Route::post('/changerequeststatus', [\App\Http\Controllers\admin\Apis\UserController::class, 'ChangeProfileRequestStatus'])->name('changerequeststatus')->withoutMiddleware("throttle:api");
    Route::post('/profilecompletitionrequest', [\App\Http\Controllers\admin\Apis\UserController::class, 'profileCompletitionRequest'])->name('profilecompletitionrequest')->withoutMiddleware("throttle:api");
    Route::post('/getallprofilerequests', [\App\Http\Controllers\admin\Apis\UserController::class, 'getAllProfilerequests'])->name('getallprofilerequests')->withoutMiddleware("throttle:api");

    Route::post('/fcm-token-api', [\App\Http\Controllers\admin\Apis\UserController::class, 'updateTokenAPI'])->name('fcmTokenAPI')->withoutMiddleware("throttle:api");

    Route::post('/notificationApi', [\App\Http\Controllers\admin\Apis\UserController::class, 'notificationAPI'])->name('notificationAPI')->withoutMiddleware("throttle:api");
    Route::post('/getSenderNotifications', [\App\Http\Controllers\admin\Apis\UserController::class, 'getSenderNotifications'])->name('getSenderNotifications')->withoutMiddleware("throttle:api");
    Route::post('/getReceiverNotifications', [\App\Http\Controllers\admin\Apis\UserController::class, 'getReceiverNotifications'])->name('getReceiverNotifications')->withoutMiddleware("throttle:api");
    Route::post('/setNotificationOnOff', [\App\Http\Controllers\admin\Apis\UserController::class, 'setNotificationOnOff'])->name('setNotificationOnOff')->withoutMiddleware("throttle:api");
    Route::post('/getNotificationOnOff', [\App\Http\Controllers\admin\Apis\UserController::class, 'getNotificationOnOff'])->name('getNotificationOnOff')->withoutMiddleware("throttle:api");


    Route::post('/getalleventrequests', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllEventRequests'])->name('getalleventrequests')->withoutMiddleware("throttle:api");
    Route::post('/getallschedulevisitrequests', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllScheduleVisitRequests'])->name('getallschedulevisitrequests')->withoutMiddleware("throttle:api");
    Route::post('/getallreserveincubatorrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllreserveIncubatorRequest'])->name('getallreserveincubatorrequest')->withoutMiddleware("throttle:api");
    Route::get('/getallrequiredresourceslist', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllRequiredResourcesList'])->name('getallrequiredresourceslist')->withoutMiddleware("throttle:api");
    Route::get('/getalltechnologylist', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllTechnologyList'])->name('getalltechnologylist')->withoutMiddleware("throttle:api");
    Route::get('/getallcurrentimplementationlist', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllCurrentImplementationList'])->name('getallcurrentimplementationlist')->withoutMiddleware("throttle:api");
    Route::post('/getallgeneralreservationrequests', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllGeneralReservation'])->name('getallgeneralreservationrequests')->withoutMiddleware("throttle:api");

    Route::post('/getallcomputingresourcesrequests', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllComputingResourcesRequest'])->name('getallcomputingresourcesrequests')->withoutMiddleware("throttle:api");
    Route::post('/getalltechnologyworkshoprequests', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllTechnologyWorkshopRequest'])->name('getalltechnologyworkshoprequests')->withoutMiddleware("throttle:api");
    Route::post('/getallidearequests', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllIdeaRequest'])->name('getallidearequests')->withoutMiddleware("throttle:api");


    Route::post('/hosteventrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'hostEventRequest'])->name('hosteventrequest')->withoutMiddleware("throttle:api");
    Route::post('/updateeventrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateEventRequest'])->name('updateeventrequest')->withoutMiddleware("throttle:api");
    Route::post('/changeeventrequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeEventRequestStatus'])->name('changeeventrequeststatus')->withoutMiddleware("throttle:api");
    Route::post('/checkexcitingevent', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'checkExcitingEvent'])->name('checkexcitingevent')->withoutMiddleware("throttle:api");


    Route::post('/schedulevisitrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'scheduleVisitRequest'])->name('schedulevisitrequest')->withoutMiddleware("throttle:api");
    Route::post('/updateschedulevisitrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateScheduleVisitRequest'])->name('updateschedulevisitrequest')->withoutMiddleware("throttle:api");
    Route::post('/changeschedulevisitrequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeScheduleVisitRequestStatus'])->name('changeschedulevisitrequeststatus')->withoutMiddleware("throttle:api");

    Route::post('/generalreservationrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'generalReservation'])->name('generalreservationrequest')->withoutMiddleware("throttle:api");
    Route::post('/updategeneralreservationrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateGeneralReservation'])->name('updategeneralreservationrequest')->withoutMiddleware("throttle:api");
    Route::post('/changegeneralreservationrequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeGeneralReservationStatus'])->name('changegeneralreservationrequeststatus')->withoutMiddleware("throttle:api");


    Route::post('/reserveincubatorrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'reserveIncubatorRequest'])->name('reserveincubatorrequest')->withoutMiddleware("throttle:api");
    Route::post('/updatereserveincubatorrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateReserveIncubatorRequest'])->name('updatereserveincubatorrequest')->withoutMiddleware("throttle:api");
    Route::post('/changereserveincubatorrequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeReserveIncubatorRequestStatus'])->name('changereserveincubatorrequeststatus')->withoutMiddleware("throttle:api");
    Route::post('/checkexistingincubatorrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'checkExistingIncubatorRequest'])->name('checkexistingincubatorrequest')->withoutMiddleware("throttle:api");


    Route::post('/computingresourcesrequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'computingResourcesRequest'])->name('computingresourcesrequest')->withoutMiddleware("throttle:api");
    Route::post('/updatecomputingresourcerequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateComputingResourceRequest'])->name('updatecomputingresourcerequest')->withoutMiddleware("throttle:api");
    Route::post('/changecomputingresourcerequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeComputingResourceRequestStatus'])->name('changecomputingresourcerequeststatus')->withoutMiddleware("throttle:api");


    Route::post('/technologyworkshoprequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'technologyWorkshopRequest'])->name('technologyworkshoprequest')->withoutMiddleware("throttle:api");
    Route::post('/updatetechnologyworkshoprequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateTechnologyWorkshopRequest'])->name('updatetechnologyworkshoprequest')->withoutMiddleware("throttle:api");
    Route::post('/changetechnologyworkshoprequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeTechnologyWorkshopRequestStatus'])->name('changetechnologyworkshoprequeststatus')->withoutMiddleware("throttle:api");
    Route::post('/checkexistingworkshoprequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'checkExistingWorkshopRequest'])->name('checkexistingworkshoprequest')->withoutMiddleware("throttle:api");


    Route::post('/idearequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ideaRequest'])->name('idearequest')->withoutMiddleware("throttle:api");
    Route::post('/updateidearequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'updateIdeaRequest'])->name('updateidearequest')->withoutMiddleware("throttle:api");
    Route::post('/changeidearequeststatus', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'ChangeIdeaRequestStatus'])->name('changeidearequeststatus')->withoutMiddleware("throttle:api");

    Route::post('/getuseractivity', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getUserActivity'])->name('getuseractivity')->withoutMiddleware("throttle:api");



    Route::post('/createeventrobin', [\App\Http\Controllers\admin\Apis\RobinpoweredController::class, 'CreateEvent'])->name('createeventrobin')->withoutMiddleware("throttle:api");


    Route::post('/cancelEventRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelEventRequest'])->name('cancelEventRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelEventRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelEventRequest'])->name('approveCancelEventRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllEventCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllEventCancellations'])->name('getAllEventCancellations')->withoutMiddleware("throttle:api");


    Route::post('/cancelWorkshopRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelWorkshopRequest'])->name('cancelWorkshopRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelWorkshopRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelWorkshopRequest'])->name('approveCancelWorkshopRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllWorkshopCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllWorkshopCancellations'])->name('getAllWorkshopCancellations')->withoutMiddleware("throttle:api");

    Route::post('/cancelIncubatorRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelIncubatorRequest'])->name('cancelIncubatorRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelIncubatorRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelIncubatorRequest'])->name('approveCancelIncubatorRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllIncubatorCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllIncubatorCancellations'])->name('getAllIncubatorCancellations')->withoutMiddleware("throttle:api");

    Route::post('/cancelVisitRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelVisitRequest'])->name('cancelVisitRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelVisitRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelVisitRequest'])->name('approveCancelVisitRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllVisitCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllVisitCancellations'])->name('getAllVisitCancellations')->withoutMiddleware("throttle:api");

    Route::post('/cancelComputingResourceRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelComputingResourceRequest'])->name('cancelComputingResourceRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelComputingResourceRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelComputingResourceRequest'])->name('approveCancelComputingResourceRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllComputingResourceCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllComputingResourceCancellations'])->name('getAllComputingResourceCancellations')->withoutMiddleware("throttle:api");

    Route::post('/cancelIdeaRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelIdeaRequest'])->name('cancelIdeaRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelIdeaRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelIdeaRequest'])->name('approveCancelIdeaRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllIdeaCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllIdeaCancellations'])->name('getAllIdeaCancellations')->withoutMiddleware("throttle:api");

    Route::post('/cancelGeneralReservationRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'cancelGeneralReservationRequest'])->name('cancelGeneralReservationRequest')->withoutMiddleware("throttle:api");
    Route::post('/approveCancelGeneralReservationRequest', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'approveCancelGeneralReservationRequest'])->name('approveCancelGeneralReservationRequest')->withoutMiddleware("throttle:api");
    Route::post('/getAllGeneralReservationCancellations', [\App\Http\Controllers\admin\Apis\ReservationController::class, 'getAllGeneralReservationCancellations'])->name('getAllGeneralReservationCancellations')->withoutMiddleware("throttle:api");


    Route::post('/sendfeedback', [\App\Http\Controllers\admin\Apis\UserController::class, 'Sendfeedback'])->name('sendfeedback')->withoutMiddleware("throttle:api");
    Route::post('/getallfeedback', [\App\Http\Controllers\admin\Apis\UserController::class, 'getallFeedbacks'])->name('getallfeedback')->withoutMiddleware("throttle:api");
    Route::post('/respondfeedback', [\App\Http\Controllers\admin\Apis\UserController::class, 'Respondfeedback'])->name('respondfeedback')->withoutMiddleware("throttle:api");
    Route::post('/feedbackonflag', [\App\Http\Controllers\admin\Apis\UserController::class, 'FeedbackOnFlag'])->name('feedbackonflag')->withoutMiddleware("throttle:api");




    Route::post('/sendhelprequest', [\App\Http\Controllers\admin\Apis\HelpController::class, 'SendHelpRequest'])->name('sendhelprequest')->withoutMiddleware("throttle:api");
    Route::post('/getallhelprequest', [\App\Http\Controllers\admin\Apis\HelpController::class, 'getallHelpRequests'])->name('getallhelprequest')->withoutMiddleware("throttle:api");
    Route::post('/getallhelprequestuser', [\App\Http\Controllers\admin\Apis\HelpController::class, 'getallHelpRequestsUser'])->name('getallhelprequestuser')->withoutMiddleware("throttle:api");
    Route::post('/respondhelprequest', [\App\Http\Controllers\admin\Apis\HelpController::class, 'RespondHelpRequest'])->name('respondhelprequest')->withoutMiddleware("throttle:api");



    Route::post('/getallfaqs', [\App\Http\Controllers\admin\Apis\FaqController::class, 'getAllFaqs'])->name('getallfaqs')->withoutMiddleware("throttle:api");


    Route::post('/getusercontrols', [\App\Http\Controllers\admin\Apis\ControlSystemController::class, 'getUsersControl'])->name('getusercontrols')->withoutMiddleware("throttle:api");
    Route::post('/modifyusercontrols', [\App\Http\Controllers\admin\Apis\ControlSystemController::class, 'ModifyUsersControl'])->name('modifyusercontrols')->withoutMiddleware("throttle:api");
    Route::post('/modifyusercontrolsall', [\App\Http\Controllers\admin\Apis\ControlSystemController::class, 'ModifyUsersControlAll'])->name('modifyusercontrolsall')->withoutMiddleware("throttle:api");








    Route::post('/createcalendarevent', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'CreateCalendarEvent'])->name('createcalendarevent')->withoutMiddleware("throttle:api");
    Route::post('/updatecalendarevent', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'UpdateCalendarEvent'])->name('updatecalendarevent')->withoutMiddleware("throttle:api");
    Route::post('/getcalendarevents', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'GetCalendarEvents'])->name('getcalendarevents')->withoutMiddleware("throttle:api");
    Route::post('/registercalendarevent', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'RegisterCalendarEvent'])->name('registercalendarevent')->withoutMiddleware("throttle:api");
    Route::post('/getallregistrationreuqests', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'GetAllEventRegisterRequests'])->name('getallregistrationreuqests')->withoutMiddleware("throttle:api");
    Route::post('/changecalendareventstatus', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'ChangeCalendarEventRegistrationStatus'])->name('changecalendareventstatus')->withoutMiddleware("throttle:api");
    Route::post('/changecalendareventstatusbulk', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'changeCalendarEventRegistrationStatusBulk'])->name('changecalendareventstatusbulk')->withoutMiddleware("throttle:api");
    Route::post('/deletecalendarevent', [\App\Http\Controllers\admin\Apis\CalendarController::class, 'DeleteCalendarEvent'])->name('deletecalendarevent')->withoutMiddleware("throttle:api");









    Route::post('/createchannel', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'CreateChannel'])->name('createchannel')->withoutMiddleware("throttle:api");
    Route::post('/getallchannels', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'GetAllChannels'])->name('getallchannels')->withoutMiddleware("throttle:api");
    Route::post('/deletechannel', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'DeleteChannel'])->name('deletechannel')->withoutMiddleware("throttle:api");
    Route::post('/blockchannel', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'BlockChannel'])->name('blockchannel')->withoutMiddleware("throttle:api");
    Route::post('/unblockchannel', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'UnBlockChannel'])->name('unblockchannel')->withoutMiddleware("throttle:api");
    Route::post('/getchannelsposts', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'GetChannelsAllPosts'])->name('getchannelsposts')->withoutMiddleware("throttle:api");
    Route::post('/getpostsallcomments', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'GetPostsAllComments'])->name('getpostsallcomments')->withoutMiddleware("throttle:api");
    Route::post('/getusersposts', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'GetUsersPosts'])->name('getusersposts')->withoutMiddleware("throttle:api");


    Route::post('/createpost', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'CreatePost'])->name('createpost')->withoutMiddleware("throttle:api");
    Route::post('/createlike', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'CreateLikeOnPost'])->name('createlike')->withoutMiddleware("throttle:api");
    Route::post('/createcomment', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'CreateCommentOnPost'])->name('createcomment')->withoutMiddleware("throttle:api");
    Route::post('/deletecomment', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'DeleteComment'])->name('deletecomment')->withoutMiddleware("throttle:api");
    Route::post('/deletepost', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'DeletePost'])->name('deletepost')->withoutMiddleware("throttle:api");
    Route::get('/getwelcomemessage', [\App\Http\Controllers\admin\Apis\ConnectSystemController::class, 'getWelcomeMessage'])->name('getwelcomemessage')->withoutMiddleware("throttle:api");




    Route::get('/aboutthelabpages', [\App\Http\Controllers\admin\Apis\AboutLabController::class, 'getPages'])->name('aboutthelabpages')->withoutMiddleware("throttle:api");
    Route::get('/aboutthelabcontent/{pageid}', [\App\Http\Controllers\admin\Apis\AboutLabController::class, 'getPageContent'])->name('aboutthelabcontent')->withoutMiddleware("throttle:api");
    Route::get('/getallar', [\App\Http\Controllers\admin\Apis\ArController::class, 'getAllAr'])->name('getallar')->withoutMiddleware("throttle:api");


});

