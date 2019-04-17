<template>
    <v-layout row wrap>
        <v-flex d-flex  class="chamados-noticias">
            <v-layout column>
                <v-flex align-center class="chamadas">
                    {{ chamadaAtual }}
                </v-flex>
                <v-flex class="noticias">

                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex d-flex class="senhas">
            <v-layout align-center justify-center row fill-height>
                <v-flex sm12 class="px-0 py-0">
                    <v-list class="lista-senhas" v-for="senha in senhasChamadas"
                            :key="senha.id">
                        <v-flex sm12>
                            <v-card :style="alturaCard">
                                <v-card-title>
                                    {{ senha.senhaCompleta }} - {{senha.guiche.descricao}}
                                </v-card-title>
                            </v-card>
                        </v-flex>
                    </v-list>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    import { mapGetters,mapActions } from 'vuex'
    import fabricaSenhasPainel from './factories/senhaPainelFactory'

    export default {
        data(){
          return{
              alturaCard: {}
          }
        },
        computed:{
            ...mapGetters({
                chamadaAtual: 'getChamadaAtual',
                senhasChamadas: 'getSenhasChamadas'
            })
        },
        methods:{
            ...mapActions({
                loadSenhasChamadas: 'loadSenhasChamadas',
                setSenhasChamadas: 'setSenhasChamadas',
                setChamadaAtual: 'setChamadaAtual'
            })
        },
        async created(){
            const senhasApi = await this.loadSenhasChamadas()
            const senhasFabricadas = fabricaSenhasPainel.fabricarSenhasPainel(senhasApi)

            this.alturaCard = {
                height: screen.height/(senhasFabricadas.length + 1) + 'px'
            }

            //this.setChamadaAtual(fabricaSenhasPainel.fabricarChamadaAtual(senha))

            this.setSenhasChamadas(senhasFabricadas)
        },
        mounted(){
            Echo.channel('senha-chamada')
                .listen('SenhaChamada', senha => {
                    this.setChamadaAtual(fabricaSenhasPainel.fabricarChamadaAtual(senha))

                    var utterance = new SpeechSynthesisUtterance(this.chamadaAtual)
                    utterance.rate = 0.75
                    window.speechSynthesis.speak(utterance);

                    this.senhasChamadas.push(senha)
                })
        }
    }
</script>

<style scoped>
    *{
        margin:0;
        padding:0;
    }

    .chamados-noticias{
        position: absolute;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
    }

    .senhas{
        border: 1px solid #000;
        position: absolute;
        top:0;
        left:70%;
        width: 30%;
        height: 100%;
    }

    .chamadas{
        border: 1px solid #000;
        position: relative;
        top:0;
        width: 70%;
        height: 20%;
    }

    .noticias{
        border: 1px solid #000;
        position: relative;
        top:0;
        width: 70%;
        height: 80%;
    }

    .lista-senhas{
        overflow-y: auto;
    }
</style>