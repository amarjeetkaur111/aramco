@extends('layouts.web')
@section('content')
    <link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />

    <div class="container min-vh-70">

        <div class="pageheading my-3 justify-content-between">
            <div class="d-flex flex-row">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/calender_large.svg')}}" class="img-fluid" /></div>
                <div class="stext">Event Management</div>
            </div>

        </div>



        <div class="row my-3">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="py-4">
                    <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                        <div class="row justify-content-between align-items-center mt-3 mb-3">
                            <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                                <a href="{{ route('calender-admin-event-management') }}" class="pagesTopNavLink goto-uc-table-btn"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
                            </div>
                        </div>
                        <div>
                            @if(Session::has('msg'))
                                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                                    {{ Session::get('msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting">


                                <form action="{{ route('calender-admin-single-event-status-change') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="google_id" value="{{auth()->user()->google_id }}">
                                    <input type="hidden" name="users_google_id" value="{{$calendar_event->google_id }}">
                                    <input type="hidden" name="event_id" value="{{$calendar_event->id ?? "" }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                        <ul class="list-group list-group-flush mb-3">
                                            <li class="list-group-item mb-3 border-0 p-0">
                                                <div class="p-3 border-0 rounded-5 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <span class="sicon"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></span>
                                                        </div>
                                                        <div class="ms-2">{{ $calendar_event->title ?? "" }}</div>
                                                    </div>
                                                    <hr />
                                                    <div>
                                                        <div class="fw-bold">Email:</div>
                                                        <div>{{ $calendar_event->email ?? "" }}</div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <div class="fw-bold">Description:</div>
                                                        <div>{!! $calendar_event->description ?? "" !!}</div>
                                                    </div>

                                                    <div class="mt-2">Status: <span class="status-color">{{ $calendar_event->status ?? "" }}</span></div>
                                                </div>
                                            </li>

                                        </ul>
                                        <div>
                                            <button type="submit" class="btn btn-success ms-2 accept-btn" name="status" value="Approved">Accept</button>
                                            <button type="submit" class="btn btn-danger accept-btn" name="status" value="Rejected">Reject</button>
                                        </div>

                                    </div>



                                </div>
                                </form>


                            </div>

                        </div>






                    </div>
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
@endpush
