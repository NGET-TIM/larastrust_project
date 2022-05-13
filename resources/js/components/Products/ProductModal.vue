<template>
    <div v-if="is_show">
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <slot name="content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                <slot name="header">Modal title</slot>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$emit('close')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body product_modal">
                            <slot name="body"></slot>
                        </div>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            is_show: Boolean
        },
    }
</script>

<style>
    .modal-content .loading_content {
        background: transparent !important;
        height: auto;
    }
    .modal-content .lds-ring div {
        border-color: #00bc8c transparent transparent transparent ! important;
    }
</style>
