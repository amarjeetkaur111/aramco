<input type="hidden" name="technology_workshop_id" value="{{ $getData->id }}">
<input type="hidden" name="workshop_name" value="{{$getData->workshop_name ?? ""}}"/>
<input type="hidden" name="start_date" value="{{ date('Y-m-d', strtotime($getData->start_date)) }}"/>
<input type="hidden" name="end_date" value="{{ date('Y-m-d', strtotime($getData->end_date)) }}"/>
<input type="hidden" name="num_of_people" min="0" value="{{$getData->num_of_people ?? ""}}"/>
<input type="hidden" name="point_of_contact" value="{{$getData->point_of_contact ?? ""}}"/>
<input type="hidden" name="justification" value="{{$getData->justification ?? ""}}"/>
<input type="hidden" name="additional_info" value="{{$getData->additional_info ?? ""}}"/>
