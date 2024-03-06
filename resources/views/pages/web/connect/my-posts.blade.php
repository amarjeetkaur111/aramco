@extends('layouts.web')
@section('content')
<link href="{{asset('assets/web/css/aramco.css')}}" rel="stylesheet" />
    <div class="container min-vh-70">


    <div class="position-relative justify-content-between align-items-center mt-5 mb-2">
      <div class="position-absolute top-0 left-0 d-flex justify-content-start align-items-center">
        <a href="{{route('connect-connect')}}" class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/black-arrow-left.svg')}}" class="img-fluid" /></span>Back</a>
      </div>
      <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="pagesTopNavLink"><span class="sicon"><img src="{{asset('assets/web/images/icons/24/posts.svg')}}" class="img-fluid" /></span>My Posts</div>
      </div>
    </div>

      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="border-0 rounded-3 p-4 bg-aramco-grey post-List-card-container" >
          @if(count($posts) < 1)
            <p>No Post Yet!</p>
            @else
            @foreach($posts as $k => $post)
            @php 
            $date =  Carbon\Carbon::parse($post->created_at) ;
            $liked_flag = checkPostLike($post->id);
            @endphp
            <div class="card p-3 border-0 post-List-card">
              <div class="row g-0">
               @if($post->post_image)
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                  <img src="{{ $post->post_image }}" class="img-fluid rounded post-List-img mx-auto">
                </div>
                @endif
                <div class="{{$post->post_image ? 'col-md-9' : 'col-md-12'}} post-Lists">
                  <div class="card-body p-md-0 ps-md-4 p-3 h-100 d-flex flex-column justify-content-start align-items-start">
                    <div class="post-stat-info-container w-100 mb-2">
                      <p class="post-stat-info-name"> @ {{$post->user->first_name.' '.$post->user->last_name}} <span class="post-stat-info-time ms-sm-3 ms-0 d-sm-inline-block d-block">posted {{ $date->diffForHumans() }}</span></p>
                      @if($post->users_id == auth()->user()->id)
                        <div class="dropdown ms-auto">
                          <a href="#" class="connect-more-rightLink" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"><img src="{{asset('assets/web/images/connect/h-dots-dark.svg')}}" class="img-fluid" /></a>
                          <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 13rem;">
                            <li><a class="dropdown-item ararmco-dropdown-item p-2 text-danger delete-connect" data-post= "{{$post->id}}"  href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Delete Channel</a></li>
                          </ul>
                        </div>
                        @endif                      
                      <!-- <a href="#" class="post-more-link ms-auto"><img src="{{asset('assets/web/images/connect/h-dots-dark.svg')}}" class="img-fluid" /></a> -->
                    </div>
                    <p class="post-brief w-100 mb-2">{{$post->post_text}}</p>
                    <div class="post-stat-container w-100 mt-auto">
                      <a href="#" id="{{$post->id}}" class="post-stat-link post-like-link" data-status="{{$liked_flag ? 'true' : 'false'}}"><span class="post-stat-icon">
                        <svg width="19" height="17" viewBox="0 0 19 17" class="post-like-icon {{$liked_flag ? 'liked' : ''}}"  xmlns="http://www.w3.org/2000/svg">
                          <path d="M5.675 1C3.09313 1 1 3.15216 1 5.80685C1 10.6137 6.525 14.9836 9.5 16C12.475 14.9836 18 10.6137 18 5.80685C18 3.15216 15.9069 1 13.325 1C11.744 1 10.3458 1.80712 9.5 3.04248C9.06891 2.41112 8.49622 1.89586 7.8304 1.54033C7.16458 1.1848 6.42525 0.999456 5.675 1Z" stroke="#5F6369" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </span><span data-likes="{{count($post->channels_posts_likes)}}" id="liked_{{$post->id}}">{{count($post->channels_posts_likes)}}</span></a>
                      <a href="#k_{{$k}}" class="post-stat-link post-comment-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="k_{{$k}}"><span class="post-stat-icon"><img src="{{asset('assets/web/images/connect/single-bubble-dark.svg')}}" class="img-fluid" /></span><span id="count_{{$post->id}}">{{count($post->channels_posts_comments)}}</span></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- post comment section -->
              <div class="border-top mt-3 p-3 pb-0 collapse " id="k_{{$k}}">
                <div class="row">
                  <div class="col-12 post-comment-container">
                    @foreach($post->channels_posts_comments as $comment)
                    @php $commet_date =  Carbon\Carbon::parse($comment->created_at) @endphp
                    <div class="d-flex justify-content-start align-items-start flex-start">
                      <img class="rounded-circle me-3" src="{{$comment->user->profile_photo ?? asset('assets/web/images/connect/avatar.png')}}" width="36" height="36">
                      <div class="flex-grow-1 flex-shrink-1">
                        <div class="w-100 mb-4">
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="post-stat-info-name">{{$comment->user->first_name.' '.$comment->user->last_name}} <span class="post-stat-info-time ms-sm-3 ms-0 d-sm-inline-block d-block">{{ $commet_date->diffForHumans() }}</span></p>
                            <!-- <a href="#"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a> -->
                          </div>
                          <p class="post-brief w-100">{{$comment->comment_text}}</p>
                        </div>
                      </div>
                    </div>
                    
                    @endforeach
                  </div>
                  <div class="col-12 border-top pt-3">
                    <div class="d-flex justify-content-start align-items-center">
                      <img class="rounded-circle me-3" src="{{asset('assets/web/images/connect/avatar.png')}}" width="36" height="36">
                      <div class="flex-grow-1 flex-shrink-1">
                        <div class="w-100">
                          <div class="input-group p-2 border rounded-pill">
                            <input type="text" class="form-control border-0 py-1" style="box-shadow:none;" placeholder="Type your comment" id="comment_{{$post->id}}">
                            <button class="btn btn-primary rounded-pill py-1 post_comment" style="width:90px;" type="button" id="{{$post->id}}" >Post</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>

