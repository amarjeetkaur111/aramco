@extends('layouts.web')
@section('content')


    <link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

        <div class="pageheading my-3">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/my-activity.svg')}}" class="img-fluid" /></div><div class="stext">My Activity</div>
        </div>

        <div class="row justify-content-between align-items-center my-3">
            <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                <p class="pagesubheading mb-2">See all notifications below </p>
            </div>
        </div>
        @if(Session::has('msg'))
            <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                {{ Session::get('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/event-schedule.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">My Scheduled visits</div>
                        </div>
                    </div>
                    @if(!empty($scheduleVisit))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($scheduleVisit as $s_visit)
                                    <li>
                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$s_visit->visit_title}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($s_visit->status_of_request) }}">{{$s_visit->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($s_visit->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($s_visit->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$s_visit->id}}" data-type="visit" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-schedule-visits-edit',['id'=>$s_visit->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($s_visit->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-schedule-visits-show',['id'=>$s_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($s_visit->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-schedule-visits-show',['id'=>$s_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($s_visit->status_of_request == "Approved")
                                                    @if($s_visit->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$s_visit->id}}" data-type="visit" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-schedule-visits-show',['id'=>$s_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-schedule-visits-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>
                    @endif
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">My Hosted Event</div>
                        </div>
                    </div>
                    @if(!empty($hostEvent))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($hostEvent as $h_visit)

                                    <li>

                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$h_visit->event_name}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($h_visit->status_of_request) }}">{{$h_visit->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($h_visit->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($h_visit->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$h_visit->id}}" data-type="event" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-hosted-events-edit',['id'=>$h_visit->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($h_visit->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-hosted-events-show',['id'=>$h_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($h_visit->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-hosted-events-show',['id'=>$h_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($h_visit->status_of_request == "Approved")
                                                    @if($h_visit->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$h_visit->id}}" data-type="event" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-hosted-events-show',['id'=>$h_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-hosted-events-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>

                    @endif
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">My Allocated Computing Resources</div>
                        </div>
                    </div>
                    @if(!empty($allocatedData))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($allocatedData as $allocated_visit)
                                    <li>
                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$allocated_visit->usecase_name}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($allocated_visit->status_of_request) }}">{{$allocated_visit->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($allocated_visit->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($allocated_visit->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$allocated_visit->id}}" data-type="allocated" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-alocating-computing-events-edit',['id'=>$allocated_visit->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($allocated_visit->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-alocating-computing-events-show',['id'=>$allocated_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($allocated_visit->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-alocating-computing-events-show',['id'=>$allocated_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($allocated_visit->status_of_request == "Approved")
                                                    @if($allocated_visit->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$allocated_visit->id}}" data-type="allocated" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-alocating-computing-events-show',['id'=>$allocated_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-alocating-computing-events-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>

                    @endif
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/reserve-incubator.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">My Reserved Incubator</div>
                        </div>
                    </div>
                    @if(!empty($incubatorData))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($incubatorData as $incubator_visit)
                                    <li>
                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$incubator_visit->usecase_name}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($incubator_visit->status_of_request) }}">{{$incubator_visit->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($incubator_visit->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($incubator_visit->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$incubator_visit->id}}" data-type="incubator" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-reserve-incubator-events-edit',['id'=>$incubator_visit->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($incubator_visit->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-reserve-incubator-events-show',['id'=>$incubator_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($incubator_visit->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-reserve-incubator-events-show',['id'=>$incubator_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($incubator_visit->status_of_request == "Approved")
                                                    @if($incubator_visit->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$incubator_visit->id}}" data-type="incubator" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-reserve-incubator-events-show',['id'=>$incubator_visit->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-reserve-incubator-events-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>

                    @endif
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">Reserved Technology Workshop</div>
                        </div>
                    </div>
                    @if(!empty($reserveTechData))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($reserveTechData as $resrveTech)
                                    <li>
                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$resrveTech->workshop_name}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($resrveTech->status_of_request) }}">{{$resrveTech->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($resrveTech->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($resrveTech->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$resrveTech->id}}" data-type="reserveTech" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-reserve-tech-events-edit',['id'=>$resrveTech->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($resrveTech->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-reserve-tech-events-show',['id'=>$resrveTech->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($resrveTech->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-reserve-tech-events-show',['id'=>$resrveTech->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($resrveTech->status_of_request == "Approved")
                                                    @if($resrveTech->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$resrveTech->id}}" data-type="reserveTech" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-reserve-tech-events-show',['id'=>$resrveTech->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-reserve-tech-events-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>

                    @endif
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/submit-an-idea.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">My Submitted Idea</div>
                        </div>
                    </div>
                    @if(!empty($submitData))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($submitData as $submitIdea)
                                    <li>
                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$submitIdea->idea_name}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($submitIdea->status_of_request) }}">{{$submitIdea->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($submitIdea->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($submitIdea->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$submitIdea->id}}" data-type="idea" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-submit-idea-edit',['id'=>$submitIdea->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($submitIdea->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-submit-idea-show',['id'=>$submitIdea->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($submitIdea->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-submit-idea-show',['id'=>$submitIdea->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($submitIdea->status_of_request == "Approved")
                                                    @if($submitIdea->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$submitIdea->id}}" data-type="idea" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-submit-idea-show',['id'=>$submitIdea->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-submit-idea-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>

                    @endif
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex align-content-stretch">
                <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
                    <div class="card-header pb-3 bg-transparent activity-card-header">
                        <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/general-service.svg')}}" class="img-fluid" /></div>
                        <div class="w-100">
                            <div class="activity-title text-wrap text-break">General Reservation</div>
                        </div>
                    </div>
                    @if(!empty($generalData))

                        <div class="card-body d-flex flex-column py-3">

                            <ul class="list-unstyled activity-list w-100">
                                @foreach($generalData as $general)
                                    <li>
                                        <div class="activity-item">
                                            <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                                            <div class="stext">
                                                {{$general->title}}<br/>Status - <span class="{{ CommonFunction::statusWiseServiceColor($general->status_of_request) }}">{{$general->status_of_request}}</span><br/>
                                                <span class="text-grey">Date : {{ \Carbon\Carbon::parse($general->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="saction">
                                                @if($general->status_of_request == "Pending")
                                                    <a class="saction-link delete-request" data-id = "{{$general->id}}" data-type="general" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    <a class="saction-link" href="{{route('services-my-general-reservation-edit',['id'=>$general->id])}}" title="edit"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                                                @elseif($general->status_of_request == "Cancelled")
                                                    <a class="saction-link" href="{{route('services-my-general-reservation-show',['id'=>$general->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($general->status_of_request == "Rejected")
                                                    <a class="saction-link" href="{{route('services-my-general-reservation-show',['id'=>$general->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @elseif($general->status_of_request == "Approved")
                                                    @if($general->is_approval_needed == 1)
                                                        <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash_grey.svg')}}" class="img-fluid" /></a>
                                                    @else
                                                        <a class="saction-link delete-request" data-id = "{{$general->id}}" data-type="general" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                                                    @endif
                                                    <a class="saction-link" href="{{route('services-my-general-reservation-show',['id'=>$general->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="pt-2 w-00 mt-auto d-flex justify-content-end align-items-center">
                                <a href="{{route('services-my-general-reservation-index')}}" class="btn btn-primary btn-activity px-1" style="min-width: 56px;" >See all</a>
                            </div>
                        </div>

                    @else
                        <div class="card-body d-flex flex-column py-3" style="display: flex;align-items:center;justify-content:center">No Request Found</div>

                    @endif
                </div>
            </div>


        </div>


    </div>
@endsection
@push('custom-scripts')
    <script>

        $('.header').removeClass('header--light');
        $('.header').addClass('header--dark');

    </script>
    <script>
        $('.already_approved').on('click',function(){
            $.confirm({
                title: '', // Change "text" to "title"
                content: 'Your request for cancellation has been already sent to admin.',
                buttons: {
                    Ok: function () {
                        // Code to be executed when the user clicks "Ok"
                    }
                }
            });
        })

        function successMsg(type,msgg){
            if(type == 1){
                $.confirm({
                    title: '', // Change "text" to "title"
                    content: msgg,
                    buttons: {
                        Ok: function () {
                            // Code to be executed when the user clicks "Ok"
                            location.reload();
                        }
                    }
                });
            }else if(type == 2){
                $.confirm({
                    title: '', // Change "text" to "title"
                    content: msgg,
                    buttons: {
                        Ok: function () {
                            // Code to be executed when the user clicks "Ok"
                            location.reload();
                        }
                    }
                });
            }

        }
    </script>
    <script>
        $('.delete-request').on('click', function () {
            var req_id = $(this).attr('data-id');
            var req_type = $(this).attr('data-type');
            $.confirm({
                title: 'Delete',
                content: 'Are you sure you want to cancel this request.', // Add your custom message here
                buttons: {
                    Yes: function () {
                        // Code to be executed when the user clicks "Ok" (i.e., selects "Yes")

                        // Additional data to be sent in the request
                        var additionalData = {
                            id: req_id,
                            field2: req_type
                        };

                        // Call your route or perform the desired action here
                        // For example, using jQuery's AJAX to call a route:
                        $.ajax({
                            url: '{{route("my-activity-del-req")}}',
                            type: 'GET', // or 'POST', depending on your route configuration
                            data: additionalData, // Sending additional data in the request
                            success: function (data) {
                                // Handle the success response here
                                console.log(data);
                                if(data.status == "Success"){
                                    successMsg('1',data.msg)
                                }else{
                                    successMsg('2',data.msg)
                                }
                                // location.reload;
                                // alert('saved')
                            },
                            error: function (error) {
                                // Handle the error here
                            }
                        });
                    },
                    Cancel: function () {
                        // Code to be executed when the user clicks "Cancel" (optional)
                    }
                }
            });
        });
    </script>
@endpush
