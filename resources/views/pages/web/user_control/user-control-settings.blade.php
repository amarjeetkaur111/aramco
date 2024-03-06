@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">

    <div class="pageheading my-3">
        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/cog-blue.svg')}}" class="img-fluid" /></div>
        <div class="stext">User Control</div>
    </div>
    @if(Session::has('msg'))
              <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                  {{ Session::get('msg') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif

    <div class="row my-3">
        <div class="col-md-12 col-sm-12 col-12">

            <ul class="nav nav-pills py-4 mt-3 border-bottom aram-nav-pills">
                <a href="{{route('user-control-general')}}">
                    <li class="nav-item">
                        <button class="nav-link" aria-controls="general-pane" aria-selected="false">General</button>
                    </li>
                </a>
                <li class="nav-item">
                    <button class="nav-link user-tab active " data-bs-toggle="tab" data-bs-target="#users-pane" type="button" role="tab" aria-controls="users-pane" aria-selected="false">Users</button>
                </li>
            </ul>

            <div class="tab-content py-4">
                <form action="{{route('user-control-user-control-post')}}" method="post">
                    @csrf
                    <input type="hidden" name="google_id[]" value="{{$google_id}}">
                    <div class="tab-pane fade show active" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting">

                                <div class="row justify-content-between align-items-center mt-3 mb-3">
                                    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                                        <a href="{{route('user-control-users')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-12 col-12 border-end">

                                        <ul class="list-group list-group-flush mb-3">
                                            <li class="list-group-item mb-3 border-0 p-0">
                                                <div class="p-3 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                                                    <div class="user-list">
                                                        <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
                                                        <div class="w-100">
                                                            <div class="user-details fs-4" style="color: #323232;">{{$user_data->first_name}} {{$user_data->last_name}}</div>
                                                            <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/mail-grey.svg')}}" class="img-fluid" /></span>{{$user_data->email}}</div>
                                                            <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/phone-grey.svg')}}" class="img-fluid" /></span>{{$user_data->phone}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>

                                        <div class="infoDesc"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning.svg')}}" class="img-fluid" /></span>Turn on/off user functionalities</div>



                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12 col-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="service-activity-container">
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/service-activity.svg')}}" class="img-fluid" /></span>Services & Activity</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input service-activity-checkbox" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="service-activity-sub" style="display:none;">
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon me-1"><img src="{{asset('assets/web/images/icons/24/event-schedule.svg')}}" class="img-fluid" /></span>Schedule a visit</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check"  type="checkbox" role="switch" @if($accessData[0]->schedule_request == 1) checked @endif value="{{$accessData[0]->schedule_request ?? '0'}}">
                                                                <input type="hidden" name="schedule_request[]" value="{{$accessData[0]->schedule_request ?? '0'}}">
                                                            </div>
                                                        </div>
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></span>Host an Event</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check"  type="checkbox" @if($accessData[0]->robin_event_request == 1) checked @endif  role="switch">
                                                                <input type="hidden" name="robin_event_request[]" value="{{$accessData[0]->robin_event_request ?? '0'}}">
                                                            </div>
                                                        </div>
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources.svg')}}" class="img-fluid" /></span>Allocate Computing Resources</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->incubator_request == 1) checked @endif  type="checkbox" role="switch">
                                                                <input type="hidden" name="incubator_request[]" value="{{$accessData[0]->incubator_request}}">
                                                            </div>
                                                        </div>
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator.svg')}}" class="img-fluid" /></span>Reserve an Incubator</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->computing_resource_request == 1) checked @endif  type="checkbox" role="switch">
                                                                <input type="hidden" name="computing_resource_request[]" value="{{$accessData[0]->computing_resource_request}}">
                                                            </div>
                                                        </div>
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop.svg')}}" class="img-fluid" /></span>Reserve Technology Workshop</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check" @if($accessData[0]->technology_workshop_request == 1) checked @endif  type="checkbox" role="switch">
                                                                <input type="hidden" name="technology_workshop_request[]" value="{{$accessData[0]->technology_workshop_request}}">
                                                            </div>
                                                        </div>
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea.svg')}}" class="img-fluid" /></span>Submit an Idea</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->idea_request == 1) checked @endif  type="checkbox" role="switch">
                                                                <input type="hidden" name="idea_request[]" value="{{$accessData[0]->idea_request}}">
                                                            </div>
                                                        </div>
                                                        <div class="u-controls">
                                                            <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/add-to-calender.svg')}}" class="img-fluid" /></span>Event Participation</div>
                                                            <div class="form-check form-switch ms-auto">
                                                                <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->general_reservation_request == 1) checked @endif  type="checkbox" role="switch">
                                                                <input type="hidden" name="general_reservation_request[]" value="{{$accessData[0]->general_reservation_request}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="u-controls">
                                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/connect-black.svg')}}" class="img-fluid" /></span>Connect</div>
                                                    <div class="form-check form-switch ms-auto">
                                                        <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->connect == 1) checked @endif  type="checkbox" role="switch">
                                                        <input type="hidden" name="connect[]" value="{{$accessData[0]->connect}}">
                                                    </div>
                                                </div>
                                                <div class="u-controls">
                                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/ar.svg')}}" class="img-fluid" /></span>ar</div>
                                                    <div class="form-check form-switch ms-auto">
                                                        <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->ar == 1) checked @endif  type="checkbox" role="switch">
                                                        <input type="hidden" name="ar[]" value="{{$accessData[0]->ar}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="u-controls">
                                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/help.svg')}}" class="img-fluid" /></span>Help</div>
                                                    <div class="form-check form-switch ms-auto">
                                                        <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->help == 1) checked @endif  type="checkbox" role="switch">
                                                        <input type="hidden" name="help[]" value="{{$accessData[0]->help}}">
                                                    </div>
                                                </div>

                                                <div class="u-controls">
                                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar-black.svg')}}" class="img-fluid" /></span>Calendar Events</div>
                                                    <div class="form-check form-switch ms-auto">
                                                        <input class="form-check-input success aram-form-check-input input-check"  @if($accessData[0]->calendar == 1) checked @endif  type="checkbox" role="switch">
                                                        <input type="hidden" name="calendar[]" value="{{$accessData[0]->calendar}}">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex justify-content-end userControlSave d-none">
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>

                        </div>






                    </div>
                </form>
            </div>

        </div>
    </div>


