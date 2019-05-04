import ListaUsuarios from './ListaUsuarios'
import FormUsuario from './FormUsuario'
import TelaPerfil from './TelaPerfil'
import ContainerRouter from './../ContainerRouter'

export default [
    {
        path:'usuarios',
        component:ContainerRouter,
        children:[
            {
                path:'',
                name:'admin.usuarios',
                component: ListaUsuarios
            },
            {
                path:'novo-usuario',
                name:'admin.usuarios.novo-usuario',
                component: FormUsuario
            },
            {
                path:'editar-usuarios/:idUsuario',
                name:'admin.usuarios.editar-usuario',
                component: FormUsuario
            },
            {
                path:'editar-perfil/:idUsuario',
                name:'admin.usuarios.editar-perfil',
                component: TelaPerfil
            },
        ]
    },
]