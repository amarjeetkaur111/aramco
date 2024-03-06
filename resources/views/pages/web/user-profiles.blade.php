@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container">
      <div class="row justify-content-between align-items-center my-2">
        <div class="col-6 d-flex justify-content-start align-items-center">
            <div class="pageheading">
                <div class="sicon"><img src="{{asset('assets/web/images/icons/24/user-profile.svg')}}" class="img-fluid" /></div><div class="stext">User Profiles</div>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <div  class="dropdown-center">
              <a href="#"  role="button" class="table-filter" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10" data-bs-auto-close="outside"><div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/sliders-white.svg')}}" class="img-fluid" /></div></a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item table-filter-droptext" href="#">Full Access</a></li>
                <li><a class="dropdown-item table-filter-droptext" href="#">Admin Access</a></li>
                <li><a class="dropdown-item table-filter-droptext" href="#">Limited Access</a></li>
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
                      <th class="border-bottom border-2 fw-300">Serial No</th>
                      <th class="border-bottom border-2 fw-300">Name & Email</th>
                      <th class="border-bottom border-2 fw-300">Status</th>
                      <th class="border-bottom border-2 fw-300 no-sort">View</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>01</td>
                      <td>Adam <div class="fs-5">adam@gmail.com</div></td>
                      <td>Full Access</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>02</td>
                      <td>Benjamin <div class="fs-5">benjamin@gmail.com</div></td>
                      <td>Full Access</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>03</td>
                      <td>Christopher <div class="fs-5">christopher@gmail.com</div></td>
                      <td>Limited Access</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>04</td>
                      <td>David <div class="fs-5">david@gmail.com</div></td>
                      <td>Full Access</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>05</td>
                      <td>Adam <div class="fs-5">adam@gmail.com</div></td>
                      <td>Admin</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>06</td>
                      <td>Benjamin <div class="fs-5">benjamin@gmail.com</div></td>
                      <td>Full Access</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>07</td>
                      <td>Christopher <div class="fs-5">christopher@gmail.com</div></td>
                      <td>Admin</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>08</td>
                      <td>David <div class="fs-5">david@gmail.com</div></td>
                      <td>Limited Access</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link" href="{{route('user-profile-form')}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
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
    $(document).ready(function () {
       
       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');
    });
      //  Datatable.js can be used if needed for date sorting use bellow line and include moment.min.js

      //  DataTable.datetime('DD/MM/YYYY');

       $(document).ready(function () {
          $('#user-table').DataTable( {
            "ordering": false,
            dom: 'Plrtp',
            scrollY: '50vh',
            scrollX: false,
            scrollCollapse: false,
            paging: false,
          });
       });

    </script>
@endpush