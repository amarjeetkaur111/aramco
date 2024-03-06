<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\CalendarController;
use App\Models\Apis\calendar_events;
use App\Models\Apis\calendar_events_registrations;
use App\Models\Apis\User;
use Illuminate\Contracts\Session\Session;
use Auth;

class CalenderController extends Controller
{
    private $CalendarController;

    public function __construct()
    {
        $this->CalendarController = new CalendarController();
    }

    public function index()
    {
        return view('pages.web.calendar.calendar-form');
    }
    public function calendar(){
        $id = Auth::user()->id;
        $events = calendar_events::with(['calendar_events_registrations' => function($q) use($id){
            return $q->where('users_id',$id);
        }])->where('is_deleted',0)->orderBy('id','DESC')->get()->toArray();

        $unregistered = array_values(array_filter($events, static function ($e) {
            return count($e['calendar_events_registrations']) == 0;
        }));

        $registered = array_values(array_filter($events, static function ($e) {
            return count($e['calendar_events_registrations']) > 0;
        }));
        // echo"<pre>";print_r($id);exit();
        return view('pages.web.calendar.calendar',compact('unregistered','registered'));
    }

    public function createPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'calendar_image' => 'required',
        ]);

        $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
        $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));
        $create_event = $this->CalendarController->CreateCalendarEvent($request);
        if ($create_event->getData()->success) {
            return redirect()->route('calender-calendar')->with(['status' => 'Success', 'class' => 'success', 'msg' => $create_event->getData()->message]);
        } else {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $create_event->getData()->message]);
        }

    }
    public function deleteEvent(Request $request)
    {
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        $response= $this->CalendarController->DeleteCalendarEvent($request)->getData();
        if ($response->success==true) {
            return response()->json(['status' => 'Success', 'msg'=> $response->data]);
        } else {
            return response()->json(['status' => 'Success', 'msg'=> $response->message]);
        }
    }

    public function registerEvent(Request $request)
    {
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        $response= $this->CalendarController->RegisterCalendarEvent($request)->getData();
        if ($response->success==true) {
            return response()->json(['status' => 'Success', 'msg'=> $response->data]);
        } else {
            return response()->json(['status' => 'Success', 'msg'=> 'Something Went Wrong!Try again later.']);
        }
    }

    public function editEvent(int $id)
    {
        $getEvent = calendar_events::find($id);
        return view('pages.web.calendar.edit-calendar', compact('getEvent'));
    }

    public function updateEvent(Request $request)
    {
        $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
        $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));

        $update_event = $this->CalendarController->UpdateCalendarEvent($request);

        if ($update_event->getData()->success) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $update_event->getData()->data]);
        }
        else
        {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $update_event->getData()->message]);
        }
    }

    public function eventManagement(Request $request)
    {
        $event_list = calendar_events_registrations::with('calendarEvent')->with('user:id,first_name,email')->orderBy('created_at', 'DESC')->paginate(10);

        if ($request->ajax()) {
            $view = view('pages.web.calendar.load-event-data', compact('event_list'))->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.calendar.event-management', compact('event_list'));
    }

    public function eventDetails(int $id,int $userid)
    {
        $calendar_event = calendar_events_registrations::leftJoin('calendar_events', 'calendar_events.id', '=', 'calendar_events_registrations.calendar_events_id')
            ->leftJoin('users', 'users.id', '=', 'calendar_events_registrations.users_id')
            ->where('calendar_events.id', $id)
            ->where('users_id',$userid)
            ->first([
                'users.first_name',
                'users.email',
                'users.google_id',
                'calendar_events.id',
                'calendar_events.title',
                'calendar_events.description',
                'calendar_events_registrations.status',
            ]);

        return view('pages.web.calendar.event-details', compact('calendar_event'));
    }

    public function singleEventStatusChange(Request $request)
    {
        try {
            $change_status = $this->CalendarController->ChangeCalendarEventRegistrationStatus($request);
            if ($change_status->getData()->success) {
                return redirect()->route('calender-admin-event-management')->with(['status' => 'Success', 'class' => 'success', 'msg' => $change_status->getData()->data]);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $change_status->getData()->message]);
            }
        }catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }

    public function eventStatusChange(Request $request)
    {
        try {
            $change_status = $this->CalendarController->changeCalendarEventRegistrationStatusBulk($request);
            if ($change_status->getData()->success) {
                return redirect()->route('calender-admin-event-management')->with(['status' => 'Success', 'class' => 'success', 'msg' => $change_status->getData()->data]);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $change_status->getData()->message]);
            }
        }catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }
}
