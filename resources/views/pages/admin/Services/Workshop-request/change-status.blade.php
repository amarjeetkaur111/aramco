<form id="from-assign" method="post" action="{{ route('admin-service-workshop-request-change-status') }}">
    @csrf
    <input type="hidden" name="workshop_id" id="rr_id" value="{{ $id }}">
    <div class="row" style="width:100%">
        <div class="form-group col-md-6">
            <select class="form-select" name="status" id="status">
                @foreach($status as $data)
                    <option value="{{ $data }}" {{ ($data == $selected_status) ? "selected" : "" }}>{{ $data }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
