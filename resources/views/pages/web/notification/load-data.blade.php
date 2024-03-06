@foreach($lists as $data)
    <tr>
        <td>{{ ucfirst($data->title) }}</div></td>
        <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
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
