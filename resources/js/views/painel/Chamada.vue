<template>
    <v-flex sm12 align-center style="height: 100%">
        <v-card class="card-senha text-uppercase primary py-0 px-0">
            <v-card-title>
                <template v-if="senha">
                    <v-flex sm12 class="titulo-card text-sm-center">
                        {{ senha.senhaCompleta }}
                    </v-flex>
                    <hr class="separador"/>
                    <v-flex sm12 class="subtitulo-card text-sm-center">
                        {{senha.guiche.descricao}}
                    </v-flex>
                </template>
            </v-card-title>
        </v-card>
    </v-flex>
</template>

<script>
    import { mapGetters } from 'vuex'
    import fabricaSenhasPainel from './factories/senhaPainelFactory'

    export default {
        // data(){
        //   return{
        //       senha:{
        //           senhaCompleta:'' ,
        //           guiche: {
        //               descricao: ''
        //           }
        //       }
        //   }
        // },
        computed:{
            ...mapGetters({
                senha: 'getUltimaSenhaChamada',
            })
        }
        ,
        watch:{
          senha:{
              handler(novaSenha, senhaAnterior){
                  if(senhaAnterior){

                  }
              },
              deep: true
          }
        },
        updated(){
            let chamarPainel = fabricaSenhasPainel.fabricarChamadaAtual(this.senha)

            var utterance = new SpeechSynthesisUtterance(chamarPainel)
            utterance.rate = 0.75
            window.speechSynthesis.speak(utterance);
        }
    }
</script>

<style scoped>
    .card-senha{
        position: absolute;
        height: 100%;
        width: 100%;
        border-radius: 25px;
        color: #fff;
    }

    .titulo-card{
        font-size: 3rem;
    }

    .subtitulo-card{
        font-size: 2rem;
    }

    .separador{
        position: relative;
        top: 80%;
        width:100%;
    }
</style>