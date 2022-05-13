import { createRouter, createWebHistory } from "vue-router";
import nProgress from "nprogress";
import 'nprogress/nprogress.css';


import CategoryComponent from '../components/CategoryComponent.vue';
import Home from '../components/Home.vue';


import ProductDetail from '../components/Products/ProductDetail.vue';

import ErrorPage404 from '../components/ErrorPage404.vue';

const router = createRouter({
    history: createWebHistory(
        '/site'),
    routes: [{
            path: "/",
            name: "Home",
            component: Home,
        },
        {
            path: "/categories",
            name: "Categories",
            component: CategoryComponent,
        },
        {
            path: '/product/:id/details',
            name: "Product Details",
            component: ProductDetail,
        },
        // custom page 4o4
        {
            path: '/:pathMatch(.*)*',
            name: '404',
            component: ErrorPage404,
        }
    ],
});

router.beforeResolve((to, from, next) => {
    if (to.path) {
        nProgress.start();
    }
    next()
});
router.afterEach(() => {
    nProgress.done();
});


export default router;