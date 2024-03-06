@extends('layouts.web')
@section('content')
<link rel="stylesheet" href="{{asset('assets/web/plugins/slick-1.8.1/slick/slick.css')}}" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">
    <div style="display:flex;justify-content-space-between;align-items:center;">
        <div class="pageheading my-3">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar.svg')}}" class="img-fluid" /></div>
            <div class="stext">Calendar</div>
        </div>
        @if(auth()->user()->roles->first()->id == '1' || auth()->user()->roles->first()->id == '5')
        <div>
            <a href="{{route('calender-admin-create')}}" type="button" class="btn btn-primary rounded-8 py-1" onClick="" style="width:135px"><span style="margin-right:8px;"><img src="{{asset('assets/web/images/icons/24/plus-white.svg')}}" class="img-fluid" /></span>Create event</a>
        </div>
        @endif
    </div>

    <p class="pagesubheading mb-2">Register upcoming events to enjoy lab experiences </p>
    <div class="row">
        <div class="col-12 py-4">
            <p class="pagesubheading justify-content-center my-4 fs-3">Upcoming Events</p>

            <div class="row d-flex align-items-stretch justify-content-center g-0 upComingEventContainer eventsContainer">
                @forelse($unregistered as $u => $uevents)
                <div class="col-sm-6 col-12" >
                    <div class="eventCard @if($u%2==0) darkRed @else darkBlue @endif mx-2 w-100" >
                    @if(auth()->user()->roles->first()->id == '1' || auth()->user()->roles->first()->id == '5')

                    <div class="dropdown ms-auto">
                        <a href="#" class="connect-more-rightLink" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" style="margin-top:12px;"><img src="{{asset('assets/web/images/icons/24/more_horizontal.svg')}}" class="img-fluid" /></a>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 13rem;">
                            <li><a class="dropdown-item ararmco-dropdown-item p-2" href="{{route('calender-admin-edit-event',['id' => $uevents['id']])}}"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Edit Event</a></li>
                            <li><a class="dropdown-item ararmco-dropdown-item p-2 text-danger delete-connect" data-id = "{{$uevents['id']}}"  href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Delete Event</a></li>
                        </ul>
                    </div>
                    @endif
                    <div class="eventCard-img p-lg-5 p-md-4 p-sm-4 p-4">
                        <img src="{{$uevents['calendar_image'] ?? asset('assets/web/images/icons/24/more_horizontal.svg')}}" class="img-fluid" />
                    </div>
                    <div class="eventCard-content p-lg-5 p-md-4 p-sm-4 p-4">
                        <h4 class="eventCardTitle mb-2 w-100">{{$uevents['title']}} </h4>
                        <p class="eventCardBrief mb-md-5 mb-4  w-100">{{$uevents['description']}}</p>
                        <div class="eventCardFooter mt-auto w-100">
                            <p class="eventCardDate m-0">{{date('d M, Y',strtotime($uevents['start_date']))}}</p>
                            <button type="button" class="btn btn-sm btn-light rounded-pill px-4 py-1 fs-5 register" data-id = "{{$uevents['id']}}">Register</button>
                        </div>
                    </div>
                    </div>
                </div>
                @empty
                    <p class="d-flex justify-content-center w-100 no-register-events">No Events to Register!</p>
                @endforelse


                <!-- <div class="eventCard darkBlue mx-3 col">
                    <div class="dropdown ms-auto">
                        <a href="#" class="connect-more-rightLink" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" style="margin-top:12px;"><img src="{{asset('assets/web/images/icons/24/more_horizontal.svg')}}" class="img-fluid" /></a>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 13rem;">
                            <li><a class="dropdown-item ararmco-dropdown-item p-2" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Edit Channel</a></li>
                            <li><a class="dropdown-item ararmco-dropdown-item p-2 text-danger delete-connect" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Delete Channel</a></li>
                        </ul>
                    </div>
                    <div class="eventCard-img p-lg-5 p-md-4 p-sm-4 p-4">
                        <img src="{{asset('assets/web/images/icons/event-icon-2.svg')}}" class="img-fluid" />
                    </div>
                    <div class="eventCard-content p-lg-5 p-md-4 p-sm-4 p-4">
                        <h4 class="eventCardTitle mb-2 w-100">Event Title </h4>
                        <p class="eventCardBrief mb-md-5 mb-4  w-100">lorum ipsum dolor sit amet Lorem ipsum dol it ametLorem ipsum dololorum ipsum dolor sit amet Lorem ipsum dol it ametLorem ipsum dololorum ipsum dolor sit amet Lorem ipsum dol it ametLorem ipsum dolo</p>
                        <div class="eventCardFooter mt-auto w-100">
                            <p class="eventCardDate m-0">24 March, 2020</p>
                            <button type="button" class="btn btn-sm btn-light rounded-pill px-4 py-1 fs-5">Register</button>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="d-flex justify-content-center align-content-center slick-arrows my-2 upComing-arrows"></div>
        </div>

        <div class="col-12 py-4">
            <p class="pagesubheading justify-content-center my-4 fs-3">Registered Events</p>
            @if(count($registered) > 0)
            <div class="row d-flex align-items-stretch justify-content-center g-0 registeredEventContainer eventsContainer">
                @foreach($registered as $r => $revents)
                <div class="col-sm-4 col-12" >
                <div class="eventCard primary mx-2 w-100">
                    <div class="eventCard-img p-lg-5 p-md-4 p-sm-4 p-4">
                        <img src="{{$revents['calendar_image'] ?? asset('assets/web/images/icons/event-icon-3.svg')}}" class="img-fluid" />
                    </div>
                    <div class="eventCard-content p-lg-5 p-md-4 p-sm-4 p-4">
                        <h4 class="eventCardTitle mb-2 w-100">{{$revents['title']}} </h4>
                        <p class="eventCardBrief mb-md-5 mb-4  w-100">{{$revents['description']}} </p>
                        <div class="eventCardFooter mt-auto w-100">
                            <p class="eventCardDate m-0">{{date('d M, Y',strtotime($revents['start_date']))}}</p>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="d-flex justify-content-center w-100 no-register-events">Not Registered to any Event!</p>
            @endif
            <div class="d-flex justify-content-between align-content-center slick-arrows my-2 registered-arrows"></div>
        </div>

    </div>




