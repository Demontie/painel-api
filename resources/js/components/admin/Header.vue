<template>
    <v-toolbar app dark color="primary">
        <!--<v-toolbar-side-icon></v-toolbar-side-icon>-->
        <v-toolbar-title class="headline text-uppercase mr-4" style="cursor: pointer" @click="irParaHome">
            <span>Painel </span>
            <span class="font-weight-light">de chamadas</span>
        </v-toolbar-title>

        <template v-for="item in menu">
            <MenuItemToolbar v-if="item.permissao" :menu-obj="item"/>
        </template>

        <v-layout justify-end>
            <v-toolbar-title v-if="guicheSelecionado" class="mr-3 texto-extra px-2 py-2">
                {{ guicheSelecionado.descricao }}
            </v-toolbar-title>

            <MenuItemToolbar :menu-obj="usuario"/>
        </v-layout>
    </v-toolbar>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import MenuItemToolbar from './toolbar/MenuItemToolbar'
    import permissoes from './../../perfis'

    export default {
        components:{
            MenuItemToolbar
        },
        data(){
            return{
                menu:{
                    senha:{
                        texto: 'Senha',
                        permissao: permissoes.verificarPermissao([
                            permissoes.ADMIN,
                            permissoes.GUICHE
                        ]),
                        itens:[
                            {
                                texto:'Listar',
                                rota: {name:'admin.senhas'},
                                permissao: permissoes.verificarPermissao([
                                    permissoes.ADMIN,
                                    permissoes.GUICHE
                                ])
                            },
                            {
                                texto:'Tipos de Senha',
                                rota: {name:'admin.tipo-senhas'},
                                permissao: permissoes.verificarPermissao([
                                    permissoes.ADMIN
                                ])
                            }
                        ]
                    },
                    guiche:{
                        texto: 'Guiche',
                        permissao: permissoes.verificarPermissao([
                            permissoes.ADMIN,
                            permissoes.GUICHE
                        ]),
                        itens:[
                            {
                                texto:'Listar',
                                rota: {name:'admin.guiches'},
                                permissao: permissoes.verificarPermissao([
                                    permissoes.ADMIN,
                                    permissoes.GUICHE
                                ])
                            }
                        ]
                    },
                    tela:{
                        texto: 'Telas',
                        permissao: permissoes.verificarPermissao([
                            permissoes.ADMIN
                        ]),
                        itens:[
                            {
                                texto:'Grupos de telas',
                                rota: {name:'admin.grupo-telas'},
                                permissao: permissoes.verificarPermissao([
                                    permissoes.ADMIN
                                ])
                            },
                            {
                                texto:'Listar Telas',
                                rota: {name:'admin.telas'},
                                permissao: permissoes.verificarPermissao([
                                    permissoes.ADMIN
                                ])
                            }
                        ]
                    },
                    sala:{
                        texto: 'Salas',
                        permissao: permissoes.verificarPermissao([
                            permissoes.ADMIN
                        ]),
                        itens:[
                            {
                                texto:'Listar',
                                rota: {name:'admin.salas'},
                                permissao: permissoes.verificarPermissao([
                                    permissoes.ADMIN
                                ])
                            }
                        ]
                    }
                },
                usuario:{},
            }
        },
        computed:{
            ...mapGetters({
                usuarioLogado: 'getUsuarioLogado',
                guicheSelecionado: 'getGuicheSelecionado'
            })
        },
        methods:{
            irParaLista(){
                console.log('lista')
            },
            irParaTipos(){
                console.log('tipos')
            },
            irParaHome(){
                this.$router.push({name:'admin.dashboard'})
            }
        },
        created() {
            this.usuario = {
                texto: this.usuarioLogado.name,
                itens:[
                    {
                        texto:'Perfil',
                        rota: {name:'admin.senhas'},
                        icone:'account_circle',
                        permissao: true
                    },
                    {
                        texto:'Usuários',
                        rota: {name:'admin.usuarios'},
                        icone:'people',
                        permissao: permissoes.verificarPermissao([permissoes.ADMIN])
                    },
                    {
                        texto:'Perfis',
                        rota: {name:'admin.perfis'},
                        icone:'done',
                        permissao: permissoes.verificarPermissao([permissoes.ADMIN])
                    },
                    {
                        texto:'Sair',
                        rota: {name:'sair'},
                        icone:'exit_to_app',
                        permissao: true
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    .texto-extra{
        border: 1px solid #fff;
        border-radius: 100px;
        font-size: 1rem;
    }
</style>