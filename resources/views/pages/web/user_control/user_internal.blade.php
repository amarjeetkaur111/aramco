@php 
$count = 1;
@endphp
@foreach($userData as $users)
<tr>
    <td>
        <div class="form-check"><input name="google_id[]" class="form-check-input single-check-input" id="user_{{$users->id}}" data-id="users_check_{{$count}}" type="checkbox" value="{{$users->google_id}}"></div>
    </td>
    <td>{{$users->first_name}} {{$users->last_name}} <div class="fs-5">{{$users->email}}</div>
    </td>
    <td>{{$users->status}}</td>
    <td>
        <div class="user-item">
            <div class="saction m-0">
                <a class="saction-link goto-uc-set-btn" href="{{route($action, ['id' => $users->id])}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
            </div>
        </div>
    </td>
</tr>
@php 
$count++;
@endphp
@endforeach
