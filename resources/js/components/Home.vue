<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div id="left_site">
                    <Categories />
                </div>
            </div>

            <div class="col-9">
                <div id="contents">
                    <div class="row">
                        <div class="col-12">
                            <HomeSlide />
                        </div>
                    </div>
                    <div class="row_items">
                        <Products /> 
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</template>

<script>
import Products from './Products/ProductList.vue';
import Categories from './CategoryComponent.vue';
import HomeSlide from './Slide/HomeSlide.vue';

export default {
    components: {
        Products,
        Categories,
        HomeSlide,
    },
    created() {

    },
    data() {


        return {

        }
    }

}
</script>
