import ListaTipoSenhas from './ListaTipoSenhas'
import FormTipoSenhas from './FormTipoSenhas'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'tipo-senhas',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.tipo-senhas',
                component: ListaTipoSenhas,
            },
            {
                path:'novo',
                name:'admin.tipo-senhas.novo',
                component: FormTipoSenhas
            },
            {
                path:':idTipoSenha',
                name:'admin.tipo-senhas.editar',
                component: FormTipoSenhas
            }
        ]
    }
]