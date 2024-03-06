@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">

  <div class="pageheading my-3">
    <div class="sicon"><img src="{{asset('assets/web/images/icons/24/connect.svg')}}" class="img-fluid" /></div>
    <div class="stext">Connect</div>
  </div>

  <div class="row justify-content-between align-items-center my-3">
    <div class="col-md-9 col-sm-12 col-12 d-flex justify-content-start align-items-center">
      <p class="pagesubheading mb-2">Connect, Share and learn new Technologies of this modern world </p>
    </div>
    <div class="col-md-3 col-sm-12 col-12 d-flex justify-content-end align-items-center">

      <div class="dropdown notiCard-popover-container mx-3">
        <a href="#" class="pagesTopNavLink notiDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10" data-bs-auto-close="outside"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/bell.svg')}}" class="img-fluid" /></span></a>
        <!-- notification popover html comes hare -->

        <div class="dropdown-menu dropdown-menu-end">
          <div class="card notiCard-popover border-0 rounded-4">
            <div class="card-header d-flex">
              Notifications
              <a href="#" class="noti-close text-danger ms-auto">Close</a>
            </div>
            <ul class="list-group list-group-flush notiCardList" data-name="popover-content">
              <li class="list-group-item">
                <div class="notiCardList-icon">
                  <div class="noti-icon "><img src="{{asset('assets/web/images/avatar.png')}}" class="img-fluid" /></div>
                </div>
                <div class="notiCardList-content flex-grow-1">
                  <p class="noti-matter"><b>Lex Murphy</b> commented on your post <b>“UNIX directory tree hierarchy”</b> </p>
                  <p class="noti-time">Today at 9:42 AM</p>
                </div>
                <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
              </li>
              <li class="list-group-item">
                <div class="notiCardList-icon">
                  <div class="noti-icon "><img src="{{asset('assets/web/images/avatar.png')}}" class="img-fluid" /></div>
                </div>
                <div class="notiCardList-content flex-grow-1">
                  <p class="noti-matter"><b>Lex Murphy</b> commented on your post <b>“UNIX directory tree hierarchy”</b> </p>
                  <p class="noti-time">Today at 9:42 AM</p>
                </div>
                <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
              </li>
              <li class="list-group-item">
                <div class="notiCardList-icon">
                  <div class="noti-icon "><img src="{{asset('assets/web/images/avatar.png')}}" class="img-fluid" /></div>
                </div>
                <div class="notiCardList-content flex-grow-1">
                  <p class="noti-matter"><b>Lex Murphy</b> commented on your post <b>“UNIX directory tree hierarchy”</b> </p>
                  <p class="noti-time">Today at 9:42 AM</p>
                </div>
                <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
              </li>
              <li class="list-group-item">
                <div class="notiCardList-icon">
                  <div class="noti-icon "><img src="{{asset('assets/web/images/avatar.png')}}" class="img-fluid" /></div>
                </div>
                <div class="notiCardList-content flex-grow-1">
                  <p class="noti-matter"><b>Lex Murphy</b> commented on your post <b>“UNIX directory tree hierarchy”</b> </p>
                  <p class="noti-time">Today at 9:42 AM</p>
                </div>
                <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
              </li>
              <li class="list-group-item">
                <div class="notiCardList-icon">
                  <div class="noti-icon"><img src="{{asset('assets/web/images/avatar.png')}}" class="img-fluid" /></div>
                </div>
                <div class="notiCardList-content flex-grow-1">
                  <p class="noti-matter"><b>Lex Murphy</b> commented on your post <b>“UNIX directory tree hierarchy”</b> </p>
                  <p class="noti-time">Today at 9:42 AM</p>
                </div>
                <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <a href="{{route('my-posts')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/posts.svg')}}" class="img-fluid" /></span>My Posts</a>
    </div>
  </div>

  <div class="row justify-content-between align-items-center mt-3">
    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
      <a href="{{route('connect-connect')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
    </div>
  </div>

  <div class="row my-2">
    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
      <p class="pageheading fs-3 mb-2">Create a channel</p>
    </div>
          @if(Session::has('msg'))
              <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                  {{ Session::get('msg') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
      <p class="pagesubheading mb-3" style="font-size:1.4rem">Channels are for communication and organizing them around topics like technology,Product and more.</p>
    </div>
    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
      <form class="createChannelForm w-100" data-parsley-validate data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled]" method="post" action="{{route('connect-admin-add-channel-post')}}" enctype="multipart/form-data">
        @csrf
        <div class="row font-1-5rem ">

          <div class="col-lg-6 col-md-6 col-sm-12 col-12">

            <div class="form-floating mb-2">
              <input type="text" class="form-control" name="title" placeholder="Enter channel name" data-parsley-required data-parsley-errors-container="#cc-e1" value="">
              <label>Enter channel name</label>
              <div class="errorMsg d-none" id="cc-e1"></div>
            </div>
            <div class="form-floating mb-2 position-relative">
              <textarea class="form-control comments" name="description" rows="3" maxlength="250" placeholder="Description" data-parsley-required data-parsley-errors-container="#cc-e2"></textarea>
              <label>Description</label>
              <div class="errorMsg d-none" id="cc-e2"></div>
            </div>
            <!-- <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
              <div class="infoDesc"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/warning.svg')}}" class="img-fluid" /></span>What’s this channel about ?</div>
            </div> -->
            <div class="mb-2 fileInput-customIcon mediaIcon">
              <div class="form-floating">
                <textarea class="form-control" readonly placeholder="click to add files" rows="1"></textarea>
                <label class="text-blue fs-4">Add Icon</label>
              </div>
              <input class="form-control fileInput-control" name="icon" type="file" id="iconFile" data-parsley-required data-parsley-max-file-size="5" accept="image/jpeg, image/jpg, image/png" data-parsley-filemime="image/jpeg, image/jpg, image/png" data-parsley-errors-container="#cc-e3" required>
              <div class="errorMsg d-none typErr" id="cc-e3"></div>
              <div class="typErr" id="typErr"></div>
            </div>
            <div class="d-flex justify-content-start align-items-center p-0 mt-4">
              <button type="submit" class="btn btn-primary sbtBtn" onClick="createChannelValidate()">Create Channel</button>
            </div>

          </div>

        </div>
      </form>
    </div>
  </div>




</div>
@endsection
@push('custom-scripts')
<script>
  $('.header').removeClass('header--light');
  $('.header').addClass('header--dark');

  $('body').on("click", ".notiCardList-close", function(e) {
    e.preventDefault();
    var remain = $(this).parent('.list-group-item').parent('.notiCardList').children('.list-group-item').length;
    $(this).parent('.list-group-item').remove();
    if (remain < 2)
      $(".notiDropdown").dropdown('hide');
  });

  $('body').on("click", ".noti-close", function(e) {
    e.preventDefault();
    $(".notiDropdown").dropdown('hide');
  });

  $(window).on("load resize", function(e) {
    e.preventDefault();
    $(".notiDropdown").dropdown('hide');
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

  var createChannelValidate = () => {
    $('.createChannelForm').parsley().validate();
  }
</script>

<script>
  function show_msg(id, msg) {
    $('#' + id).text(msg);
  }

  $('body').on("change", "#iconFile", function(e) {
    var selectedFile = $(this)[0].files[0];

    // Check the file type
    var allowedFileTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (selectedFile && allowedFileTypes.indexOf(selectedFile.type) === -1) {
      // alert('Invalid file type. Allowed types: JPEG, JPG, PNG.');
      show_msg('typErr', 'Invalid file type. Allowed types: JPEG, JPG, PNG.');
      e.preventDefault(); // Prevent form submission
      $('.sbtBtn').prop('disabled', true);
    } else {
      show_msg('typErr', '');
      $('.sbtBtn').prop('disabled', false);
    }
  });
</script>
@endpush