@extends('layouts.admin')
@section('content')
@php
  $componentdata=$contents;
//   dd($componentdata);
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
  .form-hidden{
    font-size:0px !important;
    margin: 0px !important;
    padding: 0px !important;
    border:none !important;
    height: 0px !important;
    display: inherit !important;
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
        <form method="post" action="{{ route('admin-aboutlab-updatecomponent')}}" enctype="multipart/form-data" id="form_id" class="aboutLabForm" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" >
@csrf
<input type="hidden" class="form-control" name="component_id"  value="{{  $componentdata['id']}}" />
<input type="hidden" class="form-control" name="pageid"  value="{{  $componentdata['pageid']}}" />
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
                                    <input type="text" class="form-control" name="component_title"  value="{{  $componentdata['component_title']}}" data-parsley-required data-parsley-errors-container="#al-e1"/>
                                    <span class="errorMsg" id="al-e1"></span>
                                </div>
                            </div>
                            <div class="row g-0 mb-4 pb-2 border-bottom">
                                <label class="col-sm-2 col-form-label">Select Template</label>
                                <div class="col-sm-10">
                                    <select class="form-select text-capitalize  component-content" name="template_type" data-parsley-required data-parsley-errors-container="#al-e2">
                                        <option selected disabled> Select Template </option>
                                        @foreach($templates as $template)
                                        <option value="{{ $template->template_slug}}" @if($componentdata['template_slug']==$template->template_slug)  selected="selected" @endif>{{ $template->template_name}}</option>

                                        @endforeach
                                    </select>
                                    <span class="errorMsg" id="al-e2"></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center flex-column " style="min-height:220px">

                               <div class="comp_elem w-100  only_text  @if($componentdata['template_slug']!='only_text') d-none @endif ">
                                    <div class="row g-0 mb-3 w-100 ">
                                        <label class="col-sm-2 col-form-label">Text </label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="only_text_content" row="3" data-parsley-required data-parsley-errors-container="#al-e3">{{$componentdata['text']}}</textarea>
                                            <span class="errorMsg" id="al-e3"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comp_elem w-100  only_image @if($componentdata['template_slug']!='only_image') d-none @endif ">
                                    <div class="row g-0 mb-3 w-100 ">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-5">
                                           <img src="{{ $componentdata['image']}}"  style="width:100%"/>
                                        </div>
                                    </div>
                                    <div class="row g-0 mb-3 w-100  ">
                                        <label class="col-sm-2 col-form-label">Change Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="only_image_image_update" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280" data-parsley-errors-container="#al-e4" />
                                            <input type="text" class="form-hidden" value="{{ $componentdata['image']}}" name="only_image_image_update"  data-parsley-required data-parsley-errors-container="#al-e4" />
                                            <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                            <span class="errorMsg" id="al-e4"></span>
                                        </div>
                                   </div>
                                </div>
                                <div class="comp_elem w-100 text_image @if($componentdata['template_slug']!='text_image') d-none @endif ">
                                    <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Text </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="text_image_content" row="3" data-parsley-required data-parsley-errors-container="#al-e5">{{$componentdata['text']}}</textarea>
                                                <span class="errorMsg" id="al-e5"></span>
                                            </div>
                                    </div>
                                    <div class="row g-0 mb-3 w-100 ">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-5">
                                           <img src="{{ $componentdata['image']}}"  style="width:100%"/>
                                        </div>
                                    </div>
                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Change Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="text_image_image_update" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280" data-parsley-errors-container="#al-e6" />
                                                <input type="text" class="form-hidden" value="{{ $componentdata['image']}}" name="text_image_image_update"  data-parsley-required data-parsley-errors-container="#al-e6" />
                                                <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                                <span class="errorMsg" id="al-e6"></span>
                                            </div>
                                        </div>
                                </div>

                                <div class="comp_elem w-100 image_text @if($componentdata['template_slug']!='image_text') d-none @endif">

                                    <div class="row g-0 mb-3 w-100 ">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-5">
                                            <img src="{{ $componentdata['image']}}"  style="width:100%"/>
                                         </div>
                                    </div>

                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Change Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image_text_image_update" data-parsley-imagemindimensions="1310x230" data-parsley-imagemaxdimensions="1920x1280" data-parsley-errors-container="#al-e7" />
                                                <input type="text" class="form-hidden" value="{{ $componentdata['image']}}" name="image_text_image_update" data-parsley-required data-parsley-errors-container="#al-e7" />
                                                <div class="fw-300 fst-italic text-muted text-end" style="font-size:10px;">Image dimensions should be between 1310x230 px and 1920x1280 px </div>
                                                <span class="errorMsg" id="al-e7"></span>
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-3 w-100 ">
                                            <label class="col-sm-2 col-form-label">Text </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="image_text_content"  row="3" data-parsley-required data-parsley-errors-container="#al-e8" >{{$componentdata['text']}}</textarea>
                                                <span class="errorMsg" id="al-8"></span>
                                            </div>
                                        </div>
                                </div>

                                <div class="comp_elem w-100 list @if($componentdata['template_slug']!='list') d-none @endif">
                                    <div class="row g-0 w-100 ">
                                        <label class="col-sm-2 col-form-label">List Title</label>
                                        <div class="col-sm-10 multi-input-container" >
                                            <div class="input-group mb-2">
                                                <input type="text" name="list_title" class="form-control br-375" value="{{$componentdata['list_title']}}"  data-parsley-required data-parsley-errors-container="#al-e9"/>
                                                <span class="errorMsg" id="al-e9"></span>
                                            </div>
                                        </div>


                                        <div class="offset-sm-2 offset-0 col-sm-10 multi-input-container" id="mic-01">
                                            <label class="col-form-label">List Items</label>
                                            @php
                                            $count=1;
                                            @endphp
                                            @foreach($componentdata['list'] as $data)

                                            @php
                                            if($count==1){
                                            @endphp
                                            <div class="input-group mb-2" style="margin-right:37.33px;width:auto;" id="@php echo $count.'_saved'; @endphp">
                                                <input type="text" class="form-control br-375" value="{{$data['list_point_title']}}" name="list_items[]"  data-parsley-required data-parsley-errors-container="#al-li-e0" />
                                                <span class="errorMsg w-100" id="al-li-e0"></span>

                                                </div>

                                                @php
                                                }else{

                                                @endphp


                                                <div class="input-group mb-2" id="@php echo $count.'_saved'; @endphp">
                                                <input type="text" class="form-control br-375" value="{{$data['list_point_title']}}" name="list_items[]"  data-parsley-required data-parsley-errors-container="#@php echo $count.'_savedli'; @endphp"  />

                                                <a href="#" class="btn btn-outline-primary px-2 br-375 ms-2 remove-multi-input" data-removeid="#@php echo $count.'_saved'; @endphp"><i class="fa fa-minus-circle"></i></a>
                                                <span class="errorMsg w-100" id="@php echo $count.'_savedli'; @endphp"></span>

                                                </div>


                                               @php
                                                }
                                                @endphp
                                            @php
                                            $count++;
                                            @endphp
                                            @endforeach
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
                    <button type="submit" class="btn btn-green rounded-pill" onClick="aboutLabFormValidate()">Update</button>
                    <a href="{{route('admin-aboutlab-pagecomponents',['pageid'=> $componentdata['pageid']])}}" class="btn btn-red rounded-pill">Cancel</a>
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



var readPath = (input, obj) => {
    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function (e) {

            obj.parent('div').find("input[type='text']").val(e.target.result)
            // $('.profile-pic').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('body').on( "change", "input[type='file']", function() {
    readPath(this, $(this));
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
