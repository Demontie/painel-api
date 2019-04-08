import Vue from 'vue'
import Router from 'vue-router'
import routesAdmin from './../views/admin/routes-admin'

Vue.use(Router)

export default new Router({
    //mode: 'history',
    //base: '/painel-app/#',
    routes: [
        ...routesAdmin,
        {
            path: '*',
            redirect: '/admin',
        }
    ]
})
