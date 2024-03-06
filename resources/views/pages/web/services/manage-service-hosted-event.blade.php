@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row gutters">
        <!-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
          <div class="card border-0 rounded-3" >
            <a class="btn btn-sm p-2 btn-primary mb-3 dropdown-toggle d-lg-none d-block" data-bs-toggle="collapse" href="#serviceListLinks" role="button" aria-expanded="false" aria-controls="serviceListLinks">
                Manage Services
            </a>
            <div class="list-group w-100 serviceListLinks " id="serviceListLinks">
              <a href="{{route('manage-service-scheduled-visit')}}" class="list-group-item list-group-item-action" aria-current="true">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage Scheduled Visit
              </a>
              <a href="{{route('manage-service-hosted-event')}}" class="list-group-item list-group-item-action active">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage Hosted Event
              </a>
              <a href="{{route('manage-allocated-computing-resources')}}" class="list-group-item list-group-item-action ">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage Allocated Computing Resources
              </a>
              <a href="{{route('manage-reserved-incubator')}}" class="list-group-item list-group-item-action">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage Reserved Incubator
              </a>
              <a href="{{route('manage-reserved-technology-workshop')}}" class="list-group-item list-group-item-action ">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage Reserved Technology Workshop
              </a>
              <a href="{{route('manage-submitted-idea')}}" class="list-group-item list-group-item-action ">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage Submitted Idea
              </a>
              <a href="{{route('manage-general-reservation')}}" class="list-group-item list-group-item-action ">
                  <i class="serviceLine">
                      <span class="line"><span class="inner"></span></span>
                    </svg>
                  </i>
                  Manage General Reservation
              </a>
            </div>
          </div>
        </div> -->
        @include('pages.web.services.common-manage-service')
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
          
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
                    <tr>
                      <td>01/02/23</td>
                      <td>Adam <div class="fs-5">adam@gmail.com</div></td>
                      <td>Pending</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>23/01/23</td>
                      <td>Benjamin <div class="fs-5">benjamin@gmail.com</div></td>
                      <td>accepted</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>22/01/23</td>
                      <td>Christopher <div class="fs-5">christopher@gmail.com</div></td>
                      <td>Modified</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>19/01/23</td>
                      <td>David <div class="fs-5">david@gmail.com</div></td>
                      <td>Pending</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>18/01/23</td>
                      <td>Adam <div class="fs-5">adam@gmail.com</div></td>
                      <td>accepted</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>16/01/23</td>
                      <td>Benjamin <div class="fs-5">benjamin@gmail.com</div></td>
                      <td>Modified</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>09/01/23</td>
                      <td>Christopher <div class="fs-5">christopher@gmail.com</div></td>
                      <td>Pending</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>06/01/23</td>
                      <td>David <div class="fs-5">david@gmail.com</div></td>
                      <td>accepted</td>
                      <td>
                        <div class="user-item justify-content-end">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('services/manage-service-hosted-event-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="pt-2 px-3 d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-light btn-activity">show more</button>
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
            columnDefs: [{ width: 200, targets: 0 }],
  "columns": [
    { "width": "20%" },
    null,
    null,
    null
  ]
          });
       });

    </script>
@endpush