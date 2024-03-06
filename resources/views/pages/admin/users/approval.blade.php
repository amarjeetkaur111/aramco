<form id="from-assign" method="post" action="{{ $action }}">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$id}}">
    <div class="row" style="width:100%">
        
        <div class="form-group col-md-6">
            <select class="form-select" name="status" id="status">
                <option value="Approved" {{($status == 'Approved' ? ' selected' : '')}}>Approved</option>
                <option value="Rejected" {{($status == 'Rejected' ? ' selected' : '')}}>Rejected</option>
            </select> 
        </div>
    </div>
</form>