</div>
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/web/js/moment.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $('.header').removeClass('header--light');
    $('.header').addClass('header--dark');

    $('.service-activity-checkbox').click(function() {
        $(this).closest('.service-activity-container').find('.service-activity-sub').toggle(this.checked);
    });

    $(document).ready(function() {
        $('#user-table').DataTable({
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
        });

        var checkedCount = $('.input-check:checked').length;
        if (checkedCount >= 1) {
            $('.userControlSave').removeClass('d-none');
        }
    });

    $('.user-tab').on('click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    $('.table-select-all').click(function(e) {

        $('.table tbody input[type="checkbox"]').prop('checked', this.checked);
        console.log('this.checked', this.checked);
    });
    $('.goto-uc-set-btn').click(function(e) {
        e.preventDefault();
        $('.user-control-table').addClass('d-none');
        $('.user-control-setting').removeClass('d-none');
    });

    $('.general-tab, .goto-uc-table-btn').click(function(e) {
        e.preventDefault();
        $('.user-control-table').removeClass('d-none');
        $('.user-control-setting').addClass('d-none');
    });

    $('.input-check').change(function() {

        if (this.checked) {
           
           $(this).closest('.u-controls').find('input[type=hidden]').val(1);
            

        } else {
            $(this).closest('.u-controls').find('input[type=hidden]').val(0);
        }
        var checkedCount = $('.input-check:checked').length;
        if (checkedCount >= 1) {
            $('.userControlSave').removeClass('d-none');
        } else {
            $('.userControlSave').addClass('d-none');
        }
    });
</script>
@endpush