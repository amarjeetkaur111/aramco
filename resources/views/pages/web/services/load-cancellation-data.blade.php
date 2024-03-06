@foreach($lists as $data)
    <tr>
        <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
        <td>{{ ucfirst($data->user->first_name) }} <div class="fs-5">{{ $data->user->email ?? "" }}</div></td>
        <td>{{ $data->status_of_request ?? "" }}</td>
        <td>
            <div class="user-item justify-content-end">
                <div class="saction m-0">
                    @if(isset($action))
                        <a class="saction-link" href="{{route($action, ['id' => $data->id])}}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforeach
