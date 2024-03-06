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
</style>

<div class="container min-vh-70">
    <div class="pageheading my-3 justify-content-between">       
    </div>
    <div class="row my-3">
        <div class="col-md-12 col-sm-12 col-12">
                <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                    <div class="row">
                        
                        <div class="row my-3">
                            <div class="col-md-12 col-sm-12 col-12">
                                    <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                                        <div class="row">                                           
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting">
                                                <div class="row justify-content-between align-items-center mt-3 mb-3">
                                                    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
                                                        <a href="{{ url()->previous() }}" class="pagesTopNavLink goto-uc-table-btn"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
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
                                                                        <div class="ms-2">{{$data->title}}</div>
                                                                    </div>
                                                                    <hr />
                                                                    <div class="mt-2">
                                                                        <div>{{$data->body}}</div>
                                                                    </div>
                                                                    <div class="mt-5" style="color:#d2d2d5;">{{date('d M Y, h:ia',strtotime($data->created_at))}}
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
                                                                    @foreach($data->receiver as $k => $rec)
                                                                    <tr>
                                                                        <td>
                                                                            <div>{{$k+1}}</div>
                                                                        </td>
                                                                        <td>{{$rec->receiver_detail->first_name.' '.$rec->receiver_detail->last_name}} 
                                                                        </td>
                                                                        <td>
                                                                            <div>{{$rec->receiver_detail->email}}</div>
                                                                        </td>
                                                                        <td>
                                                                            <!-- <div class="user-item">
                                                                                <div class="saction m-0">
                                                                                    <a class="saction-link goto-uc-set-btn"><img src="{{asset('assets/web/images/icons/24/circle_checked_large.svg')}}" class="img-fluid" /></a>
                                                                                </div>
                                                                            </div> -->
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
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

    // JSON of States for demo purposes
    var usStates = [{
            name: 'Adam Nolan Fei',
            abbreviation: 'AL',
            email: 'adam@gmail.com'
        },
        {
            name: 'Benjamin',
            abbreviation: 'AK',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Christopher',
            abbreviation: 'AS',
            email: 'christopher@gmail.com'
        },
        {
            name: 'ARIZONA',
            abbreviation: 'AZ',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Adam Nolan Fei',
            abbreviation: 'AL2',
            email: 'adam@gmail.com'
        },
        {
            name: 'Benjamin',
            abbreviation: 'AK2',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Christopher',
            abbreviation: 'AS2',
            email: 'christopher@gmail.com'
        },
        {
            name: 'ARIZONA',
            abbreviation: 'AZ2',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Adam Nolan Fei',
            abbreviation: 'AL3',
            email: 'adam@gmail.com'
        },
        {
            name: 'Benjamin',
            abbreviation: 'AK3',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Christopher',
            abbreviation: 'AS3',
            email: 'christopher@gmail.com'
        },
        {
            name: 'ARIZONA',
            abbreviation: 'AZ3',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Adam Nolan Fei',
            abbreviation: 'AL4',
            email: 'adam@gmail.com'
        },
        {
            name: 'Benjamin',
            abbreviation: 'AK4',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Christopher',
            abbreviation: 'AS4',
            email: 'christopher@gmail.com'
        },
        {
            name: 'ARIZONA',
            abbreviation: 'AZ4',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Adam Nolan Fei',
            abbreviation: 'AL5',
            email: 'adam@gmail.com'
        },
        {
            name: 'Benjamin',
            abbreviation: 'AK5',
            email: 'benjamin@gmail.com'
        },
        {
            name: 'Christopher',
            abbreviation: 'AS5',
            email: 'christopher@gmail.com'
        },
        {
            name: 'ARIZONA',
            abbreviation: 'AZ5',
            email: 'benjamin@gmail.com'
        },
    ];

    // <li> template
    
    $('.header').removeClass('header--light');
    $('.header').addClass('header--dark');

    $('.service-activity-checkbox').click(function() {
        $(this).closest('.service-activity-container').find('.service-activity-sub').toggle(this.checked);
    });

  

    

    
    

   
</script>
@endpush