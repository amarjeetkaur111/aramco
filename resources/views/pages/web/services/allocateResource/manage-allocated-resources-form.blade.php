@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{ route('services-admin-allocate-resources-list') }}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/allocate-computing-resources-blue.svg')}}" class="img-fluid" /></div><div class="stext">Allocate Computing Resources</div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-bottom pt-3 pb-4 mb-3">
          <div class="user-list">
            <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
            <div class="w-100">
              <div class="user-details fs-4" style="color: #323232;">{{ ucfirst($getComputingRequest->user->first_name) }}</div>
              <div class="user-details" style="color: #5F6369;">{{ ucfirst($getComputingRequest->user->email) }}</div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @if(Session::has('msg'))
                <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
              <!-- <div class="infoDesc mt-0 text-warning"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : Pending</div> -->
              <div class="infoDesc mt-0 {{ CommonFunction::statusWiseServiceColor($getComputingRequest->status_of_request) }}"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : {{ $getComputingRequest->status_of_request ?? "" }}</div>

          <form class="allocatedComputingResourcesForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" action="{{route('services-admin-allocate-resources-change-status')}}" method="post">
            @csrf
              <input type="hidden" name="computing_resource_id" value="{{ $getComputingRequest->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">

              <div class="row mt-5 font-1-5rem">

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Name of the use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="text" name="usecase_name" value="{{$getComputingRequest->usecase_name}}" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e"></div>
                      @if ($errors->has('usecase_name'))
                          <span class="text-danger">{{ $errors->first('usecase_name') }}</span>
                      @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="date" name="start_date" value="{{ date('Y-m-d', strtotime($getComputingRequest->start_date)) }}" class="form-control" onclick="(this.type='date')"/>
                    <div class="errorMsg d-none" id="he-e1"></div>
                      @if ($errors->has('start_date'))
                          <span class="text-danger">{{ $errors->first('start_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">End Date<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime($getComputingRequest->end_date)) }}" class="form-control" onclick="(this.type='date')"/>
                    <div class="errorMsg d-none" id="he-e2"></div>
                      @if ($errors->has('end_date'))
                          <span class="text-danger">{{ $errors->first('end_date') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Main contact of the use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="text" name="contact_of_usecase" value="{{$getComputingRequest->contact_of_usecase}}" class="form-control" />
                    <div class="errorMsg d-none" id="he-e5"></div>
                      @if ($errors->has('contact_of_usecase'))
                          <span class="text-danger">{{ $errors->first('contact_of_usecase') }}</span>
                      @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">No.of employees working on use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="number" name="num_of_employees"  class="form-control" min="0" value="{{$getComputingRequest->num_of_employees}}"/>
                    <div class="errorMsg d-none" id="he-e7"></div>
                      @if ($errors->has('num_of_employees'))
                          <span class="text-danger">{{ $errors->first('num_of_employees') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Justification<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" name="justification" rows="3" data-parsley-required data-parsley-errors-container="#he-e8">{{$getComputingRequest->justification}}</textarea>
                    <div class="errorMsg d-none" id="he-e8"></div>
                      @if ($errors->has('justification'))
                          <span class="text-danger">{{ $errors->first('justification') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-2 col-form-label">Additional Information<span class="text-red">*</span></label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea-toggle" name="additional_info" rows="3" data-parsley-required data-parsley-errors-container="#he-e9">{{$getComputingRequest->additional_info}}</textarea>
                    <div class="errorMsg d-none" id="he-e9"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              @if($getComputingRequest->status_of_request == "Pending")
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
                  <label class="col-sm-2 hidden-xs col-form-label"></label>
                  <button type="submit" name="status_of_request" value="Approved" class="btn btn-success rounded-4 py-1" onClick="showFeedbackField('accept')">Accept</button>
                  <button type="button" class="btn btn-primary rounded-4 py-1" onClick="showFeedbackField('modify')">Modify</button>
                  <button type="button" class="btn btn-danger rounded-4 py-1" onClick="showFeedbackField('reject')">Reject</button>
                </div>
              @endif

            </div>

            <div class="check-feedback-form" style="display: none">
            <div class="row font-1-5rem">
              <div class="col-sm-10 col-12 offset-sm-2 border-top mt-3 mb-4 pt-3">
                <div class="form-floating mb-2 position-relative">
                  <textarea class="form-control comments" rows="3" maxlength="100" placeholder="Enter Feedback.." name="feedback"></textarea>
                  <label>Enter Feedback..</label>
                  <div class="d-flex justify-content-start align-items-start taCountContainer">
                    <span class="ms-auto fs-5"><span class="taCount">0</span>/100</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end gap-3 mt-3" style="display: none">
              <button type="submit" class="btn btn-primary rounded-4 py-1 btn-submit" name="status_of_request" value="modify" id="btn_modify" style="display: none">Save Changes</button>
              <button type="submit" class="btn btn-primary rounded-4 py-1 btn-submit" name="status_of_request" value="Rejected" id="btn_reject" style="display: none">Save Changes</button>
          </div>

          </form>
        </div>
      </div>
    </div>

<div class="modal formSuccess-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-centered">
  <div class="modal-content rounded-5">
      <div class="modal-header px-5 py-4 border-success" style="border-width:0.15rem;">
        <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-circle-check text-success me-2" style="font-size:2rem;"></i> Success</h4>
      </div>
      <div class="modal-body px-5 py-4">
        <p class="fs-5">Service replay submitted successfully</p>
      </div>
      <div class="modal-footer p-3 border-top-0">
        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('custom-scripts')
    <script>

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       $(function() {
            $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').prop("readonly", true);
            $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').css('background-color' , '#E9ECEFFF');

            $('#form_id').parsley();
        });

      //  var allocatedComputingResourcesValidate = () => {

      //   $('.checkfeedbackForm').addClass('d-none');
      //   $('.allocatedComputingResourcesForm').parsley().validate();

      //   if($('.allocatedComputingResourcesForm').parsley().isValid()){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }
      //  var allocatedComputingResourcesModifyValidate = () => {

      //   $('.checkfeedbackForm').removeClass('d-none');
      //   $('.allocatedComputingResourcesForm').parsley().validate();
      //   $('.checkfeedbackForm').parsley().validate();

      //   if( $('.allocatedComputingResourcesForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }

      //  var checkfeedbackValidate = () => {

      //   $('.checkfeedbackForm').removeClass('d-none');
      //   $('.checkfeedbackForm').parsley().validate();

      //   if($('.checkfeedbackForm').parsley().isValid()){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }

      function showFeedbackField(status){
            if (status == "modify" || status == "reject") {
                $('.check-feedback-form').css('display', 'block');
                $('.btn-submit').css('display', 'block');
            }

            if (status == "accept") {
                $('.check-feedback-form').css('display', 'none');
                $('.btn-submit').css('display', 'none');
            }

            if (status == "modify") {
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').prop("readonly", false);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').attr('data-parsley-required', true);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').css('background-color' , '');
            } else {
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').prop("readonly", true);
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').removeAttr('data-parsley-required');
                $('input[type="text"], input[type="date"], input[type="time"], input[type="number"], .textarea-toggle').css('background-color' , '#E9ECEFFF');
            }

            if (status == "modify") {
                $('#btn_modify').css('display', 'block');
            } else {
                $('#btn_modify').css('display', 'none');
            }

            if (status == "reject") {
                $('#btn_reject').css('display', 'block');
            } else {
                $('#btn_reject').css('display', 'none');
            }


        }





       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
