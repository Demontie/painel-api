<template>
    <v-content class="preencher-h primary lighten-2">
        <v-layout
                sm12 column wrap align-center justify-center fill-height>
            <v-card>
                <v-container
                        fluid
                        grid-list-lg
                >
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card  class="px-4 py-4">
                                <v-layout>
                                    <v-flex sm12>
                                        <v-card-title primary-title>
                                            <div class="title">
                                                Painel de Chamadas
                                            </div>
                                        </v-card-title>
                                    </v-flex>
                                </v-layout>
                                <v-divider light></v-divider>

                                <v-layout>
                                    <v-flex sm12>
                                        <v-text-field
                                                :error="dadosLogin.error"
                                                autofocus
                                                prepend-icon="person"
                                                name="email"
                                                label="e-mail"
                                                v-model="dadosLogin.email"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>

                                <v-layout>
                                    <v-flex sm12>
                                        <v-text-field
                                                :error="dadosLogin.error"
                                                prepend-icon="lock"
                                                name="password"
                                                type="password"
                                                label="Senha"
                                                v-model="dadosLogin.password"
                                                @keyup.enter="logar(dadosLogin)"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>

                                <v-card-actions class="pa-3">
                                    <v-btn block color="primary darken-2" @click="logar(dadosLogin)">Login</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-layout>
        <Mensagens></Mensagens>
    </v-content>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import Mensagens from './../../components/admin/views/Mensagens'

    export default {
        components:{
            Mensagens
        },
        data(){
            return{
                dadosLogin:{
                    email:'admin@teste.com',
                    password:'admin',
                    error: false
                },
            }
        },
        methods:{
            ...mapActions({
                fazerLogin: 'fazerLogin',
                setMensagem: 'setMensagem'
            }),
            async logar(dadosUsuario){
                try{
                    const usuarioLogado = await this.fazerLogin(dadosUsuario)

                    this.dadosLogin.error = false

                    this.$router.push({name:'admin.dashboard'})
                }catch (e) {
                    this.dadosLogin.error = true

                    this.setMensagem({
                        ativo: true,
                        texto: e.message,
                        tipo: 'red darken-1'
                    })

                    console.log(e.message)
                }
            }
        }
    }
</script>

<style scoped>
    .preencher-h{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>