@foreach($channelsList as $channel)
@php
$stat = "";
if($channel->status == "Blocked")
$stat = "Blocked"
@endphp
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 d-flex align-content-stretch">
          <div class="card p-2 border-0 rounded-4 w-100 bg-aramco-grey">
            <div class="card-header border-0 p-2 bg-transparent connect-card-header">
                <div class="connect-logo"><img src="{{$channel->icon}}" class="img-fluid" /></div>
                <div class="w-100">
                  <div class="connect-logo-title w-100 clearfix text-wrap text-break channels-posts-click" data-status="{{$channel->status}}" data-ch-internal="{{route('connect-internalChannels',['id'=>$channel->id])}}" style="cursor: pointer;"><span class=" float-start">{{$channel->title}}</span><span class=" p-1 px-2 ms-2 badge rounded-pill text-bg-danger float-start" style="font-size:0.9rem;">{{$stat}}</span></div>
                  <div class="connect-response w-100 clearfix"><span class="connect-response-icon"><img src="{{asset('assets/web/images/connect/response.svg')}}" class="img-fluid" /></span>@if($channel->channels_posts_count <= 100){{$channel->channels_posts_count}} @else 100+ @endif</div>
                </div>
                @role('Admin')
                <div class="dropdown ms-auto">
                  <a href="#" class="connect-more-rightLink" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"><img src="{{asset('assets/web/images/connect/h-dots-dark.svg')}}" class="img-fluid" /></a>
                  <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 13rem;">
                  @if($channel->status !== 'Blocked')
                    <li><a class="dropdown-item ararmco-dropdown-item p-2 channelStatus" data-ch-status-url="" data-channel= "{{$channel->id}}" data-code = 'block' href="#"><img src="{{asset('assets/web/images/icons/24/restrict.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Block channel</a></li>
                    @else
                    <li><a class="dropdown-item ararmco-dropdown-item p-2 channelStatus" data-ch-status-url="" data-channel= "{{$channel->id}}" data-code = 'unblock' href="#"><img src="{{asset('assets/web/images/icons/24/restrict.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Unblock channel</a></li>
                  @endif
    <!-- <li><a class="dropdown-item ararmco-dropdown-item p-2 text-primary" href="#"><img src="{{asset('assets/web/images/icons/24/mute-blue.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Mute Post</a></li>
                    <li><a class="dropdown-item ararmco-dropdown-item p-2" href="#"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Edit Channel</a></li> -->
                    <li><a class="dropdown-item ararmco-dropdown-item p-2 text-danger delete-connect" data-channel= "{{$channel->id}}"  href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid ararmco-dropdown-item-img me-2" /> Delete Channel</a></li>
                  </ul>
                </div>
                @endrole
                <a href="{{route('connect-internalChannels',['id'=>$channel->id])}}" class="connect-circle-rightLink ms-auto d-none"><img src="{{asset('assets/web/images/connect/arrow-circle-right.svg')}}" class="img-fluid" /></a>
            </div>
            @foreach($channel->channels_posts_limit as $channelUser)
            <div class="card-body px-2 py-3 connect-card-body">
                <div class="connect-userAvatar"><img src="{{$channelUser->user->profile_photo ?? ''}}" class="img-fluid" /></div>

                <div class="w-100">
                  <span class="connect-userName text-wrap text-break me-2">{{$channelUser->user->first_name ?? ''}}</span><span class="text-blue">New!</span>
                  <p class="connect-userResponse text-wrap text-break" id="limitedContent">{{$channelUser->post_text}}</p>
                </div>

            </div>
            @endforeach
          </div>
        </div>
      @endforeach
