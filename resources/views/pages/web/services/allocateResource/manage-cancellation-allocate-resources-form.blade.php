@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{ route('services-admin-cancel-allocate-resources-list') }}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
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
              <div class="user-details fs-4" style="color: #323232;">{{ ucwords($getComputingRequest->user->first_name) }}</div>
              <div class="user-details" style="color: #5F6369;">{{ $getComputingRequest->user->email }}</div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="infoDesc mt-0 {{ CommonFunction::statusWiseServiceColor($getComputingRequest->status_of_request) }}"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : {{ $getComputingRequest->status_of_request ?? "" }}</div>

            <form class="allocatedComputingResourcesForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" action="{{ route('services-admin-cancel-allocate-resources') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $getComputingRequest->id }}">
                <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">

                <div class="row mt-5 font-1-5rem">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Name of the use case</label>
                            <div class="col-sm-8">
                                <input type="text" name="usecase_name" @if($showMode) disabled @endif value="{{$getComputingRequest->usecase_name}}" class="form-control" data-parsley-required data-parsley-errors-container="#he-e"/>
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
                            <label class="col-sm-4 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                <input type="date" name="start_date" @if($showMode) disabled @endif value="{{ date('Y-m-d', strtotime($getComputingRequest->start_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#he-e1"/>
                                <div class="errorMsg d-none" id="he-e1"></div>
                                @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">End Date </label>
                            <div class="col-sm-8">
                                <input type="date" name="end_date" @if($showMode) disabled @endif value="{{ date('Y-m-d', strtotime($getComputingRequest->end_date)) }}" class="form-control" onclick="(this.type='date')" data-parsley-required data-parsley-errors-container="#he-e2"/>
                                <div class="errorMsg d-none" id="he-e2"></div>
                                @if ($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Main contact of the use case </label>
                            <div class="col-sm-8">
                                <input type="text" name="contact_of_usecase" @if($showMode) disabled @endif value="{{$getComputingRequest->contact_of_usecase}}" class="form-control" data-parsley-required data-parsley-errors-container="#he-e3"/>
                                <div class="errorMsg d-none" id="he-e3"></div>
                                @if($errors->has('contact_of_usecase'))
                                    <span class="text-danger">{{ $errors->first('contact_of_usecase') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 font-1-5rem">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">No.of employees working on use case </label>
                            <div class="col-sm-8">
                                <input type="number" name="num_of_employees" @if($showMode) disabled @endif  class="form-control" min="0" value="{{$getComputingRequest->num_of_employees}}" data-parsley-required data-parsley-errors-container="#he-e4"/>
                                <div class="errorMsg d-none" id="he-e4"></div>
                                @if($errors->has('num_of_employees'))
                                    <span class="text-danger">{{ $errors->first('num_of_employees') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label">Justification </label>
                            <div class="col-sm-10">
                                <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif name="justification" rows="3" data-parsley-required data-parsley-errors-container="#he-e5">{{$getComputingRequest->justification}}</textarea>
                                <div class="errorMsg d-none" id="he-e5"></div>
                                @if($errors->has('justification'))
                                    <span class="text-danger">{{ $errors->first('justification') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label">Additional Information </label>
                            <div class="col-sm-10">
                                <textarea class="form-control textarea-toggle" @if($showMode) disabled @endif name="additional_info" rows="3" data-parsley-required data-parsley-errors-container="#he-e6">{{$getComputingRequest->additional_info}}</textarea>
                                <div class="errorMsg d-none" id="he-e6"></div>
                                @if($errors->has('additional_info'))
                                    <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-end gap-3 mt-3">
                        <label class="col-sm-2 hidden-xs col-form-label"> </label>
                        <button type="submit" name="cancellation_request" value="Approved" class="btn btn-success rounded-4 py-1" >Accept</button>
                        <button type="submit" name="cancellation_request" class="btn btn-danger rounded-4 py-1" value="Rejected">Reject</button>
                    </div>

                    <div class="check-feedback-form">
                        <div class="row font-1-5rem">
                            <div class="col-sm-10 col-12 offset-sm-2 border-top mt-3 mb-4 pt-3">
                                <div class="form-floating mb-2 position-relative">
                                    <textarea class="form-control comments" rows="3" name="feedback" maxlength="100" placeholder="Enter Feedback.." data-parsley-minlength="20" data-parsley-errors-container="#fb-e1"></textarea>
                                    <label>Enter Feedback..</label>
                                    <div class="d-flex justify-content-start align-items-start taCountContainer">
                                        <div class="errorMsg d-none" id="fb-e1"></div>
                                        <span class="ms-auto fs-5"><span class="taCount">0</span>/100</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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


       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
