@foreach($lists as $data)
    <tr>
        <td>
            <div class="activity-item" style="min-width:200px">
                <div class="sicon blue-bg"><img src="{{asset('assets/web/images/icons/24/scheduled-visit-white.svg')}}" class="img-fluid" /></div>
                <div class="stext">
                    {{ $data->visit_title ?? $data->event_name ?? $data->usecase_name ?? $data->workshop_name ?? $data->idea_name ?? $data->title  }}
                </div>
            </div>
        </td>
        <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
        <td><span class="{{ CommonFunction::statusWiseServiceColor($data->status_of_request) }}">{{ $data->status_of_request ?? "" }}</span></td>
        <td>
            <div class="activity-item" style="min-width:110px">
                <div class="sicon yellow-bg"><img src="{{asset('assets/web/images/icons/24/announcement.svg')}}" class="img-fluid" /></div>
                <div class="stext">
                Available
            </div>
        </td>
        <td>
            <div class="activity-item">
                <div class="saction m-0">
                    @if($data->status_of_request=='Pending')
                        <a class="saction-link delete-request" data-id = "{{$data->id}}" data-type={{$type}} href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href="{{route($action,['id'=>$data->id])}}"><img src="{{asset('assets/web/images/icons/24/edit.svg')}}" class="img-fluid" /></a>
                        @elseif($data->status_of_request == "Cancelled")
                          <a class="saction-link" href="{{route($actionShow,['id'=>$data->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                        @elseif($data->status_of_request == "Rejected")
                          <a class="saction-link" href="{{route($actionShow,['id'=>$data->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                        @elseif($data->status_of_request == "Approved")
                        @if($data->is_approval_needed == 1)
                            <a class="saction-link already_approved"  href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                            <a class="saction-link" href="{{route($actionShow,['id'=>$data->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                        @else
                        <a class="saction-link delete-request" data-id = "{{$data->id}}" data-type={{$type}} href="#"><img src="{{asset('assets/web/images/icons/24/trash.svg')}}" class="img-fluid" /></a>
                        <a class="saction-link" href="{{route($actionShow,['id'=>$data->id])}}" title="show"><img src="{{asset('assets/web/images/icons/24/show.svg')}}" class="img-fluid" /></a>
                            
                        @endif
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforeach

