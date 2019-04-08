import ListaGrupoTelas from './ListaGrupoTelas'
import FormGrupoTelas from './FormGrupoTelas'
import ContainerRouter from './../ContainerRouter'

export default [
    {
      path:'grupo-telas',
      component: ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.grupo-telas',
                component: ListaGrupoTelas
            },
            {
                path:'novo',
                name:'admin.grupo-telas.novo',
                component: FormGrupoTelas
            },
            {
                path:':idGrupoTela',
                name:'admin.grupo-telas.editar',
                component: FormGrupoTelas
            }
        ]
    }
]