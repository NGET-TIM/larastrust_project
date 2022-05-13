<template>

    <div>
        <Menu/>
        <RouterView/>

    </div>
</template>

<script >
    import Menu from './components/menu/MenuCompoent.vue';
    import { RouterLink, RouterView } from "vue-router";

    export default {
        components: {
            Menu,
        }
    }

</script>


<style>
    #nprogress .bar {
        background: #00BC7E ! important;
        position: fixed;
        z-index: 1031;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px ! important;
    }
    #nprogress .spinner-icon {
        border-top-color: #00BC7E ! important;
        border-left-color: #00BC7E ! important;
    }
</style>
