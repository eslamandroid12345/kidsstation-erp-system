<form class="py-3" id="EditForm" action="{{route('update_reservation')}}" method="POST">
    @method('POST')
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <input type="hidden" name="id" value="{{$rev->id}}">
                <label for="Customer Name " class="col-form-label">Customer Name </label>
                <input type="text" class="form-control" id="Customer Name" value="{{$rev->client_name}}" name="client_name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="email " class="col-form-label">Email </label>
                <input type="text" class="form-control" name="email" id="email" value="{{$rev->email}}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group ">
                <label for="event" class="col-form-label">Event</label>
                <select class="form-control" data-placeholder="Reservation Type" name="event_id">
                    @foreach($types as $type)
                        <option
                            value='{{ $type->id }}' {{ ($rev->type_id == $type->id) ? 'selected' : '' }}>{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="phone" class="col-form-label">Contact Number </label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$rev->phone}}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="day" class="col-form-label">Visit Date</label>
                <input type="date" class="form-control" id="day" name="day" value="{{Carbon\Carbon::parse($rev->day)->format('Y-m-d')}}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn bg-gradient-primary m-3 mb-0" id="confirmBtn"> Confirm </button>
</form>
<script>
    var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;
    $('form#EditForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $('#EditForm').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            beforeSend: function(){
                $('#confirmBtn').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                    ' ></span> <span style="margin-left: 4px;">working</span>').attr('disabled', true);
            },
            success: function (data) {
                if (data.status == 200) {
                    setTimeout(function () {
                        $('#editOrCreate').modal('hide')
                        $('#SearchBtn')[0].click();
                    }, 300)
                } else {
                    toastr.error('error');
                }
                $('#confirmBtn').html('Confirm').attr('disabled', false);
                $('#SearchBtn')[0].click();
            },
            error: function (data) {
                $('#confirmBtn').html('Confirm').attr('disabled', false);
                if (data.status === 500) {
                    toastr.error('error');
                } else if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value, key);
                            });
                        }
                    });
                } else {

                    toastr.error('there in an error');
                }
                $('#SearchBtn')[0].click();
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    })

</script>
