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
    .modal_1 .modal .modal-title {
        color: #14a7b4 !important;
    }
</style>
<div class="modal fade" id="modal_add_table" tabindex="-1" aria-labelledby="add_table" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modal_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('setting.table.store')}}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                
                
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('code',  __('lang.table_code') ) !!}
                        <input type="text" name="code" id="code" class="form-control">
                        <span class="text-danger error-text code_error"></span>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name',  __('lang.table_name') ) !!}
                        <input type="text" name="name" id="name" class="form-control">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn_logo add_table"><i class="fas fa-arrow-circle-right"></i> {{ __('lang.add_table') }}</button>
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
            var $this_btn = $(this).find('.add_table');
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
                            console.log(prefix);
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
                            $('#list_table').DataTable().ajax.reload(null, false);
                        });
                    }
                }
            });
        });
    });

</script>