@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row gutters">
      @include('pages.web.services.common-service')
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
          <div class="pageheading my-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/event-schedule-blue.svg')}}" class="img-fluid" /></div><div class="stext">Schedule a Visit</div>
          </div>
          <div class="col-sm-12">
              @if(\Illuminate\Support\Facades\Session::has('msg')) <div class="alert alert-dismissible fade show alert-{{ \Illuminate\Support\Facades\Session::has('class') ? \Illuminate\Support\Facades\Session::get('class') : 'default' }}">
                  <strong>{{ \Illuminate\Support\Facades\Session::get('msg') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
          </div>
          <p class="pagesubheading mb-2">To schedule a visit please fill the data form below</p>

          <form class="scheduleVisitForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" action="{{$action}}" method="post" >
            @csrf
            <div class="row mt-5 mb-4 font-1-5rem">
              <input type="hidden" name="user_google_id" value="{{ auth()->user()->google_id }}">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Visit Title <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="visit_title" data-parsley-required data-parsley-errors-container="#sv-e1" placeholder="Enter Title..."/>
                    <div class="errorMsg d-none" id="sv-e1"></div>
                    @if ($errors->has('visit_title'))
                        <span class="text-danger">{{ $errors->first('visit_title') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Date of Visit <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="startDate" name="start_date" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#sv-e2" placeholder="dd/mm/yyyy">
                    <div class="errorMsg d-none" id="sv-e2"></div>
                    @if ($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                  </div>
                </div>
              </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Start Time <span class="text-red">*</span></label>
                  <div class="col-sm-8">
{{--                    <input type="text" class="form-control" name="start_time" onclick="(this.type='time')" data-parsley-required data-parsley-errors-container="#sv-e3" step="00:15"/>--}}

                      <select class="form-control" name="start_time" data-parsley-required data-parsley-errors-container="#sv-e3" >
                          <option class="disabled-opt" value="" disabled selected>HH:MM</option>
                          @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                              <option value="{{ $index }}">{{ $time }}</option>
                          @endforeach
                      </select>

                      <div class="errorMsg d-none" id="sv-e3"></div>
                    @if ($errors->has('start_time'))
                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">End Time <span class="text-red">*</span></label>
                  <div class="col-sm-8">
{{--                    <input type="text" class="form-control" name="end_time" onclick="(this.type='time')" data-parsley-required data-parsley-errors-container="#sv-e6"/>--}}

                      <select class="form-control" name="end_time" data-parsley-required data-parsley-errors-container="#sv-e6">
                        <option value="" disabled selected>HH:MM</option>
                          @foreach(CommonFunction::getTimeWithSelectionOption() as $index => $time)
                              <option value="{{ $index }}">{{ $time }}</option>
                          @endforeach
                      </select>
                      <div class="errorMsg d-none" id="sv-e6"></div>
                    @if ($errors->has('end_time'))
                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Number of Visitors <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="num_of_visitors" min="1" value="1" data-parsley-required data-parsley-errors-container="#sv-e4"/>
                    <div class="errorMsg d-none" id="sv-e4"></div>
                    @if ($errors->has('num_of_visitors'))
                        <span class="text-danger">{{ $errors->first('num_of_visitors') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Visitors Coordinator Contact <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" data-parsley-required data-parsley-errors-container="#sv-e5" name="visitor_coordinator_contact" placeholder="Enter Visitor Contact..."/>
                    <div class="errorMsg d-none" id="sv-e5"></div>
                    @if ($errors->has('visitor_coordinator_contact'))
                        <span class="text-danger">{{ $errors->first('visitor_coordinator_contact') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Justification <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="justification" data-parsley-required placeholder="Enter...."></textarea>
                    @if ($errors->has('justification'))
                        <span class="text-danger">{{ $errors->first('justification') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Additional Information <span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="additional_info" data-parsley-required placeholder="Enter...."></textarea>
                    @if ($errors->has('additional_info'))
                        <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end">
                <button type="submit" class="btn btn-primary btn-lg" onClick="scheduleVisitValidate()">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

<!-- <div class="modal formSuccess-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-centered">
  <div class="modal-content rounded-5">
      <div class="modal-header px-5 py-4 border-success" style="border-width:0.15rem;">
        <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-circle-check text-success me-2" style="font-size:2rem;"></i> Success</h4>
      </div>
      <div class="modal-body px-5 py-4">
        <p>Request submitted successfully</p>
      </div>
      <div class="modal-footer p-3 border-top-0">
        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->

@endsection
@push('custom-scripts')
    <script>

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       var scheduleVisitValidate = () => {
        $('.scheduleVisitForm').parsley().validate();

        if($('.scheduleVisitForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }

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
    </script>
    
@endpush
