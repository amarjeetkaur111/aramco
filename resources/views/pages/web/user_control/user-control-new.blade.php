@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<style>
    .pointer-none{
        pointer-events: none;
        opacity: 0.4;
    }
</style>
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

    <div class="d-flex justify-content-between border-bottom align-items-center">
                <ul class="nav nav-pills py-4 mt-3  aram-nav-pills">
                    <a href="{{route('user-control-general')}}">
                        <li class="nav-item">
                            <button class="nav-link" aria-controls="general-pane" aria-selected="false">General</button>
                        </li>
                    </a>
                    <li class="nav-item">
                        <button class="nav-link user-tab active " data-bs-toggle="tab" data-bs-target="#users-pane" type="button" role="tab" aria-controls="users-pane" aria-selected="false">Users</button>
                    </li>
                   
                </ul>
                
            
            </div>







    <form action="{{route('user-control-multiple-user-control-settings')}}" method="post">
        @csrf
        <div class="col-md-12 col-sm-12 col-12">
            <!-- <div class="d-flex justify-content-between border-bottom align-items-center"> -->
                
                
                <div class="d-none bulk-btn pt-3 d-flex justify-content-end align-items-center gap-3">
                    <a href="#" class="btn btn-primary">Bulk Changes</a>
                </div>
            <!-- </div> -->


            <div class="tab-content py-4">
                <!-- <div class="tab-pane fade show " id="general-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-12">
                            <div class="u-controls">
                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/service-activity.svg')}}" class="img-fluid" /></span>Services & Activity</div>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                </div>
                            </div>
                            <div class="u-controls">
                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/connect-black.svg')}}" class="img-fluid" /></span>Connect</div>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-12 offset-lg-1 offset-md-0">
                            <div class="u-controls">
                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/help.svg')}}" class="img-fluid" /></span>Help</div>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                </div>
                            </div>

                            <div class="u-controls">
                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar-black.svg')}}" class="img-fluid" /></span>Calendar Events</div>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                </div>
                            </div>
                        </div>

                    </div>
                </div> -->
                <div class="tab-pane fade show active" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-table">

                            <div class="card p-0 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden">
                                <div class="card-body p-0 pb-3">
                                    <div class="card-scroll-table ">
                                        <table class="table table-borderless align-middle" id="user-table">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="border-bottom border-2 fw-300" >
                                                        <div class="form-check">
                                                            <input class="form-check-input table-select-all" name="users_id[]" type="checkbox">
                                                            <label class="form-check-label">Select All</label>
                                                        </div>
                                                    </th>
                                                    <th class="border-bottom border-2 fw-300">Name & Email</th>
                                                    <th class="border-bottom border-2 fw-300">Status</th>
                                                    <th class="border-bottom border-2 fw-300 no-sort">View</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data-wrapper">
                                                @include('pages.web.user_control.user_internal')
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <div class="pt-2 px-3 d-flex justify-content-end align-items-center">
                                        <button type="button" class="btn btn-light btn-activity load-more-data">show more</button>
                                    </div> -->

                                </div>
                            </div>

                        </div>
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting d-none">

                            <div class="row justify-content-between align-items-center mt-3 mb-3">
                                <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                                    <a href="#" class="pagesTopNavLink goto-uc-table-btn"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
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
                                                        <div class="user-details fs-4" style="color: #323232;">Adib Farah</div>
                                                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/mail-grey.svg')}}" class="img-fluid" /></span>info@gmail.com</div>
                                                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/phone-grey.svg')}}" class="img-fluid" /></span>+97716845662</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item mb-3 border-0 p-0">
                                            <div class="p-3 border-0 rounded-5 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                                                <div class="user-list">
                                                    <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
                                                    <div class="w-100">
                                                        <div class="user-details fs-4" style="color: #323232;">Adib Farah</div>
                                                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/mail-grey.svg')}}" class="img-fluid" /></span>info@gmail.com</div>
                                                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/phone-grey.svg')}}" class="img-fluid" /></span>+97716845662</div>
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
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></span>Host an Event</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources.svg')}}" class="img-fluid" /></span>Allocate Computing Resources</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator.svg')}}" class="img-fluid" /></span>Reserve an Incubator</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop.svg')}}" class="img-fluid" /></span>Reserve Technology Workshop</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea.svg')}}" class="img-fluid" /></span>Submit an Idea</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <div class="u-controls">
                                                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/add-to-calender.svg')}}" class="img-fluid" /></span>Event Participation</div>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="u-controls">
                                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/connect-black.svg')}}" class="img-fluid" /></span>Connect</div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="u-controls">
                                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/help.svg')}}" class="img-fluid" /></span>Help</div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>

                                            <div class="u-controls">
                                                <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar-black.svg')}}" class="img-fluid" /></span>Calendar Events</div>
                                                <div class="form-check form-switch ms-auto">
                                                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div> -->

                    </div>






                </div>
            </div>
            <!-- </form> -->
        </div>
    </form>
    </div>


</div>
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/web/js/moment.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/web/service.js')}}"></script>
<script>
    $('.header').removeClass('header--light');
    $('.header').addClass('header--dark');
(console.log('#user-table', $('#user-table').length));
    $('.service-activity-checkbox').click(function() {
        $(this).closest('.service-activity-container').find('.service-activity-sub').toggle(this.checked);
       
    });

    $(document).ready(function () {
          $('#scheduled-visit-table').DataTable({
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
          });
       });

    //    let URL = "";
    //    let page = 1;

    //    document.querySelector('.load-more-data').addEventListener('click', function () {
    //        page++;
    //        infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
    //    });

    $('.user-tab').on('click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    $('.table-select-all').click(function(e) {
        // alert('jkjhkj');
        $('.table tbody input[type="checkbox"]').prop('checked', this.checked);
        if(this.checked){
            $('.bulk-btn').removeClass('d-none');
            $('.goto-uc-set-btn').addClass('pointer-none');
        }else{
            $('.bulk-btn').addClass('d-none');
            $('.goto-uc-set-btn').removeClass('pointer-none');

        }
    });
    $('.single-check-input').click(function(e) {
        var id = $(this).attr('data-id')
        var checkedCount = $('.single-check-input:checked').length;
        if(checkedCount >=1){
            $('.bulk-btn').removeClass('d-none');
            $('.goto-uc-set-btn').addClass('pointer-none');
        }
        else{
            $('.bulk-btn').addClass('d-none');
            $('.goto-uc-set-btn').removeClass('pointer-none');

        }
    });
   
    // $('.goto-uc-set-btn').click(function(e) {
    //     e.preventDefault();
    //     $('.user-control-table').addClass('d-none');
    //     $('.user-control-setting').removeClass('d-none');
    // });

    $('.general-tab, .goto-uc-table-btn').click(function(e) {
        e.preventDefault();
        $('.user-control-table').removeClass('d-none');
        $('.user-control-setting').addClass('d-none');
    });
</script>
@endpush