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
    <form action="{{ route('calender-admin-event-status-change') }}" method="post" id="form_id">
        @csrf

        <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
        <input type="hidden" id="status_id" name="status" value="">

  <div class="pageheading my-3 justify-content-between">
    <div class="d-flex flex-row">
      <div class="sicon"><img src="{{asset('assets/web/images/icons/24/calender_large.svg')}}" class="img-fluid" /></div>
      <div class="stext">Event Management</div>
    </div>

    <div>
      <button type="submit" class="btn btn-danger accept-btn" name="status" value="Rejected">Reject</button>
      <button type="submit" class="btn btn-success ms-2 accept-btn" name="status" value="Approved">Accept</button>
    </div>
  </div>



  <div class="row my-3">
    <div class="col-md-12 col-sm-12 col-12">
      <div class="py-4">
        <div class="" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">

            <div>
                @if(Session::has('msg'))
                    <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                        {{ Session::get('msg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-table">

              <div class="card p-0 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden">
                <div class="card-body p-0 pb-3">
                  <div class="user-table ">
                    <table class="table table-borderless align-middle" id="user-table">
                      <thead class="bg-primary text-white">
                        <tr>
                          <th class="border-bottom border-2 fw-300" style="width:100px">
                            <div class="form-check">
                              <input class="form-check-input table-select-all" type="checkbox" value="">
                              <label class="form-check-label">Select All</label>
                            </div>
                          </th>
                          <th class="border-bottom border-2 fw-300">Event</th>
                          <th class="border-bottom border-2 fw-300">Name & Email</th>
                          <th class="border-bottom border-2 fw-300">Date</th>
                          <th class="border-bottom border-2 fw-300">Status</th>
                          <th class="border-bottom border-2 fw-300 no-sort">View</th>
                        </tr>
                      </thead>
                      <tbody id="data-wrapper">
                        @include('pages.web.calendar.load-event-data')
                      </tbody>
                    </table>
                  </div>
                    <div class="pt-2 px-3 d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-light btn-activity load-more-data">
                    <span class="loading">
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                            show more
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
    </form>

</div>

<div class="modal formSuccess-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-centered">
<div class="modal-content rounded-5">
  <div class="modal-header px-5 py-4 border-success" style="border-width:0.15rem;">
    <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-exclamation-triangle text-warning me-2" style="font-size:2rem;"></i> Warning</h4>
  </div>
  <div class="modal-body px-5 py-4">
    <p>Checkbox is required</p>
  </div>
  <div class="modal-footer p-3 border-top-0">
    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Close</button>
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

  let URL = "{{ route('calender-admin-event-management') }}";
  let page = 1;

  document.querySelector('.load-more-data').addEventListener('click', function (){
      page++;
      infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
  });

  $('.accept-btn').on('click', function (e) {
      e.preventDefault();
     if ($('.is-checked-event').filter(':checked').length === 0) {
         $('.formSuccess-modal').modal('show');
         return false;
     }
      $('#status_id').val(e.target.value);
      $('#form_id').submit();
  });
</script>
@endpush
