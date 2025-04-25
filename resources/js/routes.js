import { createWebHistory, createRouter } from 'vue-router'
import index from './frontendTemplate/index.vue';


const routes = [

    {
        name: 'Index',
        path: '/',
        component: index,

    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
