import ListaTelas from './ListaTelas'
import FormTela from './FormTela'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'telas',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.telas',
                component: ListaTelas
            },
            {
                path:'nova-tela',
                name:'admin.telas.nova-tela',
                component: FormTela
            },
            {
                path:'/editar-tela/:idTela',
                name:'admin.telas.editar-tela',
                component: FormTela
            }
        ]
    }
]