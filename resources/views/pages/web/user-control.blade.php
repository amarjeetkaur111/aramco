@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/plugins/datatables/datatables.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

    <div class="pageheading my-3">
        <div class="sicon"><img src="{{asset('assets/web/images/icons/24/cog-blue.svg')}}" class="img-fluid" /></div><div class="stext">User Control</div>
    </div>

    <div class="row my-3">
      <div class="col-md-12 col-sm-12 col-12">

        <ul class="nav nav-pills py-4 mt-3 border-bottom aram-nav-pills">
          <li class="nav-item">
            <button class="nav-link general-tab active" data-bs-toggle="tab" data-bs-target="#general-pane" type="button" role="tab" aria-controls="general-pane" aria-selected="true">General</button>
          </li>
          <li class="nav-item">
            <button class="nav-link user-tab " data-bs-toggle="tab" data-bs-target="#users-pane" type="button" role="tab" aria-controls="users-pane" aria-selected="false">Users</button>
          </li>
        </ul>
        
        <div class="tab-content py-4">
          <div class="tab-pane fade show active" id="general-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
            <div class="row">
              <div class="col-lg-5 col-md-6 col-sm-6 col-12">
                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/service-activity.svg')}}" class="img-fluid" /></span>Services & Activity</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                  </div>
                </div>
                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/connect-black.svg')}}" class="img-fluid" /></span>Connect</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-6 col-sm-6 col-12 offset-lg-1 offset-md-0">
                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/help.svg')}}" class="img-fluid" /></span>Help</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                  </div>
                </div>

                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar-black.svg')}}" class="img-fluid" /></span>Calendar Events</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="tab-pane fade" id="users-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
            
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-table">

          <div class="card p-0 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden">
            <div class="card-body p-0 pb-3">
              <div class="card-scroll-table ">
                <table class="table table-borderless align-middle" id="user-table">
                  <thead class="bg-primary text-white">
                    <tr>
                      <th class="border-bottom border-2 fw-300" style="width:100px">
                        <div class="form-check">
                          <input class="form-check-input table-select-all" type="checkbox" value="">
                          <label class="form-check-label">Select All</label>
                        </div>
                      </th>
                      <th class="border-bottom border-2 fw-300">Name & Email</th>
                      <th class="border-bottom border-2 fw-300">Status</th>
                      <th class="border-bottom border-2 fw-300 no-sort">View</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>Adam <div class="fs-5">adam@gmail.com</div></td>
                      <td>Active</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>Benjamin <div class="fs-5">benjamin@gmail.com</div></td>
                      <td>Active</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>Christopher <div class="fs-5">christopher@gmail.com</div></td>
                      <td>Active</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>David <div class="fs-5">david@gmail.com</div></td>
                      <td>Active</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>Adam <div class="fs-5">adam@gmail.com</div></td>
                      <td>Admin</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>Benjamin <div class="fs-5">benjamin@gmail.com</div></td>
                      <td>Active</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>Christopher <div class="fs-5">christopher@gmail.com</div></td>
                      <td>Admin</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="form-check"><input class="form-check-input" type="checkbox" value=""></div></td>
                      <td>David <div class="fs-5">david@gmail.com</div></td>
                      <td>Active</td>
                      <td>
                        <div class="user-item">
                          <div class="saction m-0">
                            <a class="saction-link goto-uc-set-btn" href="#"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 user-control-setting d-none">

        <div class="row justify-content-between align-items-center mt-3 mb-3">
          <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
            <a href="#" class="pagesTopNavLink goto-uc-table-btn"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
          </div>
        </div>
        <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-12 col-12 border-end">
                
              <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item mb-3 border-0 p-0">
                  <div class="p-3 border-0 rounded-4 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                    <div class="user-list">
                      <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
                      <div class="w-100">
                        <div class="user-details fs-4" style="color: #323232;">Adib Farah</div>
                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/mail-grey.svg')}}" class="img-fluid" /></span>info@gmail.com</div>
                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/phone-grey.svg')}}" class="img-fluid" /></span>+97716845662</div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item mb-3 border-0 p-0">
                  <div class="p-3 border-0 rounded-5 w-100 bg-aramco-grey overflow-hidden justify-content-between align-items-center">
                    <div class="user-list">
                      <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
                      <div class="w-100">
                        <div class="user-details fs-4" style="color: #323232;">Adib Farah</div>
                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/mail-grey.svg')}}" class="img-fluid" /></span>info@gmail.com</div>
                        <div class="user-details text-gray"> <span class="sicon"><img src="{{asset('assets/web/images/icons/24/phone-grey.svg')}}" class="img-fluid" /></span>+97716845662</div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>

              <div class="infoDesc"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning.svg')}}" class="img-fluid" /></span>Turn on/off user functionalities</div>


                
              </div>
              <div class="col-lg-9 col-md-8 col-sm-12 col-12">
                <div class="row">
              <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="service-activity-container">
                  <div class="u-controls">
                    <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/service-activity.svg')}}" class="img-fluid" /></span>Services & Activity</div>
                    <div class="form-check form-switch ms-auto">
                      <input class="form-check-input success aram-form-check-input service-activity-checkbox" type="checkbox" role="switch">
                    </div>
                  </div>
                  <div class="service-activity-sub" style="display:none;">
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon me-1"><img src="{{asset('assets/web/images/icons/24/event-schedule.svg')}}" class="img-fluid" /></span>Schedule a visit</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/host-an-event.svg')}}" class="img-fluid" /></span>Host an Event</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources.svg')}}" class="img-fluid" /></span>Allocate Computing Resources</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator.svg')}}" class="img-fluid" /></span>Reserve an Incubator</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-technology-workshop.svg')}}" class="img-fluid" /></span>Reserve Technology Workshop</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea.svg')}}" class="img-fluid" /></span>Submit an Idea</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="u-controls">
                        <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/add-to-calender.svg')}}" class="img-fluid" /></span>Event Participation</div>
                        <div class="form-check form-switch ms-auto">
                          <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                        </div>
                      </div>
                  </div>
                </div>
                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/connect-black.svg')}}" class="img-fluid" /></span>Connect</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/help.svg')}}" class="img-fluid" /></span>Help</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
                  </div>
                </div>

                <div class="u-controls">
                  <div class="u-cont-name"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/calendar-black.svg')}}" class="img-fluid" /></span>Calendar Events</div>
                  <div class="form-check form-switch ms-auto">
                    <input class="form-check-input success aram-form-check-input" type="checkbox" role="switch">
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
    <script>
       
       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       $('.service-activity-checkbox').click(function() {
          $(this).closest('.service-activity-container').find('.service-activity-sub').toggle(this.checked);
       });

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
       
      $('.user-tab').on('click', function(e){
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
      });

      $('.table-select-all').click(function(e) {
        $('.table tbody input[type="checkbox"]').prop('checked',this.checked);
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


    </script>
@endpush