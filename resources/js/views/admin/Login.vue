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
                                                prepend-icon="lock"
                                                name="password"
                                                type="password"
                                                label="Senha"
                                                v-model="dadosLogin.senha"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>

                                <v-card-actions class="pa-3">
                                    <v-btn block color="primary darken-2" @click.prevent="fazerLogin">Login</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-layout>
    </v-content>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data(){
            return{
                dadosLogin:{
                    email:'',
                    senha:''
                }
            }
        },
        methods:{
            fazerLogin(){

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