</div>
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/slick-1.8.1/slick/slick.min.js')}}"></script>
<script>
    $('.header').removeClass('header--light');
    $('.header').addClass('header--dark');

    var arr_left = "{{asset('assets/web/images/icons/24/slider-prev-arrow.svg')}}";
    var arr_right ="{{asset('assets/web/images/icons/24/slider-next-arrow.svg')}}";

    var upComingEventOpts = {
        arrows: true,
        dots: false,
        autoplay: false,
        appendArrows: $(".upComing-arrows"),
        prevArrow: '<button class="prev-arrow"><img src="' + arr_left + '" class="img-fluid" /></button>',
        nextArrow: '<button class="next-arrow"><img src="' + arr_right + '" class="img-fluid" /></button>',
        lazyLoad: 'ondemand',
        infinite: false,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        rows: 1,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 822,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 776,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    };
    $('.upComingEventContainer').slick(upComingEventOpts); //.on('wheel', (function(e) {
    //     e.preventDefault();
    //     if (e.originalEvent.deltaY < 0) {
    //         $(this).slick('slickNext');
    //     } else {
    //         $(this).slick('slickPrev');
    //     }
    // }));

    var registeredEventOpts = {
        arrows: true,
        dots: false,
        autoplay: false,
        appendArrows: $(".registered-arrows"),
        prevArrow: '<button class="prev-arrow"><img src="' + arr_left + '" class="img-fluid" /></button>',
        nextArrow: '<button class="next-arrow"><img src="' + arr_right + '" class="img-fluid" /></button>',
        lazyLoad: 'ondemand',
        infinite: false,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        rows: 1,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 822,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 776,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    };
    $('.registeredEventContainer').slick(registeredEventOpts); //.on('wheel', (function(e) {
    //     e.preventDefault();
    //     if (e.originalEvent.deltaY < 0) {
    //         $(this).slick('slickNext');
    //     } else {
    //         $(this).slick('slickPrev');
    //     }
    // }));
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

    $('.delete-connect').on('click', function () {
        var event_id = $(this).attr('data-id');
        $.confirm({
            title: 'Delete',
            content: 'Are you sure you want to cancel this event?', // Add your custom message here
            buttons: {
                Yes: function () {
                    var additionalData = {
                        event_id: event_id,
                    };
                    $.ajax({
                        url: '{{route("calender-admin-deleteEvent")}}',
                        type: 'GET', // or 'POST', depending on your route configuration
                        data: additionalData, // Sending additional data in the request
                        success: function (data) {
                            console.log(data);
                            if(data.status == "Success"){
                                successMsg('1',data.msg)
                            }else{
                                successMsg('2',data.msg)
                            }
                        },
                        error: function (error) {
                        }
                    });
                },
                Cancel: function () {
                }
            }
        });
    });


    $('.register').on('click', function () {
        var event_id = $(this).attr('data-id');
        $.confirm({
            title: 'Delete',
            content: 'Are you sure you want to register to this event?', // Add your custom message here
            buttons: {
                Yes: function () {
                    var additionalData = {
                        event_id: event_id,
                    };
                    $.ajax({
                        url: '{{route("calender-registerEvent")}}',
                        type: 'GET', // or 'POST', depending on your route configuration
                        data: additionalData, // Sending additional data in the request
                        success: function (data) {
                            console.log(data);
                            if(data.status == "Success"){
                                successMsg('1',data.msg)
                            }else{
                                successMsg('2',data.msg)
                            }
                        },
                        error: function (error) {
                        }
                    });
                },
                Cancel: function () {
                }
            }
        });
    });
</script>
@endpush
