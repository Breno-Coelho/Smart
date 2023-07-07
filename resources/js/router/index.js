import { createRouter, createWebHistory } from 'vue-router'

import produtoIndex from '../components/produtos/index.vue'
import produtoNew from '../components/produtos/new.vue'
import produtoEdit from '../components/produtos/edit.vue'

import marcaIndex from '../components/marcas/index.vue'
import marcaNew from '../components/marcas/new.vue'
import marcaEdit from '../components/marcas/edit.vue'
import notFound from '../components/notFound.vue'

const routes = [
    {
        path:'/',
        component: produtoIndex,
    },
    {
        path:'/produto/new',
        component: produtoNew,
    },
    {
        path:'/produto/edit/:id',
        component: produtoEdit,
        props:true,
    },

    {
        path:'/marcas',
        component: marcaIndex,
    },
    {
        path:'/marcas/new',
        component: marcaNew,
    },
    {
        path:'/marcas/edit/:id',
        component: marcaEdit,
        props:true,
    },

    {
        path:'/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router