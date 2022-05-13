<template>
    <div>
        <loading v-if="loading" />
        <p>{{ product.price }}</p>
        <p>{{ product.name }}</p>
    </div>
</template>


<script>
import axios from 'axios';
import loading from '../loading.vue';
export default {
    components: {
        loading,
    },
    created() {
        this.getProductById();
    },

    data() {
        const product_id = parseInt(this.$route.params.id);
        const product_code = parseInt(this.$route.query.code);
        const product_color = this.$route.query.color;
        const product_size = this.$route.query.size;
        console.log({product_code, product_color, product_size});

        return {
            url: 'http://127.0.0.1:8080/api/v1/admin',
            product: [],
            count: 0,
            loading: false,
            id: product_id,
            code: product_code,
        }
    },

     methods: {
        async getProductById() {
            this.loading = true;
            await axios.get(`${this.url}/product/${this.id}/details?code=${this.code}&color=red`).then(res => {
                this.loading = false;
                this.product = res.data.data[0];
            });
        }
    }
}
</script>
