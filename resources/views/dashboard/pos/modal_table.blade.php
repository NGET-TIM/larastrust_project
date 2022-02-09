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
    .card-popup {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: #14a7b4b8;
        color: #fff;
        font-size: 12px;
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis; 
        padding: 5px;
        z-index: 10;
        cursor: pointer;
    }
    .card-body img {
        transition: .3s ease-in-out;
    }
    .card-body:hover img {
        transform: scale(1.2);
    }
    .card-body.active {
        background: #20c997;
    }
</style>
<div class="modal fade" id="modal_add_table" tabindex="-1" aria-labelledby="add_table" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                    <div class="row">
                        @if($tables)
                            @foreach($tables as $table)
                                <div class="col-2">
                                    <div class="card">
                                        <div class="card-popup btn_table text-center" data-id="{{ $table->id }}">{{ $table->name }}</div>
                                        <div class="card-body btn_table {{ $table->is_active == 1 ? 'active' : '' }}" data-id="{{ $table->id }}"><img src="{{ asset('assets/images/main-logo.png') }}" class="rounded img-responsive" alt="TIM Dev"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
         });

        $(document).on('click', '.btn_table', function(e){
            e.preventDefault();
            var $id = $(this).attr('data-id');
            var card_header = $(this).closest('.card').find('.card-popup');
            $.ajax({
                url: '{{ route('setting.table.get_table') }}',
                method: "GET",
                data: {table_id: $id},
                beforeSend:function(){
                    card_header.html(`<i class="spinner-grow spinner-grow-sm"></i>${card_header.text()}`).animate('2000', function() {
                        card_header.remove('i');
                    });  
                    card_header.html(`<i class="spinner-grow spinner-grow-sm"></i>${card_header.text()}`);
                },
                success:function(table){
                    card_header.html(`${card_header.text()}`);
                    var tabel_option = "";
                    $.each(table, function () {
                        tabel_option = `<option selected value="${this.id}">${this.name}</option>`;
                        $('#select_table').html(tabel_option);
                        $('#select_table').select2();
                        localStorage.setItem('table_id', $('#select_table').val());
                    });
                }
            });
        });
    });

</script>