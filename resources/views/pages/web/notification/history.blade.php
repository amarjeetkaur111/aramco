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
            <div class="sicon"><img src="{{asset('assets/web/images/icons/24/clock_history_blue.svg')}}" class="img-fluid" /></div>
            <div class="stext">History</div>
        </div>
        
    </div>

    <div class="row my-3">
        <div class="col-md-12 col-sm-12 col-12">
                <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                    <div class="row">
                        
                        <div class="row my-3">
                            <div class="col-md-12 col-sm-12 col-12">
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
                                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting">

                                                <div class="row justify-content-between align-items-center mt-3 mb-3">
                                                    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                                                        <a href="#" class="pagesTopNavLink goto-uc-table-btn"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                                        <ul class="list-group list-group-flush mb-3">
                                                            <li class="list-group-item mb-3 border-0 p-0">
                                                                <div class="p-3 border-0 rounded-5 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <span class="sicon"><img src="{{asset('assets/web/images/icons/24/notification_icon.svg')}}" class="img-fluid" /></span>
                                                                        </div>
                                                                        <div class="ms-2">Pushed Notification</div>
                                                                    </div>
                                                                    <hr />
                                                                    <div class="mt-2">
                                                                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
                                                                    </div>
                                                                    <div class="mt-5" style="color:#d2d2d5;">
                                                                        12 April 2023 4:15pm
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                        <div class="user-table ">
                                                            <div>Receivers List</div>
                                                            <hr />
                                                            <table class="table table-borderless align-middle" id="user-table">
                                                                <thead class="">
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div>1</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>2</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>3</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>4</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>5</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>6</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>7</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div>8</div>
                                                                        </td>
                                                                        <td>Adam
                                                                        </td>

                                                                        <td>
                                                                            <div>adam@gmail.com</div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>



                                                </div>


                                            </div> -->
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

    let URL = "{{ route('notification-admin-notificationHistory') }}";
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