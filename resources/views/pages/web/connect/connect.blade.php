@extends('layouts.web')
@section('content')
<style>
  .loading {
    display: none;
  }
  .jconfirm .confirmation-content {
    font-size: 18px;
    color: #333;
    padding: 20px;
}

.jconfirm-buttons .btn {
    background-color: #007bff;
    color: #fff;
    border: none;
}
.blocked-text {
    color: #ff0000; /* Red color */
    font-weight: bold;
}

/* .jconfirm-box-container {
    background-color: rgba(0, 0, 0, 0.5);
} */
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            <ul class="list-group list-group-flush notiCardList scrollableNotiList" data-name="popover-content">
            </ul>
          </div>
        </div>

      </div>
      <a href="{{route('connect-myPosts')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/posts.svg')}}" class="img-fluid" /></span>My Posts</a>
    </div>
  </div>
  @role('Admin|Super Admin')
  <div class="row justify-content-between align-items-center mt-3">
    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-start align-items-center">
      <a href="{{route('connect-admin-add-channel')}}" class="pagesTopNavLink text-blue mb-0 fs-4"><span class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/plus-white.svg')}}" class="img-fluid" /></span>Add Channel</a>
    </div>
  </div>
  @endrole
  @if(Session::has('msg'))
  <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
    {{ Session::get('msg') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="row g-4 my-4" id="data-wrapper">
    @include('pages.web.connect.channel-data')
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-12 py-4 d-flex justify-content-center align-items-center">
    <button type="button" id="viewMoreBtn" class="btn btn-primary load-more-data">
      <span class="loading">
        <i class="fa fa-spinner fa-spin"></i>
      </span> View more
    </button>
  </div>



</div>



<div class="modal delete-connect-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-centered">
    <div class="modal-content rounded-5">
      <div class="modal-header px-5 py-4 border-danger" style="border-width:0.15rem;">
        <h4 class="modal-title fs-4 d-flex align-items-center"><i class="fa-solid fa-circle-exclamation text-danger me-2" style="font-size:2rem;"></i> Delete channel</h4>
      </div>
      <div class="modal-body px-5 py-4">
        <p class="fs-5">Are you sure to delete this channel ?</p>
      </div>
      <div class="modal-footer p-3 border-top-0">
        <a href=""><button type="button" class="btn btn-sm py-2 btn-light rounded-3" data-bs-dismiss="modal">Delete</button></a>
        <button type="button" class="btn btn-sm py-2 btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/jquery-bootpag/jquery.bootpag.min.js')}}"></script>
<script src="{{asset('assets/web/service.js')}}"></script>
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

// Block and unblock channel code
  $('body').on("click", ".channelStatus", function(e) {
    var status = $(this).attr('data-code');
    var channelId = $(this).attr('data-channel');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.confirm({
      title: 'Do you want to '+ status +' '+'Channel?',
      content: '',
      autoClose: 'cancel|8000',
      buttons: {
        yes: function() {
          $.ajax({
            url: '{{route("connect-admin-block-unblock-channel")}}',
            type: 'post',
            data: {
              channel_id: channelId,
              code: status
            },
            success: function(response) {
              $.alert({
                title: 'Success',
                content: response.message,
                buttons: {
                  ok: function() {
                    location.reload();
                  }
                }
              });
            },
            error: function(xhr, status, error) {
              console.log("Error:", error);
            }
          });
        },
        cancel: function() {

        }
      }
    });
  })

  $('body').on("click", ".channels-posts-click", function(e) {
    var status = $(this).attr('data-status');
    var url = $(this).attr('data-ch-internal');
    if (status == 'Blocked') {
     $.confirm({
        title: 'Blocked!',
        content: '<div class="confirmation-content"><i class="fas fa-ban" style="color:red"></i> <span class="blocked-text">This Channel is blocked!</span></div>',
        buttons: {
          Ok: function() {

          },
        }
      });
    } else {
      window.location.href = url;
    }
  })


  $('body').on("click", ".delete-connect", function(e) {
    e.preventDefault();
    var channelId = $(this).attr('data-channel');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.confirm({
      title: 'Delete Channel?',
      content: '',
      autoClose: 'cancel|8000',
      buttons: {
        delete: function() {
          $.ajax({
            url: '{{route("connect-admin-delete-channel")}}',
            type: 'post',
            data: {
              channel_id: channelId
            },
            success: function(response) {
              $.alert({
                title: 'Success',
                content: response.message,
                buttons: {
                  ok: function() {
                    location.reload();
                  }
                }
              });
            },
            error: function(xhr, status, error) {
              console.log("Error:", error);
            }
          });
        },
        cancel: function() {

        }
      }
    });


  });

  let URL = "{{ route('connect-connect') }}";
  let page = 1;

  document.querySelector('.load-more-data').addEventListener('click', function() {
    page++;
    console.log(URL + "?page=" + page)
    infiniteLoadMore(URL + "?page=" + page, 'loading', 'data-wrapper');
  });
</script>

<script>
  const element = document.getElementById('limitedContent');
  if (element) {
    const content = element.textContent;
    const limit = 60; // Replace with your desired character limit

    if (content.length > limit) {
      element.textContent = content.substring(0, limit) + '.......';
    }
  }


  function notifications()
  {
    $.ajax({
          method: "get",
          url: "{{route('connect-getReceiverNotifications')}}",
          success: function(data){
            console.log(data);
            $('.notiCardList').empty();
            $.each(data.result, function(key,value) {
              var img = value.sender.sender_detail.profile_photo ?? "{{asset('assets/web/images/avatar.png')}}";
              $('.notiCardList').append(
                `<li class="list-group-item">
                  <div class="notiCardList-icon">
                    <div class="noti-icon "><img src="${img}" class="img-fluid" /></div>
                  </div>
                  <div class="notiCardList-content flex-grow-1">
                    <p class="noti-matter"><b>${value.sender.sender_detail.first_name} ${value.sender.sender_detail.last_name}</b> commented on your post <b>“${value.sender.body}”</b> </p>
                    <p class="noti-time">${value.created_at_ago} at ${value.time}</p>
                  </div>
                  <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
                </li>`
              );
            });
          },
          error: function(xhr, status, error){
              console.log(error);
              alert("something went wrong");
          }
      });
      setTimeout(notifications, 30000);
  }

  notifications();
</script>


@endpush
