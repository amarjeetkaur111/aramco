@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<style>
    .loading {
        display: none;
    }
</style>
    <div class="container min-vh-70">

      <div class="row gutters">
        @include('pages.web.services.common-manage-cancellation-service')
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            @if(Session::has('msg'))
                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show my-5" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
          <div class="card p-0 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden my-5">
            <div class="card-body p-0 pb-3">
              <div class="card-scroll-table ">
                <table class="table table-borderless align-middle" id="scheduled-visit-table">
                  <thead class="bg-primary text-white">
                    <tr>
                      <th class="border-bottom border-2 fw-300">Date</th>
                      <th class="border-bottom border-2 fw-300">Name & Email</th>
                      <th class="border-bottom border-2 fw-300">Status</th>
                      <th class="border-bottom border-2 fw-300 no-sort text-end">View</th>
                    </tr>
                  </thead>
                  <tbody>
                  @include('pages.web.services.load-cancellation-data')
                  </tbody>
                </table>
              </div>
                <!-- <div class="pt-2 px-3 d-flex justify-content-end align-items-center">
                    <button type="button" class="btn btn-light btn-activity load-more-data">
                              <span class="loading">
                                  <i class="fa fa-spinner fa-spin"></i>
                              </span> show more
                    </button>
                </div> -->

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
<script src="{{asset('assets/web/service.js')}}"></script>
    <script>

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       $(window).on("load resize",function(e){
          e.preventDefault();
          if ($(window).width()<992){
            $(".serviceListLinks").removeClass('show');
            $(".serviceListLinks").addClass('collapse');
          }else{
            $(".serviceListLinks").addClass('show');
            $(".serviceListLinks").addClass('collapse');
          }
       });

       $(document).ready(function () {
          $('#scheduled-visit-table').DataTable( {
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
          });
       });

      //  let URL = "{{ route('services-admin-cancel-reserve-incubator-list') }}";
      //  let page = 1;

      //  document.querySelector('.load-more-data').addEventListener('click', function () {
      //      page++;
      //      infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
      //  });

    </script>
@endpush
