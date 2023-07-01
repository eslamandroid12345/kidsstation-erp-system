<link href="{{asset('assets/admin')}}/plugins/select2/select2.min.css" rel="stylesheet"/>
<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Add User</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('users.store')}}">
        @csrf
        <div class="form-group">
            <label for="name" class="form-control-label">Photo</label>
            <input type="file" class="dropify" name="photo" data-default-file="{{asset('assets/uploads/avatar.gif')}}"/>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label">Name</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">User Name</label>
            <input type="text" class="form-control" name="user_name" id="user_name">
        </div>
        <div class="form-group">
            <label for="password" class="form-control-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group">
            <label class="form-label">Assign Roles</label>
            <select name="roles[]" class="form-control select2" data-placeholder="Choose Roles" multiple>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addButton">Create</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
<script src="{{asset('assets/admin')}}/js/select2.js"></script>
<script src="{{asset('assets/admin')}}/plugins/select2/select2.full.min.js"></script>
