@extends('layouts.web')
@section('content')
<style>
    .loading {
        display: none;
    }
</style>
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container">
    <div class="row justify-content-between align-items-center my-2">
        <div class="col-6 d-flex justify-content-start align-items-center">
            <div class="pageheading">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/user-completion.svg')}}" class="img-fluid" /></div>
                <div class="stext">Profile Completion</div>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <div class="dropdown-center">
                <a href="#" role="button" class="table-filter" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10" data-bs-auto-close="outside">
                    <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/sliders-white.svg')}}" class="img-fluid" /></div>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item table-filter-droptext" href="{{route('profile_list',['status'=> 'Pending'])}}">Pending</a></li>
                    <li><a class="dropdown-item table-filter-droptext" href="{{route('profile_list',['status'=> 'Approved'])}}">Approved</a></li>
                    <li><a class="dropdown-item table-filter-droptext" href="{{route('profile_list',['status'=> 'Rejected'])}}">Rejected</a></li>
                    <li><a class="dropdown-item table-filter-droptext" href="{{route('profile_list')}}">All</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container min-vh-70">

    <div class="row g-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-content-stretch">
            <div class="card p-0 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden">
                <div class="card-body p-0 pb-3">
                    <div class="card-scroll-table ">
                        <table class="table table-borderless align-middle" id="user-table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="border-bottom border-2 fw-300">Name & Email</th>
                                    <th class="border-bottom border-2 fw-300">Status</th>
                                    <th class="border-bottom border-2 fw-300 no-sort text-end">View</th>
                                </tr>
                            </thead>
                            <tbody id="data-wrapper">
                                @include('pages.web.profiles.load-pending-data')                       
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
@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/web/js/moment.min.js')}}"></script>
<script src="{{asset('assets/web/plugins/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready(function() {

        $('.header').removeClass('header--light');
        $('.header').addClass('header--dark');
    });
    //  Datatable.js can be used if needed for date sorting use bellow line and include moment.min.js

    //  DataTable.datetime('DD/MM/YYYY');

    $(document).ready(function() {
        $('#user-table').DataTable({
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
            
        });
        $('body').find('.dataTables_scrollBody').addClass("scrollbar");
    });

       var ENDPOINT = "{{ route('profile_list') }}";
       var page = 1;
       var status = "{{ Request::segment(2) }}";

       $(".load-more-data").click(function(){
           page++;
           infiniteLoadMore(page);
       });

       function infiniteLoadMore(page)
       {
           $.ajax({
               beforeSend: function() {
                   $(".loading").show();
               },
               datatype: "html",
               type: "get",
               url: ENDPOINT + "?page=" + page,
               data: {
                   _token: "{{ csrf_token() }}",
                   status:status,
               },
               success: function(response) {
                console.log(response);
                   if (response.html == '') {
                       $('.loading').text("No more data");
                       return;
                   }

                   $(".loading").hide();
                   $("#data-wrapper").append(response.html);
               },
               complete: function() {
                   $(".loading").hide();
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                   $(".loading").hide();
               }
           });
       }
</script>
@endpush