@endsection
@push('custom-scripts')
    <script>
       
       $('.header').removeClass('header--light');
       $('.header').addClass('header--dark');

       $(window).on("load resize",function(e){
          e.preventDefault();
          if ($(window).width()<992){
            $(".postListLinks").removeClass('show');
            $(".postListLinks").addClass('collapse');
          }else{
            $(".postListLinks").addClass('show');
            $(".postListLinks").addClass('collapse');
          }
       });
       $('body').on( "click", ".postListLinksCollapse", function(e) {
        e.preventDefault();
        $(this).find('.fa-solid').toggleClass('fa-chevron-down');
        $(this).find('.fa-solid').toggleClass('fa-chevron-up');
       });
       
       $('body').on( "click", ".post-like-link", function(e) {
        e.preventDefault();
        var post_id = $(this).attr('id');
        // $(this).find('span[data-likes]').html('');   
        // var likeVal = parseInt($(this).find('span[data-likes]').attr('data-likes'));
        var likeStatus = $(this).attr('data-status');   
  
        if(likeStatus === 'false'){
          $.ajax({
              type:'POST',
              url: "{{route('connect-createLike')}}",
              data:{ _token:"{{ csrf_token() }}", post_id:post_id},
              success:function(data){
                console.log(data.success);
                if(data.success)
                {
                  $('#'+post_id).attr('data-status',true);
                  $('#'+post_id).find('.post-stat-icon').find('.post-like-icon').toggleClass('liked');
                  $("#liked_"+post_id).text(parseInt($("#liked_"+post_id).text())+1);

                }else{
                  alert('You have already liked this Post');
                }
              }
          });         
        }
       });
       

       $(".post_comment").click(function(event){
        event.preventDefault();
        var post_id = $(this).attr('id');
        var comment_text = $("#comment_"+post_id).val();
        if(comment_text != '')
        {
          var _token = $('input[name="_token"]').val();
          $.ajax({
              method: "POST",
              url: "{{route('connect-createComment')}}",
              data: {
                  _token:"{{ csrf_token() }}", comment_text: comment_text, post_id: post_id,
              },
              success: function(data){
                console.log(data);
                  $("#comment_"+post_id).val("");
                  $('.post-comment-container').append(
                      `<div class="d-flex justify-content-start align-items-start flex-start">
                        <img class="rounded-circle me-3" src="{{auth()->user()->profile_photo ?? asset('assets/web/images/connect/avatar.png')}}" width="36" height="36">
                        <div class="flex-grow-1 flex-shrink-1">
                          <div class="w-100 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="post-stat-info-name">{{auth()->user()->first_name.' '.auth()->user()->last_name}} <span class="post-stat-info-time ms-sm-3 ms-0 d-sm-inline-block d-block">Just Now</span></p>
                            </div>
                            <p class="post-brief w-100">${comment_text}</p>
                          </div>
                        </div>
                      </div>`
                  );
                  $("#count_"+post_id).text(parseInt($("#count_"+post_id).text())+1);
              },
              error: function(xhr, status, error){
                  console.log(error);
                  alert("something went wrong");
              }
          });
        }
      });

      $('body').on("click", ".delete-connect", function(e) {
        e.preventDefault();
        var post_id = $(this).attr('data-post');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });
        $.confirm({
          title: 'Are you sure you want to delete the post?',
          content: '',
          autoClose: 'cancel|8000',
          buttons: {
            delete: function() {
              $.ajax({
                url: '{{route("connect-deletePost")}}',
                type: 'post',
                data: {
                  post_id: post_id
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
       
    </script>
@endpush