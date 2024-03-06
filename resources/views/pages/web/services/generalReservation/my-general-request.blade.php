@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<style>
  .loading {
    display: none;
  }

  .card-scroll-table .dataTables_scrollHead {
    background: none !important;
    border-bottom: 1px solid #DADADA !important;
  }
  div.dataTables_scrollBody {
    border-left: none !important;
}
</style>
<div class="container">
  <div class="row justify-content-between align-items-center my-3">
    <div class="col-12 d-flex justify-content-start align-items-center">
      <a href="{{route('my-activity')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>My Activity</a>
    </div>
  </div>
</div>
<div class="container min-vh-70">

  <div class="row g-4">
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-content-stretch">
      <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
        <div class="card-header border-0 pb-3 bg-transparent activity-card-header">
          <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></div>
          <div class="w-100">
            <div class="activity-title text-wrap text-break">General Reservation Requests</div>
          </div>
        </div>
        <div class="card-body py-3">
          <div class="activity-table table-responsive card-scroll-table border-0 rounded-4" style="min-height:40vh">
            <table class="table table-borderless align-middle" id="scheduled-visit-table">
              <thead>
                <tr>
                  <th class="fw-300">Title</th>
                  <th class="fw-300 date-sort">Date</th>
                  <th class="fw-300">Status</th>
                  <th class="fw-300 no-sort">Feedback</th>
                  <th class="fw-300 no-sort">Actions</th>
                </tr>
              </thead>
              <tbody id="data-wrapper">
                @include('pages.web.services.load-my-data')
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
  $(document).ready(function () {
      $('#scheduled-visit-table').DataTable({
          "ordering": false,
          dom: 'Plrtp',
          // scrollY: '50vh',
          // scrollX: false,
          // scrollCollapse: false,
          paging: false,
          columnDefs: [
            {
                targets: -1,
                className: 'action-right'
            }
          ]
      });
      // $('body').find('.dataTables_scrollBody').addClass("scrollbar");
  });

  let URL = "{{route('services-my-general-reservation-index')}}";
  let page = 1;

  document.querySelector('.load-more-data').addEventListener('click', function (){
      page++;
      infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
  });

</script>
<script>
    var route = '{{route("my-activity-del-req")}}';
</script>
<script src="{{asset('assets/web/js/requests-delete.js')}}"></script>
@endpush