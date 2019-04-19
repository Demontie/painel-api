import ListarSala from './ListaSalas'
import FormSala from './FormSala'

export default [
    {
        path:'salas',
        name:'admin.salas',
        component: ListarSala
    },
    {
        path:'nova-tela',
        name:'admin.nova-Sala',
        component: FormSala
    },
    {
        path:'/editar-salas/:idSala',
        name:'admin.editar-sala',
        component: FormSala
    },
]