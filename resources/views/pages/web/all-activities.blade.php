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
      <a href="#" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>My Activity</a>
    </div>
  </div>
</div>
<div class="container min-vh-70">

  <div class="row g-4">
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-content-stretch">
      <div class="card p-3 border-0 rounded-4 w-100 bg-aramco-grey">
        <div class="card-header border-0 pb-3 bg-transparent activity-card-header">
          <div class="activity-logo"><img src="{{asset('assets/web/images/icons/24/general-service.svg')}}" class="img-fluid" /></div>
          <div class="w-100">
            <div class="activity-title text-wrap text-break">General Reservation</div>
          </div>
        </div>
        <div class="card-body py-3">
          <div class="activity-table table-responsive card-scroll-table border-0 rounded-4">
            <table class="table table-borderless align-middle" id="activity-table">
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
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>20/01/2023</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>18/08/2020</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>11/05/2021</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>18/08/2020</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>11/05/2021</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>18/08/2020</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>11/05/2021</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>18/08/2020</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>11/05/2021</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>18/08/2020</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="activity-item">
                      <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Schedule a visit 1
                      </div>
                    </div>
                  </td>
                  <td>11/05/2021</td>
                  <td><span class="text-success">Accepted</span></td>
                  <td>
                    <div class="activity-item">
                      <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                      <div class="stext">
                        Available
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="activity-item">
                      <div class="saction m-0">
                        <a class="saction-link" href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href=""><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="pt-2 d-flex justify-content-end align-items-center load-more-data">
            <button type="button" class="btn btn-light btn-activity"><span class="loading">
                <i class="fa fa-spinner fa-spin"></i>
              </span>
              show more</button>
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
<script src="{{asset('assets/web/service.js')}}"></script>
<script>
  $('.header').removeClass('header--light');
  $('.header').addClass('header--dark');
  $(document).ready(function() {
    $('#activity-table').DataTable({
      "ordering": false,
      dom: 'Plrtp',
      scrollY: '50vh',
      scrollX: false,
      scrollCollapse: false,
      paging: false,
    });
    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
  });

  
  //  Datatable.js can be used if needed for date sorting use bellow line and include moment.min.js

  //  DataTable.datetime('DD/MM/YYYY');

  //  $(document).ready(function () {
  //     $('#activity-table').DataTable( {
  //       "language": {
  //         "paginate": {
  //           "first": '<i class="fa-solid fa-angles-left"></i>',
  //           "previous": '<i class="fa-solid fa-chevron-left"></i>',
  //           "next": '<i class="fa-solid fa-chevron-right"></i>',
  //           "last": '<i class="fa-solid fa-angles-right"></i>',
  //         }
  //       },
  //       "columnDefs": [{
  //         "targets": 'no-sort',
  //          "orderable": false,
  //       },
  //       {
  //         "targets": 'date-sort',
  //         "render": DataTable.render.datetime('DD/MM/YYYY', 'Do MMMM YYYY', 'en'),
  //       }],
  //     });
  //  });
</script>
@endpush