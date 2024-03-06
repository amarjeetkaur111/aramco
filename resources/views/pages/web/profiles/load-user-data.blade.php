@foreach($profiles as $k => $user)
<tr>
    <td>{{$user->first_name}}<div class="fs-5">{{$user->email}}</div>
    </td>
    <td>{{$user->roles[0]->name}}</td>
    <td>
        <div class="user-item justify-content-end">
            <div class="saction m-0">
                <a class="saction-link" href="{{route('user_details',['id' => $user->id])}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
            </div>
        </div>
    </td>
</tr>
@endforeach        