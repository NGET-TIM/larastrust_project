<template>
    <div class="row">
        <div class="col-12">
            <h1>All Products</h1>
        </div>
        <loading v-if="content_loading" />

        <div v-else class="col-3" v-for="product in products" :key="product.id">
            <div class="card product_content">
                <div class="product_image">
                    <img :src="'/'+product.image" class="card-img-top" :alt="product.name">
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <p class="card-text">{{ product.details }}</p>
                    <div class="btn-group btn-block">
                        <p class="btn btn-sm btn-default">{{ product.price }}</p>
                        <p class="btn btn-sm btn-primary">
                            <router-link class="text-white" :to="`/product/${product.id}/details?code=${product.code}&color=red&size=m`">More Details</router-link>
                        </p>
                        <p class="btn btn-sm btn-default" @click="showModal = true, quickDetails(product)">Quick Details</p>
                        <p class="btn btn-sm btn-primary" @click="show_bs_modal = true, quickView(product.id)" data-toggle="modal" data-target="#staticBackdrop">
                            View
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <Modal :show="showModal" @close="showModal = false">
                <template #header>
                    <h3>{{ singleProduct.name }}</h3>
                </template>
                <template #body>
                    <loading v-if="modalLoading" />
                    <div v-else class="row">
                        <div class="col-3">
                            <div class="product_image">
                                <img :src="'/'+singleProduct.image" class="card-img-top" :alt="singleProduct.name">
                            </div>
                        </div>
                        <div class="col-9">
                            <h1>{{ singleProduct.name }}</h1>
                            <small>{{ singleProduct.price }}</small>
                        </div>
                    </div>
                </template>
            </Modal>
        </Teleport>

        <!-- BS Modal -->
        <Teleport to="body">
            <BSmodal :is_show="show_bs_modal" @close="show_bs_modal = false">
                <template #header>
                    <h3 v-if="!bs_modalLoading">{{ product.name }}</h3>
                </template>
                <template #body>
                    <loading v-if="bs_modalLoading" />
                    <div v-else class="row">
                        <div class="col-3">
                            <div class="product_image">
                                <img :src="'/'+product.image" class="card-img-top" :alt="product.name">
                            </div>
                        </div>
                        <div class="col-9">
                            <h1>{{ product.name }}</h1>
                            <small>{{ product.price }}</small>
                        </div>
                    </div>
                </template>
            </BSmodal>
        </Teleport>
    </div>

</template>

<script>
import axios from 'axios';
import loading from '../loading.vue';
import Modal from '../Products/Modal.vue';
import BSmodal from '../Products/ProductModal';
import useProducts from '../../composables/products';

export default {
    components: {
        loading,
        Modal,
        BSmodal,

    },
    created() {
        this.getAllProducts();
    },

    data() {

        const {products, getAllProducts, content_loading} = useProducts();
        return {
            url: 'http://127.0.0.1:8080/api/v1/admin',
            products,
            getAllProducts,
            product: {},
            singleProduct: {},
            count: 0,
            content_loading,
            showModal: false,
            modalLoading: false,
            show_bs_modal: false,
            bs_modalLoading: false,
        }
    },

    methods: {
        // async getAllProducts() {
        //     this.loading = true;
        //     await axios.get(`${this.url}/products`).then(res => {
        //         this.loading = false;
        //         this.products = res.data.data;
        //     });
        // },
        async quickDetails(product) {
            const id = product.id;
            this.modalLoading = true;
            await axios.get(`${this.url}/product/${id}/details?code=${product.code}`).then(res => {
                this.modalLoading = false;
                this.singleProduct = res.data.data[0];
            });
        },
        async quickView(id) {
            this.bs_modalLoading = true;
            await axios.get(`${this.url}/product/${id}/details`).then(res => {
                setTimeout(() => {
                    this.bs_modalLoading = false;
                    $('.loading_content').slideUp();
                }, 250);
                this.product = res.data.data[0];
            });
        }
    }
}
</script>

<style>
.product_content .product_image {
    width: 100%;
    padding: 5px;
    height: 150px;
    display: flex;
    justify-content: center;
}

.product_content .product_image img {
    width: auto ! important;
    height: 100%;
    border-radius: 5px;
}
</style>
