@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <!-- <div class="container">
      <div class="row justify-content-between align-items-center my-3">
        <div class="col-12 d-flex justify-content-end align-items-center">
            <a href="{{ route('help-old-request') }}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/eye-yellow.svg')}}" class="img-fluid" /></span>View old requests</a>
        </div>
      </div>
    </div> -->
    <div class="container min-vh-70 d-flex justify-content-center align-items-center">
      <div class="row w-100 justify-content-center">
          
             
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading justify-content-start my-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/announcement_blue.svg')}}" class="img-fluid" /></div><div class="stext">Feedback</div>
          </div>
          <div>Submit your feedback below</div>
          <div class="d-flex justify-content-center">
                <img src="{{asset('assets/web/images/icons/24/feedback_image.svg')}}" height="200"/>
            </div>
          <p class="pagesubheading justify-content-center mb-2">Help us improve our service with your suggestions or feedback</p>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
          <form class="submitRequestForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled]" action="{{ route('notification-sendFeedback') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="google_id" name="google_id" class="form-control w-100" value="{{session('auth_google_id')}}">
          <input type="hidden" id="notification_id" name="notification_id" class="form-control w-100" value="{{last(request()->segments())}}">
              <div class="row mt-2 mb-4 font-1-5rem">           
              <div class="col-12">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" placeholder="Request Title" name="title" data-parsley-required data-parsley-errors-container="#sr-e1">
                  <label>Feedback Title</label>
                  <div class="errorMsg d-none" id="sr-e1"></div>
                        <span class="text-danger"></span>
                </div>
                <div class="form-floating mb-2">
                  <input type="email" class="form-control" placeholder="Email" name="email" data-parsley-required data-parsley-errors-container="#sr-e2">
                  <label>Email</label>
                  <div class="errorMsg d-none" id="sr-e2"></div>
                        <span class="text-danger"></span>
                </div>

                <div class="form-floating mb-2 position-relative">
                  <textarea class="form-control comments" rows="3" maxlength="100" name="comment" placeholder="Enter your Comments..." data-parsley-required data-parsley-errors-container="#sr-e3"></textarea>
                  <label>Enter your Comments...</label>
                  <div class="d-flex justify-content-start align-items-start taCountContainer">
                    <div class="errorMsg d-none" id="sr-e3"></div>
                          <span class="text-danger"></span>
                    <span class="ms-auto fs-5"><span class="taCount">0</span>/100</span>
                  </div>
                </div>
             

                <div class="d-flex justify-content-center align-items-center p-0 mt-4">
                  <button type="submit" class="btn w-100 btn-primary" onClick="submitRequestValidate()">Submit</button>
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
        <p>Request submitted successfully</p>
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

       window.Parsley.addValidator('maxFileSize', {
          validateString: function(_value, maxSize, parsleyInstance) {
            if (!window.FormData) {
              return true;
            }
            var files = parsleyInstance.$element[0].files;
            var fullFilesSize = 0;
            for (var i = 0; i < files.length; i++) {
              var file = files[i];
              fullFilesSize += file.size;
            }
            console.log(fullFilesSize)
            // return files.length != 1  || files[0].size <= (maxSize * 1024 * 1024);
            return fullFilesSize <= (maxSize * 1024 * 1024);
          },
          requirementType: 'integer',
          messages: {
            en: 'Upload should not be larger than %s MB.',
            ar: 'Upload should not be larger than %s MB.'
          }
      });

       var submitRequestValidate = () => {
        $('.submitRequestForm').parsley().validate();

        if($('.submitRequestForm').parsley().isValid()){
          //$('.formSuccess-modal').modal('show');
        }
       }

      //  $('.comments').on("input", function() {
      //   var currentLength = $(this).val().length;
      //   $(this).parent().find('.taCountContainer').find('.taCount').html(currentLength);
      // });
    </script>
@endpush
