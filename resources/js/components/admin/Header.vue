<template>
    <v-toolbar app dark color="primary">
        <v-toolbar-side-icon></v-toolbar-side-icon>

        <v-toolbar-title class="headline text-uppercase mr-4">
            <span>Painel </span>
            <span class="font-weight-light">de chamadas</span>
        </v-toolbar-title>

        <template v-for="item in menu">
            <MenuItemToolbar :menu-obj="item"/>
        </template>
        <v-layout  justify-end>
            <MenuItemToolbar :menu-obj="usuario"/>
        </v-layout>
    </v-toolbar>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import MenuItemToolbar from './toolbar/MenuItemToolbar'

    export default {
        components:{
            MenuItemToolbar
        },
        data(){
            return{
                menu:{
                    senha:{
                        texto: 'Senha',
                        itens:[
                            {
                                texto:'Listar',
                                rota: {name:'admin.senhas'}
                            },
                            {
                                texto:'Tipos de Senha',
                                rota: {name:'admin.tipo-senhas'}
                            }
                        ]
                    },
                    tela:{
                        texto: 'Telas',
                        itens:[
                            {
                                texto:'Grupos de telas',
                                rota: {name:'admin.grupo-telas'}
                            },
                            {
                                texto:'Listar Telas',
                                rota: {name:'admin.telas'}
                            }
                        ]
                    },
                    sala:{
                        texto: 'Salas',
                        itens:[
                            {
                                texto:'Listar',
                                rota: {name:'admin.salas'}
                            }
                        ]
                    }
                },
                usuario:{}
            }
        },
        computed:{
            ...mapGetters({
                usuarioLogado: 'getUsuarioLogado'
            })
        },
        methods:{
            irParaLista(){
                console.log('lista')
            },
            irParaTipos(){
                console.log('tipos')
            }
        },
        created() {
            this.usuario = {
                texto: this.usuarioLogado.name,
                itens:[
                    {
                        texto:'Perfil',
                        rota: {name:'admin.senhas'},
                        icone:'account_circle'
                    },
                    {
                        texto:'Sair',
                        rota: {name:'admin.tipo-senhas'},
                        icone:'exit_to_app'
                    }
                ]
            }
        }
    }
</script>

<style scoped>

</style>