import Vue from 'vue'
import Router from 'vue-router'
import Login from './../views/admin/Login'
import routesAdmin from './../views/admin/routes-admin'
import Principal from './../views/painel/Principal'

import storeCore from './../store'

Vue.use(Router)

const router =  new Router({
    mode: 'history',
    //base: '/painel-api',
    meta:{
        autenticado: true
    },
    routes: [
        {
            path:'/login',
            name:'login',

            component: Login
        },
        ...routesAdmin,
        {
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

/**
 * Verificações para troca de rota
 */
router.beforeEach((to,from, next) => {
    /*
    Atributos de autenticação
     */
    const isLogado = storeCore.state.adminStore.isLogado
    const autenticado = to.matched.some(m => m.meta.autenticado)

    /*
    Armazenamento da url antes do refresh ou navegação
     */
    storeCore.commit('changeUrlBack',to.name)

    /*
    Caso não esteja autenticado redireciona para login
     */
    if(autenticado && !isLogado){
        return router.push({name:'login'})
    }else if(to.name === 'login'){
        //return router.push({name: from.name})
    }

    next()
})


export default router
