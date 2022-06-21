<div class="modal fade" id="modal_view_product" tabindex="-1" aria-labelledby="modal_view_productLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_view_productLabel">{{ $product->code .' - ' .$product->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('product.gallery.change')}}" method="post" enctype="multipart/form-data" id="form_product_modal_gallery">
                @csrf
                <input type="hidden" name="user_id" id="product_id" value="{{ $product->id }}">
                <span class="text-danger avatar_file_error"></span>
                <div class="modal-body">
                    <div class="getLoading"></div>
                    <div class="form-group">
                        <div class="product_img_preview"></div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="single_image" class="dropify" data-max-file-size="1M" data-default-file="{{ asset('').$product->image }}">
                        <span class="text-danger error-text product_image_error"></span>
                    </div>
                    <div class="form-group">

                        <div class="product_gallery_dropify">
                            <input type="file" class="dropify" data-height="110" name="image_gallery[]" id="image_gallery" multiple>
                            @error('image_gallery')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn_logo btn_change_product_gallery"><i class="fas fa-arrow-circle-right"></i> Update Avatar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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

         $('#info_mains').on('ifChecked', function () {
            alert();
        });

         $('#form_product_modal_gallery').on('submit', function(e){
            e.preventDefault();
            var $this_btn = $(this).find('.btn_change_product_gallery');
            var $id = $(this).find('#product_id').val();
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
                        });
                    }
                }
            });
        });
    });

</script>
