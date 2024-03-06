@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">

      <div class="row justify-content-between align-items-center mt-5 mb-4">
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
          <a href="{{route('services-admin-cancel-submit-idea-list')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
        </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading mb-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea-blue.svg')}}" class="img-fluid" /></div><div class="stext">Submit an Idea</div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-bottom pt-3 pb-4 mb-3">
          <div class="user-list">
            <span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/user-profile-white.svg')}}" class="img-fluid" /></span>
            <div class="w-100">
              <div class="user-details fs-4" style="color: #323232;">{{ ucwords($getSubmitIdea->user->first_name) }}</div>
              <div class="user-details" style="color: #5F6369;">{{ $getSubmitIdea->user->email }}</div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="infoDesc mt-0 {{ CommonFunction::statusWiseServiceColor($getSubmitIdea->status_of_request) }}"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning-yellow.svg')}}" class="img-fluid" /></span>Status : {{ $getSubmitIdea->status_of_request ?? "" }}</div>

            <form id="submitAnIdeaForm" method="post" action="{{ route('services-admin-cancel-submit-idea') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $getSubmitIdea->id }}">
                <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">
                <div class="row mt-5 font-1-5rem">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Select Track / Channel<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="track_channel" value="{{ $getSubmitIdea->track_channel ?? "" }}" data-parsley-required data-parsley-errors-container="#sv-e1"/>
                                <div class="errorMsg d-none" id="sv-e1"></div>
                                @if ($errors->has('track_channel'))
                                    <span class="text-danger">{{ $errors->first('track_channel') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row font-1-5rem">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Idea Name<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="idea_name" value="{{ $getSubmitIdea->idea_name ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e1"/>
                                <div class="errorMsg d-none" id="he-e1" ></div>
                                @if ($errors->has('idea_name'))
                                    <span class="text-danger">{{ $errors->first('idea_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Contributor<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="contributors" value="{{ $getSubmitIdea->contributors ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e2"/>
                                <div class="errorMsg d-none" id="he-e2"></div>
                                @if ($errors->has('contributors'))
                                    <span class="text-danger">{{ $errors->first('contributors') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Idea Problem<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="idea_problem" value="{{ $getSubmitIdea->idea_problem ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e3"/>
                                <div class="errorMsg d-none" id="he-e3"></div>
                                @if ($errors->has('idea_problem'))
                                    <span class="text-danger">{{ $errors->first('idea_problem') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Idea Solution<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="idea_solution" value="{{ $getSubmitIdea->idea_solution ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e4"/>
                                <div class="errorMsg d-none" id="he-e4"></div>
                                @if ($errors->has('idea_solution'))
                                    <span class="text-danger">{{ $errors->first('idea_solution') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Idea Resource Requirement<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="idea_resource_requirement" value="{{ $getSubmitIdea->idea_resource_requirement ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e5"/>
                                <div class="errorMsg d-none" id="he-e5"></div>
                                @if ($errors->has('idea_resource_requirement'))
                                    <span class="text-danger">{{ $errors->first('idea_resource_requirement') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 font-1-5rem">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-4 col-form-label">Point of Contact<span class="text-red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" @if($showMode) disabled @endif name="point_of_contact" value="{{ $getSubmitIdea->point_of_contact ?? "" }}" data-parsley-required data-parsley-errors-container="#he-e6"/>
                                <div class="errorMsg d-none" id="he-e6"></div>
                                @if ($errors->has('point_of_contact'))
                                    <span class="text-danger">{{ $errors->first('point_of_contact') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label">Technology<span class="text-red">*</span> </label>
                            <div class="col-sm-10">
                                <select class="form-select form-select2-nosearch" @if($showMode) disabled @endif data-theme="bootstrap-5" data-placeholder=" " name="technology" id="technologyList" data-parsley-required data-parsley-errors-container="#he-e8">
                                    <option> </option>
                                    @foreach($technologiesList as $data)
                                        <option class="p-2" value="{{ $data->id }}" {{ ($data->id == $getSubmitIdea->technology) ? "selected" : "" }}>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                <div class="errorMsg d-none" id="he-e8"></div>
                                @if ($errors->has('technology'))
                                    <span class="text-danger">{{ $errors->first('technology') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6 col-sm-12 col-12" id="otherDiv" style="display: {{ ($getSubmitIdea->technology == 6) ? 'block' : 'none'}};">
                            <div class="row mb-5">
                                <label class="col-sm-2 col-form-label">Other Technology </label>
                                <div class="col-sm-10">
                                    <input type="text" @if($showMode) disabled @endif class="form-control" name="other_technology" id="other_technology_id" value="{{ $getSubmitIdea->other_technology ?? "" }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-sm-2 col-form-label">Current Implementation level<span class="text-red">*</span> </label>
                            <div class="col-sm-10">
                                <select class="form-select form-select2-nosearch" @if($showMode) disabled @endif data-theme="bootstrap-5" data-placeholder=" " name="current_implementation_level" data-parsley-required>
                                    <option> </option>
                                    @foreach($implementationList as $data)
                                        <option class="p-2" value="{{ $data->id }}" {{ ($data->id == $getSubmitIdea->current_implementation_level) ? "selected" : "" }}>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                <div class="errorMsg d-none" id="he-e9"></div>
                                @if ($errors->has('current_implementation_level'))
                                    <span class="text-danger">{{ $errors->first('current_implementation_level') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <div class="fileInput-customIcon">
                                    <div class="form-fileInput">
                                        <label>Attach Files ( 10 MB max )
                                            @if(!empty($getSubmitIdea->attachment))
                                                <a class="btn btn-primary rounded-4 py-1" href="{{ $getSubmitIdea->attachment ?? "" }}"
                                                   ref="noopener" target="_blank"><i class="fas fa-download"></i> Attach Files</a>
                                            @endif
                                        </label>
                                        <textarea class="form-control textarea-toggle-file" readonly placeholder="click to add files" rows="1"></textarea>
                                    </div>
                                    <input @if($showMode) disabled @endif class="form-control fileInput-control d-block visually-hidden" name="attachment" type="file" data-parsley-max-file-size="10" data-parsley-errors-container="#he-e10">

                                    <div class="errorMsg d-none" id="he-e10"></div>
                                </div>
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

      //  window.Parsley.addValidator('maxFileSize', {
      //     validateString: function(_value, maxSize, parsleyInstance) {
      //       if (!window.FormData) {
      //         return true;
      //       }
      //       var files = parsleyInstance.$element[0].files;
      //       var fullFilesSize = 0;
      //       for (var i = 0; i < files.length; i++) {
      //         var file = files[i];
      //         fullFilesSize += file.size;
      //       }
      //       console.log(fullFilesSize)
      //       // return files.length != 1  || files[0].size <= (maxSize * 1024 * 1024);
      //       return fullFilesSize <= (maxSize * 1024 * 1024);
      //     },
      //     requirementType: 'integer',
      //     messages: {
      //       en: 'Upload should not be larger than %s MB.',
      //       ar: 'Upload should not be larger than %s MB.'
      //     }
      // });
      //
      //  var submitAnIdeaValidate = () => {
      //
      //   $('.checkfeedbackForm').addClass('d-none');
      //   $('.submitAnIdeaForm').parsley().validate();
      //
      //   if($('.submitAnIdeaForm').parsley().isValid()){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }
      //  var submitAnIdeaModifyValidate = () => {
      //
      //   $('.checkfeedbackForm').removeClass('d-none');
      //   $('.submitAnIdeaForm').parsley().validate();
      //   $('.checkfeedbackForm').parsley().validate();
      //
      //   if( $('.submitAnIdeaForm').parsley().isValid() && $('.checkfeedbackForm').parsley().isValid() ){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }
      //
      //  var checkfeedbackValidate = () => {
      //
      //   $('.checkfeedbackForm').removeClass('d-none');
      //   $('.checkfeedbackForm').parsley().validate();
      //
      //   if($('.checkfeedbackForm').parsley().isValid()){
      //     $('.formSuccess-modal').modal('show');
      //   }
      //  }





       $('.comments').on("input", function() {
        var currentLength = $(this).val().length;
        $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      });
    </script>
@endpush
