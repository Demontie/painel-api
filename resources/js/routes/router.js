import Vue from 'vue'
import Router from 'vue-router'
import Login from './../views/admin/Login'
import routesAdmin from './../views/admin/routes-admin'
import Principal from './../views/painel/Principal'

import storeCore from './../store'
import store from "../store";

Vue.use(Router)

const router =  new Router({
    mode: 'history',
    base: '/painel-api',
    meta:{
        autenticado: true
    },
    routes: [
        {
            path:'/login',
            name:'login',
            component: Login
        },
        {
            path:'/sair',
            name: 'sair'
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
router.beforeEach(async (to,from, next) => {
    /*
    Atributos de autenticação
     */
    const isLogado = storeCore.state.adminStore.isLogado
    const autenticado = to.matched.some(m => m.meta.autenticado)

    /**
     * Redirecionamento para rota anterior a navegação ou refresh

     Caso o usuário esteja logado irá redirecionar para a url acessada anteriormente
     */
    if(to.name !== 'login' && !isLogado){
        const checkLogin = await store.dispatch('checkLogin')

        if(checkLogin){
            return router.push({name: to.name})
        }
    }else if(!from.name && !isLogado){
        const checkLogin = await store.dispatch('checkLogin')

        if(checkLogin){
            return router.push({name: 'admin.dashboard'})
        }
    }


    /**
    * Caso não esteja autenticado redireciona para login
     */
    if(autenticado && !isLogado || to.name === 'sair'){
        localStorage.removeItem('token')
        localStorage.removeItem('usuarioLogado')
        //storeCore.commit('changeUrlBack', to.name)
        /*
    Armazenamento da url antes do refresh ou navegação
     */
        return router.push({name:'login'})
    }

    next()
})


export default router
