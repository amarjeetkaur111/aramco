<?php

namespace App\Http\Controllers\web\Services;
use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Apis\event_request;
use App\Models\Apis\incubator_request;
use App\Models\Apis\technology_workshop_request;
use App\Models\Apis\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\admin\Apis\ReservationController;

class SendInvitationController extends Controller
{
    private $ReservationController;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
    }

    public function sendInvite($module, $event_id)
    {
        try {
            $hidden_form = "";
            $getData = "";

            $invite_request_table = $this->getModuleWiseInvitesRequestTable($module);
            $getUsers = User::leftJoin($invite_request_table[0], $invite_request_table[0] . '.email', 'users.email')
                ->where('users.status', 'Approved')
                //->groupBy('users.email')
                ->get([
                    DB::raw("CONCAT(users.first_name,' ',users.last_name) as name"),
                    'users.email',
                    'users.id',
                    $invite_request_table[0] . '.display_name',
                    $invite_request_table[0] . '.' . $invite_request_table[1] .' as event_invite_id'
                ]);

            if ($module == "hosted-event") {
                $getData = event_request::find($event_id);
                $hidden_form = 'pages.web.services.HostEvent.host-event-hidden-form';

            } elseif ($module == "reserve-incubator") {
                $getData = incubator_request::find($event_id);
                $hidden_form = 'pages.web.services.reserveIncubator.reserve-incubator-hidden-form';

            } elseif ($module == "reserve-technology") {
                $getData = technology_workshop_request::find($event_id);
                $hidden_form = 'pages.web.services.reserveTech.reserve-technology-hidden-form';
            }

            return view('pages.web.services.send-invites', compact('getUsers', 'module', 'event_id', 'getData', 'hidden_form'));

        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong!']);
        }
    }

    public function storeInviteData(Request $request)
    {
        try {
            $get_redirect_url = CommonFunction::inviteModuleWiseCancelUrl($request->module_name);

            if ($request->module_name == "hosted-event") {
                $response = $this->ReservationController->updateEventRequest($request);

                if ($response->getData()->data) {
                    return redirect()->route($get_redirect_url, ['id' => $request->event_id])->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }

            if ($request->module_name == "reserve-incubator") {
                $response = $this->ReservationController->updateReserveIncubatorRequest($request);

                if ($response->getData()->data) {
                    return redirect()->route($get_redirect_url, ['id' => $request->reserve_incubator_id])->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }

            if ($request->module_name == "reserve-technology") {
                $response = $this->ReservationController->updateTechnologyWorkshopRequest($request);

                if ($response->getData()->data) {
                    return redirect()->route($get_redirect_url, ['id' => $request->technology_workshop_id])->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }

        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong!']);
        }
    }

    public function getModuleWiseInvitesRequestTable(string $module):array
    {
        if ($module == "hosted-event") {
            return [
                '0' => 'event_request_invitees',
                '1' => 'event_request_id',
            ];
        } elseif ($module == "reserve-incubator") {
            return [
                '0' => 'incubator_request_invitees',
                '1' => 'incubator_request_id'
            ];
        } elseif ($module == "reserve-technology") {
            return [
                '0' => 'technology_workshop_request_invitees',
                '1' => 'technology_workshop_request_id',
            ];
        }

        return [];
    }


}
