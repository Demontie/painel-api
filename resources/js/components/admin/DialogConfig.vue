<template>
    <v-dialog v-model="dialogConfig" persistent max-width="20rem">
        <v-card>
            <v-card-title>
                <div>
                    Configure o IP do servidor (Raspberry)
                </div>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-text-field
                                autofocus
                                v-model="ipServidor"
                                @keyup.enter="salvarIp"
                                label="IP servidor"
                        >
                        </v-text-field>
                        <v-btn color="primary" @click="salvarIp">Salvar</v-btn>
                    </v-layout>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        data(){
          return{

          }
        },
        methods:{
            salvarIp(){
                this.$emit('mensagem',{
                    ativo:true,
                    texto: 'IP salvo com sucesso.',
                    tipo: 'grey darken-4'
                })

                this.$store.dispatch('setDialogIpConfig',false)
                window.location.reload()
            }
        },
        computed:{
            dialogConfig:{
                get(){
                    return this.$store.getters.getDialogIpConfig
                },
                set(valor){
                    this.$store.dispatch('setDialogIpConfig',valor)
                }
            },
            ipServidor:{
                get(){
                    return this.$store.getters.getIpServidor
                },
                set(valor){
                    this.$store.dispatch('setIpServidor',valor)
                }
            }
        },
    }
</script>

<style scoped>

</style>