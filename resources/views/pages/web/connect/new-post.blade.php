@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<style>
  .preview-pic,
  .preview-pic-status {
    width: 100%;
    max-height: 150px;
    display: block;
    text-align: center;
    display: flex;
    justify-content: center;
    padding: 10px;
    max-width: 250px;
  }

  .img-preview-div {
    display: flex;
    margin-top: 15px;
  }

  .init-div {
    height: 50px;
    width: 50px;
  }

  .rel-div {
    border: 2px dashed #c0c0c0;
    border-radius: 15px;
    position: relative;
    height: 150px;
    width: 250px;
  }

  .delete-btn {
    position: absolute;
    right: 5px;
    top: 5px;
    cursor: pointer;
    z-index: 100;
  }
</style>
<div class="container min-vh-70">


  <div class="position-relative justify-content-between align-items-center mt-5 mb-2">
    <div class="position-absolute top-0 left-0 d-flex justify-content-start align-items-center">
      <a href="{{route('connect-internalChannels',['id'=>$id])}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
    </div>
    <div class="w-100 d-flex justify-content-center align-items-center">
      <div class="pagesTopNavLink"><span class="sicon grey-bg"><img src="{{asset('assets/web/images/icons/24/edit-white.svg')}}" class="img-fluid" /></span>Create new post</div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div>Channel Name</div>
      <div class="border-0 rounded-3 p-4 bg-aramco-grey">
        <form action="{{ route('connect-createpost') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="channel_id" value="{{$id}}">
          <div class="d-flex justify-content-start align-items-center">
            <img class="rounded-circle me-3" src="{{asset('assets/web/images/connect/avatar.png')}}" width="50" height="50">
            <div class="flex-grow-1 flex-shrink-1">
              <div class="w-100">
                <textarea class="form-control" name="post_text" rows="3" placeholder="Type your message"></textarea>
              </div>
            </div>
            <div class="d-flex justify-content-stretch align-items-start">
              <input class="post-file-upload d-none" type="file" name="post_image" multiple accept="image/png, image/jpeg" />
              <a href="#" id="post-upload" class="new-post-btn-link post-upload grey-link ms-4" data-bs-toggle="tooltip" data-bs-title="Upload Files">
                <span class="sicon"><img src="{{asset('assets/web/images/icons/24/attach-white.svg')}}" class="img-fluid" /></span>
              </a>
              <button type="submit" class="new-post-btn-link blue-link mx-4" style="border: none;"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/send-white.svg')}}" class="img-fluid" /></span></button>
            </div>
          </div>
          <div class="img-preview-div">
            <div class="init-div"></div>
            <div class="rel-div">
              <div class="delete-btn"><img src="{{asset('assets/web/images/icons/24/delete_button_large.svg')}}" /></div>
              <div style="position: absolute;">
                <img src="{{asset('assets/web/images/icons/24/upload_image.svg')}}" style="padding:10px;" class="preview-pic img-fluid" />
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@push('custom-scripts')
<script>
  $('.header').removeClass('header--light');
  $('.header').addClass('header--dark');
  $(".img-preview-div").hide();


  const tooltip = bootstrap.Tooltip.getInstance('#post-upload') // Returns a Bootstrap tooltip instance




  var readPostFiles = (input) => {

    if (input.files && input.files[0]) {
      $(".img-preview-div").show();

      var files = input.files;
      var fullFilesNames = '';
      var picReader = new FileReader();
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (files.length < 2)
          fullFilesNames = file.name;
        else
          fullFilesNames += file.name + ", ";
      }
      picReader.readAsDataURL(file);
      picReader.onload = function(e) {
        $('.preview-pic').attr('src', e.target.result);
      }
      tooltip.setContent({
        '.tooltip-inner': ''
      });
      tooltip.setContent({
        '.tooltip-inner': fullFilesNames
      });
    }
    $('.delete-btn').on("click", function(e) {
      e.preventDefault();
      $(".img-preview-div").hide();
      files = '';
      fullFilesNames = "";
      tooltip.setContent({
        '.tooltip-inner': 'Upload File'
      });
    });

  }



  $('body').on("change", ".post-file-upload", function() {
    readPostFiles(this);
  });

  $('body').on("click", ".post-upload", function(e) {
    e.preventDefault();
    $(".post-file-upload").trigger('click');
  });
</script>
@endpush