<template>
    <div class="categories">
        <h1>All Categories</h1>
        <loading v-if="loading"/>
        <ul v-else class="list-group">
            <li class="list-group-item" v-for="category in categories" :key="category.id">{{ category.name }}</li>
        </ul>
    </div>
</template>



<script>
    import axios from 'axios';
    import loading from './loading.vue';
    export default {
        components: {
            loading,
        },
        created() {
            this.getAllCategories();
        },
        
        data() {
            return {
                url: 'http://127.0.0.1:8080/api/v1/admin/',
                categories: [],
                count: 0,
                loading: false,
            }
        },
        
        methods:{
            getAllCategories() {
                this.loading = true;
                axios.get(this.url+'categories').then(res => {
                    this.loading = false;
                    this.categories = res.data.data;
                });
            }
        }
    }

</script>