@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />

    <div class="container">
      <div class="row justify-content-between align-items-center my-3">
        <div class="col-12 d-flex justify-content-start align-items-center">
          <nav class="aram-breadcrumb">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('my-activity')}}">My Activity</a></li>
                <li class="breadcrumb-item active">Submit an Idea</li>
              </ol>
          </nav>
        </div>
      </div>
    </div>

    <div class="container min-vh-70">

      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="pageheading my-3">
              <div class="sicon"><img src="{{asset('assets/web/images/icons/24/submit-an-idea-blue.svg')}}" class="img-fluid" /></div><div class="stext">Submit an Idea</div>
          </div>
          <p class="pagesubheading mb-2">Please Edit the form below</p>

          <form class="submitAnIdeaForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled]" >
            <div class="row mt-5 font-1-5rem">

              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Select Track / Channel </label>
                  <div class="col-sm-8">
                    <!-- <select class="form-select form-select2-nosearch" data-theme="bootstrap-5" data-placeholder=" ">
                      <option> </option>
                      <option class="p-2" value="1">Track 01 / Channel 01</option>
                      <option class="p-2" value="2">Track 02 / Channel 02</option>
                      <option class="p-2" value="3">Track 03 / Channel 03</option>
                      <option class="p-2" value="4">Track 04 / Channel 04</option>
                      <option class="p-2" value="5">Track 05 / Channel 05</option>
                      <option class="p-2" value="6">Track 06 / Channel 06</option>
                    </select> -->
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e"></div>
                  </div>
                </div>
              </div> 
            </div> 
            <div class="row font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Idea Name </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e1"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Contributor </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e2"></div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Idea Problem </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e3"></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Idea Solution </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e4"></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Idea Resource Requirement </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e5"></div>
                  </div>
                </div>
              </div> 
            </div> 
            <div class="row mb-4 font-1-5rem">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Point of Contact </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e6"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Technology </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e8"></div>
                  </div>
                </div>
                <div class="row mb-0">
                  <label class="col-sm-2 col-form-label">Current Implementation level </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"/>
                    <div class="errorMsg d-none" id="he-e9"></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-3">
                      <div class="fileInput-customIcon">
                        <div class="form-fileInput">
                          <label>Attach Files ( 10 MB max )</label>
                          <textarea class="form-control" readonly placeholder="click to add files" rows="1"></textarea>                    
                        </div>  
                        <input class="form-control fileInput-control" type="file" data-parsley-required data-parsley-max-file-size="10" data-parsley-errors-container="#he-e10">
                        <div class="errorMsg d-none" id="he-e10"></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end align-items-end">
                <button type="button" class="btn btn-primary" onClick="submitAnIdeaValidate()">Save Changes</button>
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
        <p>Details saved successfully</p>
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

       var submitAnIdeaValidate = () => {
        $('.submitAnIdeaForm').parsley().validate();

        if($('.submitAnIdeaForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }

    </script>
@endpush