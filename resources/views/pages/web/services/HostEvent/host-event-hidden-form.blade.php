<input type="hidden" name="event_id" value="{{ $getData->id }}">
<input type="hidden" name="event_name" class="form-control" value="{{ $getData->event_name ?? "" }}"/>
<input type="hidden" name="space_name" class="form-control" value="{{ $getData->space_name ?? "" }}"/>
<input type="hidden" name="required_resources" class="form-control" value="{{ $getData->required_resources ?? "" }}"/>
@if($getData->required_resources == 6)
    <input type="hidden" name="other_required_resource" value="{{ $getData->other_required_resource ?? "" }}"/>
@endif
<input type="hidden" name="start_date" value="{{ date('Y-m-d', strtotime($getData->start_date)) }}"/>
<input type="hidden" name="end_date" value="{{ date('Y-m-d', strtotime($getData->end_date)) }}"/>

<input type="hidden" name="num_of_attendees" min="0" value="{{ $getData->num_of_attendees ?? "" }}"/>
<input type="hidden" name="coordinator_contact" value="{{ $getData->coordinator_contact ?? "" }}"/>
<input type="hidden" name="justification" value="{{ $getData->justification ?? "" }}"/>
<input type="hidden" name="additional_info" value="{{ $getData->additional_info ?? "" }}"/>

