import { createWebHistory, createRouter } from 'vue-router'
import index from './frontendTemplate/index.vue';
import category from './frontendTemplate/category.vue';


const routes = [

    {
        name: 'Index',
        path: '/',
        component: index,

    },

    {
        name: 'Category',
        path: '/category/:slug?',
        component: category,

    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
