@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
<div class="container min-vh-70">
  <div class="pageheading my-3">
    <div class="sicon"><img src="{{asset('assets/web/images/icons/24/notification.svg')}}" class="img-fluid" /></div>
    <div class="stext">Notifications</div>
  </div>
  <p class="pagesubheading mb-2">See all notifications below</p>
  @if(Session::has('msg'))
      <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
          {{ Session::get('msg') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
  <div class="row">
    <div class="col-12 py-4">
      <div class="card notiCard">
        <div class="card-header">
          Notifications
        </div>
        <ul class="list-group list-group-flush notiCardList">
          @forelse($data as $data)
          @if($data->module != 'connect')
          <li class="list-group-item">
            <div class="notiCardList-icon">
              <div class="noti-icon unRead"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
            </div>
            <div class="notiCardList-content flex-grow-1">
              <h3 class="noti-header"><span class="noti-title">{{$data->sender->title}}</span><span class="noti-time mx-lg-4 mx-md-0 mx-sm-0 mx-0">
              @php $date =  Carbon\Carbon::parse($data->created_at) @endphp
              @if ($date->isToday())
                  Today
              @elseif($date->isYesterday())
                  Yesterday
              @else
                  {{ $date->diffForHumans() }}
              @endif
              at {{date('h:ia',strtotime($date))}}
              </span></h3>
              <p class="noti-brief">{{$data->sender->body}}</p>
              @if($data->sender->is_feedback_on == '1')
              <div class="noti-details">
                <a href="{{ route('notification-feedback-form',['id'=> $data->notification_id]) }}">
                  <button type="button" class="btn btn-sm btn-primary rounded-pill px-4 py-1 fs-5">Provide Feedback</button>
                </a>
              </div>
              @endif
            </div>
            <a href="#" class="notiCardList-close ms-auto"><img src="{{asset('assets/web/images/icons/24/close.svg')}}" class="img-fluid" /></a>
          </li>
          @endif
          @empty
            <p>No Notification yet!</p>
          @endforelse
        </ul>
      </div>


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
    $(this).parent('.list-group-item').remove();
  });

  var feedbackform = () => {

    $('.checkfeedbackForm').addClass('d-none');
    $('.submitAnIdeaForm').parsley().validate();

    if ($('.submitAnIdeaForm').parsley().isValid()) {
      $('.formSuccess-modal').modal('show');
    }
  }

  $('body').on("click", ".noti-title", function(e) {
    e.preventDefault();
    $(this).parent('.noti-header').parent('.notiCardList-content').find('.noti-details').toggleClass('display');

  });
</script>
@endpush