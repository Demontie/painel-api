import ContainerRouter from './../ContainerRouter'
import ListaSenhas from './ListaSenhas'

export default [
    {
        path:'senhas',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.senhas',
                component: ListaSenhas,
            }
        ]
    }
]