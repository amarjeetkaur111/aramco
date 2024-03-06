<input type="hidden" name="reserve_incubator_id" value="{{ $getData->id }}">
<input type="hidden" name="usecase_name" value="{{ $getData->usecase_name ?? "" }}"/>
<input type="hidden" name="space_name" value="{{ $getData->space_name ?? "" }}"/>
<input type="hidden" name="start_date" value="{{ date('Y-m-d', strtotime($getData->start_date)) }}"/>
<input type="hidden" name="end_date" value="{{ date('Y-m-d', strtotime($getData->end_date)) }}"/>
<input type="hidden" name="contact_of_usecase" value="{{ $getData->contact_of_usecase ?? "" }}"/>
<input type="hidden" min="0" name="num_of_employees" value="{{ $getData->num_of_employees ?? "" }}"/>
<input type="hidden" name="justification" value="{{ $getData->justification ?? "" }}"/>
<input type="hidden" name="additional_info" value="{{ $getData->additional_info ?? "" }}"/>
