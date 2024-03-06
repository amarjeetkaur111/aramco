@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />

<div class="border-bottom pb-4 mt-3">
  <div class="container">
    <!-- <div class="modal-header border-0">
      <h2 class="search__modal-logo text-center flex-grow-1">D&IT Lab Excellence</h2>
    </div> -->
      @if(Session::has('msg'))
          <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
              {{ Session::get('msg') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

    <div class="search__wrapper__small ">
      <div class="input-group search__input">
        <span class="input-group-text bg-transparent border-0">
          <svg xmlns="http://www.w3.org/2000/svg" focusable="false" width="25" height="25" viewBox="0 0 25 25">
              <g fill="#C0C0C0" fill-rule="evenodd">
                  <path d="M1.641 9.85c0-4.527 3.683-8.209 8.209-8.209s8.209 3.682 8.209 8.209c0 4.526-3.683 8.208-8.21 8.208-4.525 0-8.208-3.682-8.208-8.208zm22.98 13.61l-7.254-7.254c1.454-1.717 2.334-3.936 2.334-6.356 0-5.432-4.42-9.85-9.851-9.85C4.419 0 0 4.418 0 9.85c0 5.432 4.419 9.85 9.85 9.85 2.421 0 4.64-.879 6.356-2.334l7.254 7.255 1.16-1.16z"></path>
              </g>
          </svg>
        </span>
        <input type="text" class="form-control bg-transparent border-0" placeholder="Search Here" id="searchText">
        <button class="btn btn-outline-secondary bg-transparent border-0" type="button" id="btn_close_id" style="display: none">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.5947 7.3555C17.4072 7.16803 17.1529 7.06271 16.8877 7.06271C16.6225 7.06271 16.3682 7.16803 16.1807 7.3555L12.8877 10.6485L9.5947 7.3555C9.4061 7.17334 9.15349 7.07255 8.8913 7.07482C8.6291 7.0771 8.37829 7.18227 8.19288 7.36768C8.00747 7.55309 7.9023 7.8039 7.90002 8.0661C7.89775 8.32829 7.99854 8.5809 8.1807 8.7695L11.4737 12.0625L8.1807 15.3555C8.08519 15.4477 8.00901 15.5581 7.9566 15.6801C7.90419 15.8021 7.8766 15.9333 7.87545 16.0661C7.87429 16.1989 7.8996 16.3306 7.94988 16.4534C8.00016 16.5763 8.07441 16.688 8.1683 16.7819C8.2622 16.8758 8.37385 16.95 8.49674 17.0003C8.61964 17.0506 8.75132 17.0759 8.8841 17.0747C9.01688 17.0736 9.1481 17.046 9.2701 16.9936C9.39211 16.9412 9.50245 16.865 9.5947 16.7695L12.8877 13.4765L16.1807 16.7695C16.3693 16.9517 16.6219 17.0525 16.8841 17.0502C17.1463 17.0479 17.3971 16.9427 17.5825 16.7573C17.7679 16.5719 17.8731 16.3211 17.8754 16.0589C17.8776 15.7967 17.7769 15.5441 17.5947 15.3555L14.3017 12.0625L17.5947 8.7695C17.7822 8.58197 17.8875 8.32766 17.8875 8.0625C17.8875 7.79733 17.7822 7.54303 17.5947 7.3555ZM12.8877 0.0625C10.5143 0.0625 8.19425 0.766288 6.22086 2.08486C4.24747 3.40344 2.7094 5.27758 1.80115 7.4703C0.892895 9.66301 0.655255 12.0758 1.11828 14.4036C1.5813 16.7314 2.72419 18.8695 4.40242 20.5478C6.08065 22.226 8.21884 23.3689 10.5466 23.8319C12.8744 24.2949 15.2872 24.0573 17.4799 23.149C19.6726 22.2408 21.5468 20.7027 22.8653 18.7293C24.1839 16.756 24.8877 14.4359 24.8877 12.0625C24.8843 8.88096 23.6189 5.83071 21.3692 3.58102C19.1195 1.33133 16.0692 0.0659411 12.8877 0.0625ZM12.8877 22.0625C10.9099 22.0625 8.97649 21.476 7.332 20.3772C5.68751 19.2784 4.40578 17.7166 3.6489 15.8893C2.89203 14.0621 2.694 12.0514 3.07985 10.1116C3.4657 8.17179 4.41811 6.38996 5.81663 4.99143C7.21516 3.59291 8.99699 2.6405 10.9368 2.25465C12.8766 1.86879 14.8873 2.06683 16.7145 2.8237C18.5418 3.58058 20.1036 4.86231 21.2024 6.5068C22.3012 8.15129 22.8877 10.0847 22.8877 12.0625C22.8848 14.7138 21.8303 17.2556 19.9555 19.1303C18.0808 21.0051 15.539 22.0596 12.8877 22.0625Z" fill="#C0C0C0"/>
          </svg>
        </button>
      </div>
    </div>

  </div>
</div>

    <div class="total-user-list-container my-4">
      <div class="all-user-list">
        <div class="container" id="search_div">
          <ul class="list-unstyled invite-user-list mb-0" id="invite-user-list">

          </ul>
        </div>
      </div>
      <div class="splitter-horizontal"></div>
        <div class="w-100">
            <form action="{{ route('services-admin-store-invite-data') }}" method="post">
                @csrf
                <input type="hidden" name="module_name" value="{{ $module }}">
                <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}">

                @include($hidden_form);

                <div class="border-bottom mb-3">
                    <div class="invited-user-list-heading">
                        <div class="d-flex flex-row pageheading mb-2">
                            <div class="sicon" style="min-width:20px;width:20px;"><img
                                    src="{{asset('assets/web/images/icons/24/invite-list.svg')}}" class="img-fluid"/>
                            </div>
                            <div class="stext fs-4">Invite list</div>
                            <button type="submit" class="btn btn-primary rounded-4 py-1 ms-auto">Save Invites</button>
                            <a type="button" href="{{ route(CommonFunction::inviteModuleWiseCancelUrl($module), ['id' => $event_id]) }}" class="btn btn-danger rounded-4 py-1 ms-4">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="invited-list">
                    <ul class="list-unstyled invited-user-list mb-0" id="invited-user-list">

                    </ul>
                </div>
            </form>
        </div>



  </div>



@endsection
@push('custom-scripts')
<script src="{{asset('assets/web/plugins/jquery-resizable/dist/jquery-resizable.min.js')}}"></script>

    <script>
        var eventId = "{{ $event_id }}";

       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       var reservedIncubatorsValidate = () => {
        $('.reservedIncubatorsForm').parsley().validate();

        if($('.reservedIncubatorsForm').parsley().isValid()){
          $('.formSuccess-modal').modal('show');
        }
       }


        $(".all-user-list").resizable({
          handleSelector: ".splitter-horizontal",
          resizeWidth: false
        });

        var userListObjArray = @json($getUsers);

        var btnClass ;
        $.each( userListObjArray, function (index,value) {

            if(value.event_invite_id == eventId)
                btnClass = "btn-gray";
            else
                btnClass = "btn-primary";

            $("#invite-user-list").append(
                '<li>'+
                '<div class="invite-user">'+
                '<div class="invite-user-details">'+value.name +'<div class="fs-5">'+value.email +'</div></div>'+
                '<button class="btn '+btnClass +' rounded-4 py-1 ms-auto invite-user-btn" data-id="'+value.id +'" data-name="'+value.name +'" data-email="'+value.email +'" data-invited="'+value.display_name +'" >Invite</button>'+
                '</div>'+
                '</li>'
            );
            if(value.event_invite_id == eventId)
                $('.invite-user-btn[data-id="'+value.id +'"]').prop("disabled",true);

        });

        $.each( userListObjArray, function (index,value) {
            if(value.event_invite_id == eventId) {
                $("#invited-user-list").append(
                    '<li id="'+value.id +'">'+
                    '<div class="invited-user with-bull">'+
                    '<div class="invited-user-details">'+value.name +' <div class="fs-5">'+value.email +'</div></div>'+
                    '<a href="#" class="py-1 ms-auto remove-invited-user-btn" data-removeid="#'+value.id +'" data-id="'+value.id +'"><img src="{{asset("assets/web/images/icons/24/cancel.svg")}}" class="img-fluid" /></a>'+
                    '</div>'+
                    '<input type="hidden" name="display_name[]" value="'+value.name+'">'+
                    '<input type="hidden" name="email[]" value="'+value.email+'">'+
                    '</li>'
                );
            }
        });

        $('body').on('click','.remove-invited-user-btn',function(e) {
            e.preventDefault();

            $($(this).attr('data-removeid')).remove();
            $('.invite-user-btn[data-id='+$(this).attr('data-id')+']').prop("disabled",false);
            $('.invite-user-btn[data-id='+$(this).attr('data-id')+']').addClass("btn-primary");
            $('.invite-user-btn[data-id='+$(this).attr('data-id')+']').removeClass("btn-gray");

            updateUserArray( $(this).attr('data-id'), "false" );
        });

        $('body').on('click','.invite-user-btn',function(e) {
            e.preventDefault();
            add_id = $(this).attr('data-id');
            add_name = $(this).attr('data-name');
            add_email = $(this).attr('data-email');

            $(this).prop("disabled",true);
            $(this).removeClass("btn-primary");
            $(this).addClass("btn-gray");

            $("#invited-user-list").prepend(
                '<li id="'+add_id +'">'+
                '<div class="invited-user with-bull">'+
                '<div class="invited-user-details">'+add_name +' <div class="fs-5">'+add_email +'</div></div>'+
                '<a href="#" class="py-1 ms-auto remove-invited-user-btn" data-removeid="#'+add_id +'" data-id="'+add_id +'"><img src="{{asset("assets/web/images/icons/24/cancel.svg")}}" class="img-fluid" /></a>'+
                '</div>'+
                '<input type="hidden" name="display_name[]" value="'+add_name +'">'+
                '<input type="hidden" name="email[]" value="'+add_email +'">'+
                '</li>'
            );

            updateUserArray( $(this).attr('data-id'), "true" );
        });

        function updateUserArray(updatedId, status){
            objIndex = userListObjArray.findIndex((obj => obj.id == updatedId));
            userListObjArray[objIndex].invited = status
        }


        $('#searchText').bind('keyup', function() {
            $('#btn_close_id').css('display', 'block');
            var searchString = $(this).val();
            if (!searchString) {
                setTimeout(function(){
                    $('#btn_close_id').css('display', 'none');
                }, 300); //Same time as animation
            }
            $("#search_div ul li").each(function(index, value) {
                currentName = $(value).text()
                if( currentName.toUpperCase().indexOf(searchString.toUpperCase()) > -1) {
                    $(value).show();
                } else {
                    $(value).hide();
                }
            });
        });

       $('#btn_close_id').on('click', function (){
           $('#searchText').val("");
           $('#searchText').trigger('keyup');

           setTimeout(function(){
               $('#btn_close_id').css('display', 'none');
           }, 300); //Same time as animation

       })



    </script>
@endpush
