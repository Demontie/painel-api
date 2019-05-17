import Layout from './../../components/admin/Layout'
import ContainerRouter from './ContainerRouter'
import Dashboard from './Dashboard'
import tipoSenhaRoutes from './tipoSenhas/routes'
import senhasRoutes from './senhas/routes'
import telasRoutes from './telas/routes'
import salasRoutes from './salas/routes'
import grupoTelasRoutes from './grupoTelas/routes'
import pacienteRoutes from './pacientes/routes'
import perfisRoutes from './perfis/routes'
import guichesRoutes from './guiches/routes'
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
                name:'',
                component: ContainerRouter,
                children:[
                    {
                        path:'',
                        name:'admin.dashboard',
                        component: Dashboard,
                    },
                ]
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
            Guiches
             */
            ...guichesRoutes,
            /*
            Pacientes
             */
            ...pacienteRoutes,
            /*
            Usuários
             */
            ...usuariosRoutes
        ]
    }
]
