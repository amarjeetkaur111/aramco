@extends('layouts.admin')
@section('content')
@php
if(old('name')){
$profile_photo = old('profile_photo');
$name = old('name');
$email = old('email');
$phone = old('phone');
$dob = old('dob');
$gender = old('gender');
$nationality = old('nationality');
$job_experience = old('job_experience');
$status = old('status');
$national_id = old('national_id');
$user_roles = [];
}
else if(isset($data) && $data){
$name = $data->first_name.' '.$data->last_name;
$email = $data->email;
$profile_photo = $data->profile_photo;
$phone = $data->phone;
$dob = $data->dob;
$gender = $data->gender;
$nationality = $data->nationality;
$job_experience = $data->job_experience;
$status = $data->status;
$national_id = $data->national_id;
$user_roles = $data->roles->pluck('id');
}
else{
$name = null;
$email = null;
$phone = null;
$profile_photo = "../assets/img/avatars/1.png";
$dob = null;
$gender = null;
$nationality = null;
$job_experience = null;
$status = null;
$national_id = null;
$user_roles = [];
}
@endphp
<style>
.form-control:disabled,
.form-control[readonly] {
    background-color: #ffffff;
}
.br-375{
    border-radius: 0.375rem !important;
}
.multi-input-container .input-group:first-child .btn{
    display:none;
}
.component-card{
    position: relative;
}
.delete-component{
    position: absolute;
    color:#ff0000 !important;
    font-size:22px;
    z-index: 9;
    top: -15px;
    right: -10px;
}

.errorMsg{
    line-height: 0;
  }
  .errorMsg .parsley-errors-list,
  .errorMsg .parsley-required,
  .errorMsg ul{
    margin: 0px;
    padding: 0px;
    color: #F05F41;
    font-size:12px;
    /* line-height: 0rem; */
    font-weight:400;
    list-style: none;
    list-style-type: none;
  }
  .errorMsg ul{
    margin-top: 5px !important;
  }
</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    About The Lab
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('admin-aboutlab-savecomponent')}}" enctype="multipart/form-data" id="form_id" class="aboutLabForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
@csrf


<input type="hidden"  name="pageid"  value="{{ $pageid}}" >

            <!--
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 component-card" id="cc-01">
                        <div class="card-body">
                            <div class="row g-0 mb-2 pb-2">
                                <label class="col-sm-2 col-form-label">Header Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div> -->


            <div class="row" >
                <div class="col-xxl" id="compo-main-container">
                    <!-- component repeater start here -->
                    <div class="card mb-4 component-card">
                        <div class="card-body">
                            <div class="row g-0 mb-2 pb-2 border-bottom">
                                <label class="col-sm-2 col-form-label">Component Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="component_title" data-parsley-required data-parsley-errors-container="#al-e1"/>
                                    <span class="errorMsg" id="al-e1"></span>
                                </div>
                            </div>
                            <div class="row g-0 mb-4 pb-2 border-bottom">
                                <label class="col-sm-2 col-form-label">Select Template</label>
                                <div class="col-sm-10">
                                    <select class="form-select text-capitalize  component-content" name="template_type" data-parsley-required data-parsley-errors-container="#al-e2">
                                        <option selected disabled> Select Template </option>
                                        @foreach($templates as $template)
                                        <option value="{{ $template->template_slug}}">{{ $template->template_name}}</option>

                                        @endforeach
                                    </select>
                                    <span class="errorMsg" id="al-e2"></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center flex-column " style="min-height:220px">

                               <div class="comp_elem w-100  only_text d-none">
                                    <div class="row g-0 mb-3 w-100 ">
                                        <label class="col-sm-2 col-form-label">Text </label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="only_text_content" row="3" data-parsley-required data-parsley-errors-container="#al-e3"></textarea>
                                            <span class="errorMsg" id="al-e3"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comp_elem w-100  only_image d-none">
                                    <div class="row g-0 mb-3 w-100  ">
                                        <label class="col-sm-2 col-form-label">Select Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="only_image_image" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280" data-parsley-required data-parsley-max-file-size="1" data-parsley-errors-container="#al-e4" />
                                            <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                            <span class="errorMsg" id="al-e4"></span>
                                        </div>
                                   </div>
                                </div>
                                <div class="comp_elem w-100 text_image d-none">
                                    <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Text </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="text_image_content" row="3" data-parsley-required data-parsley-errors-container="#al-e5"></textarea>
                                                <span class="errorMsg" id="al-e5"></span>
                                            </div>
                                    </div>
                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Select Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="text_image_image" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280" data-parsley-required data-parsley-errors-container="#al-e6" />
                                                <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                                <span class="errorMsg" id="al-e6"></span>
                                            </div>
                                        </div>
                                </div>

                                <div class="comp_elem w-100 image_text d-none">

                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Select Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image_text_image" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280" data-parsley-required data-parsley-errors-container="#al-e7" />
                                                <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                                <span class="errorMsg" id="al-e7"></span>
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Text </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="image_text_content" row="3" data-parsley-required data-parsley-errors-container="#al-e8"></textarea>
                                                <span class="errorMsg" id="al-e8"></span>
                                            </div>
                                        </div>
                                </div>

                                <div class="comp_elem w-100 list d-none">
                                    <div class="row g-0 w-100 ">
                                        <label class="col-sm-2 col-form-label">List Title</label>
                                        <div class="col-sm-10 multi-input-container" >
                                            <div class="input-group mb-2">
                                                <input type="text" name="list_title" class="form-control br-375" data-parsley-required data-parsley-errors-container="#al-e9" />
                                                <span class="errorMsg w-100" id="al-e9"></span>
                                            </div>
                                        </div>


                                        <div class="offset-sm-2 offset-0 col-sm-10 multi-input-container" id="mic-01">
                                            <label class="col-form-label">List Items</label>
                                            <div class="input-group mb-2" style="margin-right:37.33px;width:auto;">
                                                <input type="text" class="form-control br-375" name="list_items[]" data-parsley-required data-parsley-errors-container="#al-li-e0"/>
                                                <span class="errorMsg w-100" id="al-li-e0"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <a href="#" class="btn btn-primary rounded-pill add-multi-input" data-addto="#mic-01">Add More Items</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>

                <div class="d-flex align-items-end  justify-content-end mb-3 gap-2">
                    <button type="submit" class="btn btn-green rounded-pill" onClick="aboutLabFormValidate()">Save</button>
                    <a href="{{route('admin-aboutlab-pagecomponents',['pageid' => $pageid])}}" class="btn btn-red rounded-pill">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/js/parsley.min.js')}}"></script>
