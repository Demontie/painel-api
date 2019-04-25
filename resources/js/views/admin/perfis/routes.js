import ListaPerfis from './ListaPerfis'
import FormPerfil from './FormPerfil'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'perfis',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.perfis',
                component: ListaPerfis
            },
            {
                path:'novo-perfil',
                name:'admin.perfis.novo-perfil',
                component: FormPerfil
            },
            {
                path:'/editar-perfis/:idPerfil',
                name:'admin.perfis.editar-perfil',
                component: FormPerfil
            },
        ]
    },
]