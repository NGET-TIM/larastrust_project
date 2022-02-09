<div class="modal fade" id="permission_modal_edit" tabindex="-1" aria-labelledby="avatar_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avatar_modalLabel">{{ $modal_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('permission.update')}}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <input type="hidden" name="p_id" id="p_id" value="{{ $permission->id }}">
                <ul class="text-danger permissions_error"></ul>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Module Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}">
                    </div>
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" value="{{ $permission->display_name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ $permission->description }}">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn_logo btn_update_permission"><i class="fas fa-arrow-circle-right"></i> Update Permission</button>
                </div>      
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.btn_update_permission', function(e) {
            e.preventDefault();
            var $this_btn = $(this);
            $('.permissions_error').html(' ');
            var count_row = $this_btn.closest('form').find('.form_content').length - 2;
            $this_btn.closest('form').find('span.text-danger').text('');
            $.ajax({
                type: "POST",  
                url: "{{ route('permission.update') }}",
                enctype: 'multipart/form-data',
                data: $(this).closest('form').serialize(),
                dataType: "json",
                beforeSend:function(){
                    $('.permissions_error').html(' ');
                    $this_btn.find('i').addClass('fa-spinner animate_icon').animate('2000', function() {
                        $this_btn.find('i').addClass('fa-arrow-circle-right').removeClass('fa-spinner animate_icon');
                    });
                },
                success:function(data){
                    
                    if(data.status == 'fail'){
                        $this_btn.find('i').addClass('fa-spinner animate_icon').animate('2000', function() {
                            $this_btn.find('i').addClass('fa-arrow-circle-right').removeClass('fa-spinner animate_icon');
                        }); 
                        $.each(data.errors, function(prefix, val){
                            $('.permissions_error').append('<li>'+val[0]+'</li>');
                        });     
                    }else{
                        var toastMixin = Swal.mixin({
                            toast: true,
                            icon: 'success',
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        toastMixin.fire({
                            animation: true,
                            title: data.errors
                        }).then((result) => {
                            $('#permissions_table').DataTable().ajax.reload(null, false);
                            $('#permission_modal_edit').modal('hide');
                        });
                    }
                }
            });
        });
    });
</script>