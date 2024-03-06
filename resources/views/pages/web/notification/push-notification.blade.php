@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<style>
    html,
    body {
        width: 100%;
        height: 100%;
    }

    .noselect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .dropdown-container,
    .instructions {
        /* width: 200px; */
        margin: 20px auto 0;
        font-size: 14px;
        font-family: sans-serif;
        overflow: auto;
    }

    .instructions {
        width: 100%;
        text-align: center;
    }

    .dropdown-button {
        float: left;
        width: 100%;
        /* background: whitesmoke; */
        padding: 10px 12px;
        cursor: pointer;
        border: 1px solid lightgray;
        box-sizing: border-box;
    }

    .dropdown-button .dropdown-label,
    .dropdown-button .dropdown-quantity {
        float: left;
    }

    .dropdown-button .dropdown-quantity {
        margin-left: 4px;
    }

    .dropdown-button .fa-filter {
        float: right;
    }

    .dropdown-button .fa-angle-down {
        float: right;
    }

    .dropdown-list {
        float: left;
        width: 100%;
        border: 1px solid lightgray;
        border-top: none;
        box-sizing: border-box;
        /* padding: 10px 12px; */
    }

    .dropdown-list input[type="search"] {
        padding: 5px 0;
        background: #c0c0c0;
        border: none;
        padding: 5px 2px;
    }

    .dropdown-list ul {
        margin: 10px 0;
        max-height: 200px;
        overflow-y: auto;
        padding: 10px 12px;
    }
    .dropdown-list ul li {
       list-style: none;
    }
    .dropdown-list ul input[type="checkbox"] {
        position: relative;
        top: 2px;
    }

    ::placeholder {
        /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: white;
        opacity: 1;
        /* Firefox */
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: white;
    }

    ::-ms-input-placeholder {
        /* Microsoft Edge */
        color: white;
    }

    [type=search] {
        color: white;
    }
    .loading {
        display: none;
    }
</style>

