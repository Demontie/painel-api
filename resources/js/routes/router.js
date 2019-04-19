import Vue from 'vue'
import Router from 'vue-router'
import Login from './../views/admin/Login'
import routesAdmin from './../views/admin/routes-admin'
import Principal from './../views/painel/Principal'

import storeAdmin from './../views/admin/vuex/store'

Vue.use(Router)

const router =  new Router({
    mode: 'history',
    //base: '/painel-api',
    routes: [
        {
            path:'/login',
            name:'login',
            component: Login
        },
        ...routesAdmin,
        {
            meta:{
              autenticado: true
            },
            name:'painel-chamadas',
            path:'/painel-chamadas',
            component: Principal
        },
        {
            path: '*',
            redirect: '/admin',
        }
    ]
})

router.beforeEach((to,from, next) => {
    if(to.meta.autenticado && !storeAdmin.state.isLogado){
        return router.push({name:'login'})
    }

    let metaParent = to.matched.some(m => m.meta.autenticado)
    if( metaParent && !storeAdmin.state.isLogado){
        return router.push({name:'login'})
    }
    next()
})


export default router
