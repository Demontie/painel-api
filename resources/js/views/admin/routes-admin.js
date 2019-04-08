import Layout from './../../components/admin/Layout'
import Dashboard from './Dashboard'
import tipoSenhaRoutes from './tipoSenhas/routes'
import telasRoutes from './telas/routes'
import salasRoutes from './salas/routes'
import grupoTelasRoutes from './grupoTelas/routes'

export default [
    {
        path:'/admin',
        component: Layout,
        children:[
            {
                path:'',
                name:'admin.dashboard',
                component: Dashboard
            },
            /*
            Tipo senhas
             */
            ...tipoSenhaRoutes,
            /*
            Telas
             */
            ...telasRoutes,
            /*
            Salas
             */
            ...salasRoutes,
            /*
            Grupo telas
             */
            ...grupoTelasRoutes


        ]
    }
]