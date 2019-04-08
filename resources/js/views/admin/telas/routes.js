import ListaTelas from './ListaTelas'
import FormTela from './FormTela'

export default [
    {
        path:'telas',
        name:'admin.telas',
        component: ListaTelas
    },
    {
        path:'nova-tela',
        name:'admin.nova-tela',
        component: FormTela
    },
    {
        path:'/editar-tela/:idTela',
        name:'admin.editar-tela',
        component: FormTela
    },
]