<script>
// $(function() {
//     $('#form_id').parsley();
// });

$('body').on('change','.component-content',function(e) {
    e.preventDefault();

    $(".comp_elem ").addClass("d-none");
    $("."+$(this).val()).removeClass("d-none");

    $($(this).attr('data-removecomponent')).remove();

  });



$('body').on('click','.remove-multi-input',function(e) {
    e.preventDefault();

    $($(this).attr('data-removeid')).remove();

  });


  var multiInputCount=1;

  $('body').on('click','.add-multi-input',function(e) {
    e.preventDefault();

    $($(this).attr('data-addto')).append(
        '<div class="input-group mb-2" id="mi'+multiInputCount +'">'+
            '<input type="text" class="form-control br-375" name="list_items[]" data-parsley-required data-parsley-errors-container="#al-li-e'+multiInputCount +'" />'+
            '<a href="#" class="btn btn-outline-primary px-2 br-375 remove-multi-input" style="margin-left:5px" data-removeid="#mi'+multiInputCount +'"><i class="fa fa-minus-circle"></i></a>'+
            '<span class="errorMsg w-100" id="al-li-e'+multiInputCount +'"></span>'+
        '</div>'
    );
    multiInputCount++;
  });


window.Parsley.addValidator('imagemindimensions', {
    requirementType: 'string',
    validateString: function (value, requirement, parsleyInstance) {

        let file = parsleyInstance.$element[0].files[0];
        let [width, height] = requirement.split('x');
        let image = new Image();
        let deferred = $.Deferred();

        image.src = window.URL.createObjectURL(file);
        image.onload = function() {
            if (image.width >= width && image.height >= height) {
                deferred.resolve();
            }
            else {
                deferred.reject();
            }
        };

        return deferred.promise();
    },
    messages: {
        en: 'Image dimensions should be greater than %spx'
    }
});

window.Parsley.addValidator('imagemaxdimensions', {
    requirementType: 'string',
    validateString: function (value, requirement, parsleyInstance) {

        let file = parsleyInstance.$element[0].files[0];
        let [width, height] = requirement.split('x');
        let image = new Image();
        let deferred = $.Deferred();

        image.src = window.URL.createObjectURL(file);
        image.onload = function() {
            if (image.width <= width && image.height <= height) {
                deferred.resolve();
            }
            else {
                deferred.reject();
            }
        };

        return deferred.promise();
    },
    messages: {
        en: 'Image dimensions should be less than  %spx'
    }
});

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
    // console.log(fullFilesSize)
    // return files.length != 1  || files[0].size <= (maxSize * 1024 * 1024);
    return fullFilesSize <= (maxSize * 1024 * 1024);
    },
    requirementType: 'integer',
    messages: {
    en: 'Upload should not be larger than %s MB.',
    // ar: 'Upload should not be larger than %s MB.'
    }
});


var aboutLabFormValidate = () => {
    $('.aboutLabForm').parsley().validate();
    if($('.aboutLabForm').parsley().isValid()){
        return true;
    }else{
        return false;
    }
}
</script>
@endpush
