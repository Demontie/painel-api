import Vue from 'vue'
import Router from 'vue-router'
import Login from './../views/admin/Login'
import routesAdmin from './../views/admin/routes-admin'
import Principal from './../views/painel/Principal'

Vue.use(Router)

export default new Router({
    mode: 'history',
    base: '/painel-api',
    routes: [
        {
            path:'/login',
            component: Login
        },
        ...routesAdmin,
        {
            path:'/painel-chamadas',
            component: Principal
        },
        {
            path: '*',
            redirect: '/admin',
        }
    ]
})
