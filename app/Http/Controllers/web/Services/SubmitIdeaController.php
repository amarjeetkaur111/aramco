<?php

namespace App\Http\Controllers\web\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\idea_request;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;

class SubmitIdeaController extends Controller
{
    //
    private $ReservationController;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
    }

    public function submitIdea(){
        $required_request = $this->ReservationController->getAllTechnologyList(new Request())->getData()->data;
        $implementation_request = $this->ReservationController->getAllCurrentImplementationList(new Request())->getData()->data;

        return view('pages.web.services.submitIdea.submit-idea',compact('required_request','implementation_request'));
    }

    public function submitIdeaStore(Request $request)
    {
        $this->validate($request, [
            'track_channel' => 'required',
            'idea_name' => 'required',
            'idea_problem' => 'required',
            'idea_solution' => 'required',
            'idea_resource_requirement' => 'required',
            'contributors' => 'required',
            'point_of_contact' => 'required',
            'technology' => 'required',
            // 'other_technology' => 'required',
            'current_implementation_level' => 'required',
            'attachment' => 'required',
        ]);

        $response = $this->ReservationController->ideaRequest($request);
        if($response->getData()->data)
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' =>'Idea Request Submitted Successfully']);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
    }

    public function submitIdeaList(Request $request)
    {
        // $getSubmitIdea = idea_request::with('user')->orderBy('idea_request.created_at', 'DESC')->paginate(10);
        $getSubmitIdea = idea_request::with('user')->orderBy('idea_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getSubmitIdea, 'action' => 'services-admin-submit-idea-view'])->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.web.services.submitIdea.manage-submit-idea-list', ['lists' => $getSubmitIdea, 'action' => 'services-admin-submit-idea-view']);
    }

    public function submitIdeaView(int $id)
    {
        $getSubmitIdea = idea_request::with('user')->orderBy('idea_request.created_at', 'DESC')->find($id);
        $technologiesList = $this->ReservationController->getAllTechnologyList(new Request())->getData()->data;
        $implementationList = $this->ReservationController->getAllCurrentImplementationList(new Request())->getData()->data;

        return view('pages.web.services.submitIdea.manage-submit-idea-form', compact('getSubmitIdea', 'technologiesList', 'implementationList'));
    }

    public function submitIdeaChangeStatus(Request $request)
    {
        $this->validate($request, [
            'track_channel' => 'required',
            'idea_name' => 'required',
            'idea_problem' => 'required',
            'idea_solution' => 'required',
            'idea_resource_requirement' => 'required',
            'contributors' => 'required',
            'point_of_contact' => 'required',
            'technology' => 'required',
            'current_implementation_level' => 'required',
        ]);

        if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
            $response = $this->ReservationController->ChangeIdeaRequestStatus($request);

            if ($response->getData()->success) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }

        if ($request->status_of_request == "modify") {
            $response = $this->ReservationController->updateIdeaRequest($request);

            if($response->getData()->success)
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
        }
    }

    // My Submit Idea Functionalities
    public function getMySubmitIdea(Request $request)
    {
        $users_id = Session('auth_userid');
        $getIdea = idea_request::where('users_id',$users_id)->orderBy('created_at', 'DESC')->paginate(10);

        if ($request->ajax()) {
            $view = view('pages.web.services.load-my-data', ['lists' => $getIdea, 'type'=>'idea', 'action' => 'services-my-submit-idea-edit', 'actionShow' => 'services-my-submit-idea-show'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.submitIdea.my-submit-idea', ['lists' => $getIdea, 'type'=>'idea', 'action' => 'services-my-submit-idea-edit', 'actionShow' => 'services-my-submit-idea-show']);
    }
    public function editSubmitIdeaReq(int $id)
    {
        $getSubmitIdea = idea_request::with('user')->orderBy('idea_request.created_at', 'DESC')->find($id);
        $technologiesList = $this->ReservationController->getAllTechnologyList(new Request())->getData()->data;
        $implementationList = $this->ReservationController->getAllCurrentImplementationList(new Request())->getData()->data;
        $showMode = false;
        return view('pages.web.services.submitIdea.edit-submit-idea', compact('showMode','getSubmitIdea', 'technologiesList', 'implementationList'));
    }

    public function showSubmitIdeaReq(int $id)
    {
        $getSubmitIdea = idea_request::with('user')->orderBy('idea_request.created_at', 'DESC')->find($id);
        $technologiesList = $this->ReservationController->getAllTechnologyList(new Request())->getData()->data;
        $implementationList = $this->ReservationController->getAllCurrentImplementationList(new Request())->getData()->data;
        $showMode = true;
        return view('pages.web.services.submitIdea.edit-submit-idea', compact('showMode','getSubmitIdea', 'technologiesList', 'implementationList'));
    }

    public function editsubmitIdeaPost(Request $request)
    {
            $this->validate($request, [
                'track_channel' => 'required',
                'idea_name' => 'required',
                'idea_problem' => 'required',
                'idea_solution' => 'required',
                'idea_resource_requirement' => 'required',
                'contributors' => 'required',
                'point_of_contact' => 'required',
                'technology' => 'required',
                'current_implementation_level' => 'required',
            ]);

            $response = $this->ReservationController->updateIdeaRequest($request);

            if($response->getData()->success)
                return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);

    }

    public function cancelSubmitIdeaList(Request $request)
    {
        $getSubmitIdea = idea_request::with('user')
            ->where('is_approval_needed',1)
            ->where('is_cancellation_approved','Pending')
            ->orderBy('idea_request.created_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getSubmitIdea, 'action' => 'services-admin-cancel-submit-idea-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.submitIdea.manage-cancellation-submitted-idea', ['lists' => $getSubmitIdea, 'action' => 'services-admin-cancel-submit-idea-view']);
    }

    public function cancelSubmitIdeaView(int $id)
    {
        $getSubmitIdea = idea_request::with('user')->orderBy('idea_request.created_at', 'DESC')->find($id);
        $technologiesList = $this->ReservationController->getAllTechnologyList(new Request())->getData()->data;
        $implementationList = $this->ReservationController->getAllCurrentImplementationList(new Request())->getData()->data;
        $showMode = true;

        return view('pages.web.services.submitIdea.manage-cancellation-submitted-idea-form', compact('getSubmitIdea', 'technologiesList', 'implementationList', 'showMode'));
    }

    public function cancelSubmitIdea(Request $request)
    {
        try {
            if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
                $response = $this->ReservationController->approveCancelIdeaRequest($request);

                if ($response->getData()->success) {
                    return redirect()->route('services-admin-cancel-submit-idea-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->route('services-admin-cancel-submit-idea-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }
        } catch (\Exception $e){
            return redirect()->route('services-admin-cancel-submit-idea-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }
}
