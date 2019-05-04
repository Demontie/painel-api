import ListaGuiches from './ListaGuiches'
import FormGuiche from './FormGuiche'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'guiches',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.guiches',
                component: ListaGuiches
            },
            {
                path:'novo-guiche',
                name:'admin.guiches.novo-guiche',
                component: FormGuiche
            },
            {
                path:'/editar-guiches/:idGuiche',
                name:'admin.guiches.editar-guiche',
                component: FormGuiche
            },
        ]
    },
]