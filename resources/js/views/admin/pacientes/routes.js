import ListaPacientes from './ListaPacientes'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'perfis',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.perfis',
                component: ListaPacientes
            }
        ]
    },
]
