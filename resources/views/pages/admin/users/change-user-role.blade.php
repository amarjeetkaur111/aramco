<form id="from-assign" method="post" action="{{route('admin-users-change-role',['id' => $user_id])}}">
    @csrf
    <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
    <div class="row" style="width:100%">
        <div class="form-group col-md-6">
            <select class="form-select" name="role_id" id="role_id">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
