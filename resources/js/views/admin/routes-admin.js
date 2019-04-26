import Layout from './../../components/admin/Layout'
import Dashboard from './Dashboard'
import tipoSenhaRoutes from './tipoSenhas/routes'
import senhasRoutes from './senhas/routes'
import telasRoutes from './telas/routes'
import salasRoutes from './salas/routes'
import grupoTelasRoutes from './grupoTelas/routes'
import perfisRoutes from './perfis/routes'
import usuariosRoutes from './usuarios/routes'

export default [
    {
        path:'/admin',
        component: Layout,
        meta:{
            autenticado: true
        },
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
            Senhas
             */
            ...senhasRoutes,
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
            ...grupoTelasRoutes,
            /*
            Perfis
             */
            ...perfisRoutes,
            /*
            Usuários
             */
            ...usuariosRoutes
        ]
    }
]