import { ref } from 'vue';
import axios from 'axios';


export default function useProducts() {
    const products = ref([]);
    const product = ref([]);
    const content_loading = ref([]);
    const getAllProducts = async() => {
        content_loading.value = true;
        await axios.get('http://127.0.0.1:8080/api/v1/admin/products').then(response => {
            content_loading.value = false;
            products.value = response.data.data;
        });
    }
    const getProductById = async(id) => {
        content_loading.value = true;
        await axios.get(`http://127.0.0.1:8080/api/v1/admin/product/${id}/details`).then(response => {
            content_loading.value = false;
            product.value = response.data.data[0];
        });
    }
    return {
        products,
        product,
        getAllProducts,
        getProductById,
        content_loading,
    }
}