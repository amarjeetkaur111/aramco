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
                <li class="nav-item">
                    <button class="nav-link general-tab active" data-bs-toggle="tab" data-bs-target="#general-pane" type="button" role="tab" aria-controls="general-pane" aria-selected="true">General</button>
                </li>
                <li class="nav-item">
                    <a href="{{route('user-control-users')}}">
                        <button class="nav-link user-tab " type="button" role="tab" aria-controls="users-pane" aria-selected="false">Users</button>
                    </a>
                </li>
            </ul>

            <div class="tab-content py-4">
                <form action="{{route('user-control-general-post')}}" method="post">
                    @csrf
                    <div class="tab-pane fade show active" id="general-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-sm-6 col-12">
                                <div class="u-controls">
                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/service-activity.svg')}}" class="img-fluid" /></span>Services & Activity</div>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input success aram-form-check-input input-check" name="general" type="checkbox" role="switch" value="On">
                                    </div>
                                </div>
                                <div class="u-controls">
                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/connect-black.svg')}}" class="img-fluid" /></span>Connect</div>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input success aram-form-check-input input-check" name="connect" type="checkbox" role="switch" value="On">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6 col-12 offset-lg-1 offset-md-0">
                                <div class="u-controls">
                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/help.svg')}}" class="img-fluid" /></span>Help</div>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input success aram-form-check-input input-check" type="checkbox" name="help" role="switch" value="On">
                                    </div>
                                </div>

                                <div class="u-controls">
                                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar-black.svg')}}" class="img-fluid" /></span>Calendar Events</div>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input success aram-form-check-input input-check" type="checkbox" name="calendar" role="switch" value="On">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end general-save d-none">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
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



    $('.user-tab').on('click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
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
    if ($(this).is(':checked')) {
        $('.general-save').removeClass('d-none');
    } else {
        $('.general-save').addClass('d-none');
    }
});
</script>
@endpush