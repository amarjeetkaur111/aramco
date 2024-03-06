@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
        <a href="{{route('my-activity')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>My Activity <span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span> My Reserved Incubator</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/reserve-incubator-blue.svg')}}" class="img-fluid" /></div><div class="stext">Reserve Incubator</div>
          </div>
        </div>
        <div>Please edit the form below</div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


        <form class="reservedIncubatorsForm" action="{{ route('services-my-reserve-incubator-events-edit-post') }}" method="POST" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
            @csrf

              <input type="hidden" name="reserve_incubator_id" value="{{ $getAllocatedRequest->id }}">
              <input type="hidden" name="id" value="{{ $getAllocatedRequest->id }}">
              <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">

              <div class="row mt-5 font-1-5rem">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="row mb-5">
                          <label class="col-sm-4 col-form-label">Name of the use case<span class="text-red">*</span>
                          </label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" @if($showMode) disabled @endif name="usecase_name"
                                     value="{{ $getAllocatedRequest->usecase_name ?? "" }}" data-parsley-required
                                     data-parsley-errors-container="#sv-e1"/>
                              <div class="errorMsg d-none" id="sv-e1"></div>
                              @if ($errors->has('usecase_name'))
                                  <span class="text-danger">{{ $errors->first('usecase_name') }}</span>
                              @endif
                          </div>
                      </div>
                  </div>
                  @role('Admin|Super Admin')
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="row mb-5">
                          <label class="col-sm-4 col-form-label">Available Rooms<span class="text-red">*</span>
                          </label>
                          <div class="col-sm-8">
                              <select type="text" class="form-control" @if($showMode) disabled @endif name="space_name" data-parsley-required
                                     data-parsley-errors-container="#sv-e101">
                                  <option></option>
                                  @foreach($available_room as $key => $value)
                                      <option value="{{ $key }}" {{ ($key == $getAllocatedRequest->space_name) ? 'selected' : "" }}>{{ $value }}</option>
                                  @endforeach
                              </select>
                              <div class="errorMsg d-none" id="sv-e101"></div>
                              @if ($errors->has('space_name'))
                                  <span class="text-danger">{{ $errors->first('space_name') }}</span>
                              @endif
                          </div>
                      </div>
                  </div>
                  @endrole
              </div>

            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">Start Date<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="date" @if($showMode) disabled @endif class="form-control" onclick="(this.type='date')" name="start_date" value="{{ date('Y-m-d', strtotime($getAllocatedRequest->start_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e2"/>
                    <div class="errorMsg d-none" id="he-e2"></div>
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
                      <input type="date" @if($showMode) disabled @endif class="form-control" onclick="(this.type='date')" name="end_date" value="{{ date('Y-m-d', strtotime($getAllocatedRequest->end_date)) }}" data-parsley-required data-parsley-errors-container="#sv-e3"/>
                      <div class="errorMsg d-none" id="he-e3"></div>
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
                    <input type="text" @if($showMode) disabled @endif class="form-control" name="contact_of_usecase" value="{{ $getAllocatedRequest->contact_of_usecase ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e4"/>
                    <div class="errorMsg d-none" id="he-e4"></div>
                      @if ($errors->has('contact_of_usecase'))
                          <span class="text-danger">{{ $errors->first('contact_of_usecase') }}</span>
                      @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-5">
                  <label class="col-sm-4 col-form-label">No.of employees working on use case<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <input type="number" @if($showMode) disabled @endif class="form-control" min="0" name="num_of_employees" value="{{ $getAllocatedRequest->num_of_employees ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e5"/>
                    <div class="errorMsg d-none" id="he-e5"></div>
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
                    <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif rows="3" data-parsley-required data-parsley-errors-container="#he-e6" name="justification">{{ $getAllocatedRequest->justification ?? "" }}</textarea>
                    <div class="errorMsg d-none" id="he-e6"></div>
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
                    <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif rows="3" data-parsley-required data-parsley-errors-container="#he-e7" name="additional_info">{{ $getAllocatedRequest->additional_info ?? "" }}</textarea>
                    <div class="errorMsg d-none" id="he-e7"></div>
                      @if ($errors->has('additional_info'))
                          <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                      @endif
                  </div>
                </div>
              </div>
              @if(!$showMode)
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
                <label class="col-sm-2 hidden-xs col-form-label"></label>
                <button type="submit" class="btn btn-primary rounded-4 py-1" onClick="reservedIncubatorsModifyValidate()">Save Changes</button>
              </div>
              @endif
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
       var reservedIncubatorsValidate = () => {
        $('.checkfeedbackForm').addClass('d-none');
        $('.reservedIncubatorsForm').parsley().validate();
        if($('.reservedIncubatorsForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }
       var reservedIncubatorsModifyValidate = () => {
        $('.checkfeedbackForm').removeClass('d-none');
        $('.reservedIncubatorsForm').parsley().validate();
        $('.checkfeedbackForm').parsley().validate();
        if( $('.reservedIncubatorsForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
          $('.formSuccess-modal').modal('show');
        }
       }
       var checkfeedbackValidate = () => {
        $('.checkfeedbackForm').removeClass('d-none');
        $('.checkfeedbackForm').parsley().validate();
        if($('.checkfeedbackForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }

       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
