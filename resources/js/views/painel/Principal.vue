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
            <v-layout row>
                <v-flex sm12>
                    <v-list v-for="senha in senhasChamadas"
                            :key="senha.id">
                            <v-list-tile-content>
                                <v-list-tile-title sm12 v-text="senha.itemLista"></v-list-tile-title>
                            </v-list-tile-content>
                    </v-list>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        data(){
          return{
              chamadaAtual:'',
              senhasChamadas: [],
          }
        },
        mounted(){
            Echo.channel('senha-chamada')
                .listen('SenhaChamada', senha => {
                    console.log(senha);
                    var utterance = new SpeechSynthesisUtterance(`Senha: ${senha.prefixo} ${senha.numero} , Guichê 2`)
                    utterance.rate = 0.75
                    window.speechSynthesis.speak(utterance);
                    senha.itemLista = `${senha.prefixo} - ${senha.numero}`

                    this.chamadaAtual = senha.itemLista
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
</style>