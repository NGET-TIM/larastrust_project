<!-- Modal -->
<style>
    .user_img_preview {
        /* padding: 5px;
        border: 1px solid #abb; */
    }
    .user_img_preview img {
        max-width: 100px;
        max-height: 100%;
    }
</style>
<div class="modal fade" id="avatar_modal" tabindex="-1" aria-labelledby="avatar_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avatar_modalLabel">{{ $modal_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('avatar.update')}}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <span class="text-danger avatar_file_error"></span>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="user_img_preview"></div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="user_image" class="dropify" data-max-file-size="1M" data-default-file="{{ asset('').$user->avatar }}">
                        <span class="text-danger error-text user_image_error"></span>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn_logo btn_update_avatar"><i class="fas fa-arrow-circle-right"></i> Update Avatar</button>
                </div>      
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var url = "{{ URL::to('/') }}";
        $('.dropify').dropify({
            messages: {
                'default': 'Drag the file here',
                'replace': 'click or drag the file here to replace the file',
                'remove':  ' Remove file ',
                'error':   ' Sorry, the file you uploaded is too large '
            }
        });
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
         });

         $('#form').on('submit', function(e){
            e.preventDefault();
            var $this_btn = $(this).find('.btn_update_avatar');
            var $id = $(this).find('#user_id').val();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $this_btn.find('i').addClass('fa-spinner animate_icon').animate('2000', function() {
                        $this_btn.find('i').addClass('fa-arrow-circle-right').removeClass('fa-spinner animate_icon');
                    });  
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.error == 'fail'){
                        $this_btn.find('i').addClass('fa-spinner animate_icon').animate('2000', function() {
                            $this_btn.find('i').addClass('fa-arrow-circle-right').removeClass('fa-spinner animate_icon');
                        }); 
                        $.each(data.get_error, function(prefix,val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $this_btn.closest('form')[0].reset();
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
                            title: data.get_error
                        }).then((result) => {
                            $this_btn.find('i').addClass('fa-arrow-circle-right').removeClass('fa-spinner animate_icon');
                            load_user_avatar($id);
                        });
                    }
                }
            });
        });
        function load_user_avatar($id) { 
            $.ajax({
                type: 'GET',
                url: "{{ route('avatar.after_change_avatar') }}",
                data: {
                    id: $id,
                },
                success:function(response){
                    $('.user_image_left_site').html(`<img src="${url}/${response.image}" class="img-responsive changed" alt="">`);
                }
            });
        }
    });

</script>