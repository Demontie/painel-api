import ListarSala from './ListaSalas'
import FormSala from './FormSala'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'salas',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.salas',
                component: ListarSala
            },
            {
                path:'nova-sala',
                name:'admin.salas.nova-sala',
                component: FormSala
            },
            {
                path:'/editar-salas/:idSala',
                name:'admin.salas.editar-sala',
                component: FormSala
            },
        ]
    },
]