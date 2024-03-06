@foreach($event_list as $event)
    <tr>
        <td>
            <div class="form-check">
                <input class="form-check-input is-checked-event" type="checkbox" value="{{ $event->calendar_events_id .'_'. $event->user->id }}" name="requested_data[]">
            </div>
        </td>
        <td>{{$event->calendarEvent->title ?? "" }} <div class="fs-5">{{ $event->calendarEvent->description ?? "" }}</div>
        <td>{{ $event->user->first_name ?? "" }} <div class="fs-5">{{ $event->user->email ?? "" }}</div>
        </td>
        <td>
            <div>{{ date('d/m/y', strtotime($event->created_at)) }}</div>
        </td>
        <td>{{ $event->status }}</td>
        <td>
            <div class="user-item">
                <div class="saction m-0">
                    <a class="saction-link " href="{{ route('calender-admin-event-details', ['id' => $event->calendar_events_id,'userid' => $event->user->id]) }}"><img src="{{asset('assets/web/images/icons/24/table-user-view.svg')}}" class="img-fluid" /></a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