<div class="container min-vh-70">

    <div class="pageheading my-3 justify-content-between">
        <div class="d-flex flex-row">
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/notification.svg')}}" class="img-fluid" /></div>
            <div class="stext">Notification Management</div>
        </div>
        <!-- <div>
            <button type="button" class="btn btn-danger accept-btn">Reject</button>
            <button type="button" class="btn btn-success ms-2 accept-btn">Accept</button>
        </div> -->
    </div>

    <div class="row my-3">
        <div class="col-md-12 col-sm-12 col-12">
            <div class="py-4">
                <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-table">

                            <div class="card p-0 border-0 rounded-4 w-100 overflow-hidden">
                                <div class="card-body p-0 pb-3" style="border-bottom: 1px solid #ececec;">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/notification_icon.svg')}}" class="img-fluid" /></div>
                                            <div class="ms-2">Push Notifications</div>
                                            <hr />
                                        </div>
                                        <div>
                                            <a href="{{route('notification-admin-notificationHistory')}}" type="button" class="btn btn-primary ms-2 submit-btn"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/clock_history.png')}}" class="img-fluid" /></span><span class="ms-3">View History</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Session::has('msg'))
                                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                                    {{ Session::get('msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('notification-admin-pushNotificationPost') }}" method="post">
                            @csrf
                            <input type="hidden" name="manual" value="1">
                            <input type="hidden" name="sender_id" value="{{ auth()->user()->google_id }}">
                            <div class="col-xl-5 col-lg-6 col-md-8 mt-4">
                                <input type="text" class="form-control" placeholder="Enter Title" id="title" name="title"></input>
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-8 mt-4">
                                <textarea class="form-control" placeholder="Type Your Message...." id="floatingTextarea2" name="body" style="height: 100px"></textarea>
                                @if ($errors->has('body'))
                                    <span class="text-danger">{{ $errors->first('body') }}</span>
                                @endif
                            </div>

                            <div class="col-xl-5 col-lg-6 col-md-8 mt-4">
                                <div class="dropdown-container">
                                    <div class="dropdown-button noselect">
                                        <div class="dropdown-label">Select User</div>
                                        <div class="dropdown-quantity">(<span class="quantity">Any</span>)</div>
                                        <i class="fa fa-angle-down "></i>
                                    </div>
                                    <div class="dropdown-list" style="display: none;">
                                        <div style="display:flex;justify-content:space-between;background:#c0c0c0;align-items:center;color:white;padding: 5px 12px;">
                                            <div>
                                                <i class="fa fa-search"></i>
                                                <input type="search" placeholder="Search" class="dropdown-search" />
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input table-select-all select-all-check" id="select-all-check" type="checkbox" value="">
                                                <label class="form-check-label" for="select-all-check">Select All</label>
                                            </div>
                                        </div>
                                        <ul class="users-list"></ul>
                                    </div>
                                    @if ($errors->has('receiver_id'))
                                        <span class="text-danger">{{ $errors->first('receiver_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-8 mt-4">                              
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary ms-2 submit-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                        <div class="row my-3">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="py-4">
                                    <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-table">

                                                <div class="card p-0 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden">
                                                    <div class="card-body p-0 pb-3">
                                                        <div class="user-table ">
                                                            <table class="table table-borderless align-middle" id="user-table">
                                                                <thead class="bg-primary text-white">
                                                                    <tr>
                                                                        <th class="border-bottom border-2 fw-300">Notification Title</th>
                                                                        <th class="border-bottom border-2 fw-300">Date</th>
                                                                        <th class="border-bottom border-2 fw-300 no-sort">View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="data-wrapper">
                                                                    @include('pages.web.notification.load-data')
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="pt-2 px-3 d-flex justify-content-end align-items-center">
                                                            <button type="button" class="btn btn-light btn-activity load-more-data">
                                                                <span class="loading">
                                                                    <i class="fa fa-spinner fa-spin"></i>
                                                                </span> show more
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/web/js/moment.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>

<script>
    $('.dropdown-container')
        .on('click', '.dropdown-button', function() {
            $(this).siblings('.dropdown-list').toggle();
        })
        .on('input', '.dropdown-search', function() {
            var target = $(this);
            var dropdownList = target.closest('.dropdown-list');
            var search = target.val().toLowerCase();

            if (!search) {
                dropdownList.find('li').show();
                return false;
            }

            dropdownList.find('li').each(function() {
                var text = $(this).text().toLowerCase();
                var match = text.indexOf(search) > -1;
                $(this).toggle(match);
            });
        })
        .on('change', '[type="checkbox"]', function() {
            var container = $(this).closest('.dropdown-container');
            var numChecked = container.find('[type="checkbox"]:checked').length;
            container.find('.quantity').text(numChecked || 'Any');
        });
   
    var userListObjArray = @json($getUsers);
    $.each(userListObjArray, function (index,value) {
        $(".users-list").append(           
            '<li>' +
                '<input class="form-check-input" name="receiver_id[]" type="checkbox" value="'+value.google_id+'" id="'+value.google_id+'">' +
                '<label style="margin-left:14px;cursor:pointer;" for="'+value.google_id+'">'+value.first_name+' '+value.last_name+'<div >'+value.email+'</div></label>' +
                '' +
            '</li>'
        );
    });

    $('.header').removeClass('header--light');
    $('.header').addClass('header--dark');

    $('.service-activity-checkbox').click(function() {
        $(this).closest('.service-activity-container').find('.service-activity-sub').toggle(this.checked);
    });

    $(document).ready(function() {
        $('.user-control-setting').addClass('d-none');
        $('#user-table').DataTable({
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
        });
    });

    $('.user-tab').on('click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    $('.table-select-all').click(function(e) {
        $('.table tbody input[type="checkbox"]').prop('checked', this.checked);
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
    $('.select-all-check').click(function(e) {
        $('input[type="checkbox"]').prop('checked', this.checked);
    });

    let URL = "{{ route('notification-admin-pushNotification') }}";
    let page = 1;

    document.querySelector('.load-more-data').addEventListener('click', function (){
        page++;
        infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
    });

    function infiniteLoadMore(url, loader_class, table_body) {
        $.ajax({
            beforeSend: function () {
                $('.' + loader_class).show();
            },
            datatype: "html",
            type: "get",
            url: url,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if (response.html == '') {
                    $('.' + loader_class).text("No more data ...");
                    return;
                }

                $('.' + loader_class).hide();
                $("#" + table_body).append(response.html);
            },
            complete: function () {
                $('.' + loader_class).hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $('.' + loader_class).hide();
            }
        });
    }

</script>
@endpush