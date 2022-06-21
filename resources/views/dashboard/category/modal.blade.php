<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="avatar_modalLabel">Testing Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('avatar.update')}}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="">
            <span class="text-danger avatar_file_error"></span>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="text" class="form-control"/>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-sm btn_logo btn_update_avatar"><i class="fas fa-arrow-circle-right"></i> Update Avatar</button>
            </div>
        </form>
    </div>
</div>
