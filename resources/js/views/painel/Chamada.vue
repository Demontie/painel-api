<template>
    <v-flex sm12 align-center style="height: 100%">
        <v-card class="card-senha text-uppercase py-0 px-0" :class="atendimento ? 'primary' : senha.tipo_senha.cor">
            <v-card-title>
                <template v-if="atendimento">
                    <v-flex sm12 class="titulo-card text-sm-center">
                        {{ atendimento.nome }}
                    </v-flex>
                    <hr class="separador"/>
                    <v-flex sm12 class="subtitulo-card text-sm-center">
                        {{ atendimento.sala }}
                    </v-flex>
                </template>
                <template v-else>
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
    import { mapGetters, mapActions } from 'vuex'
    import fabricaSenhasPainel from './factories/senhaPainelFactory'

    export default {
        data(){
          return{
              atendimento: {
                  paciente: '',
                  sala: ''
              }
          }
        },
        computed:{
            ...mapGetters({
                senha: 'getUltimaSenhaChamada',
                senhasChamadas: 'getSenhasChamadas',
                ultimaSenhaChamada: 'getUltimaSenhaChamada',
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
        methods:{
            ...mapActions({
                setSenhaInSenhasChamadas: 'setSenhaInSenhasChamadas',
                loadSenhasChamadas: 'loadSenhasChamadas',
            })
        },
        watch: {
            senha: {
                handler(novoValor){
                    console.log(novoValor)
                    this.atendimento = null;

                    let chamarPainel = fabricaSenhasPainel.fabricarChamadaAtual(this.senha)

                    // console.log(this.senhasChamadas)
                    // if(this.senhasChamadas[0].id !== this.senha.id && this.senha.status !== 2){
                    //     this.setSenhaInSenhasChamadas(this.senha)
                    // }

                    var utterance = new SpeechSynthesisUtterance(chamarPainel)
                    utterance.rate = 0.75
                    window.speechSynthesis.speak(utterance);
                },
                deep:true
            }
        },
        mounted() {
            Echo.channel('chamada-medico')
                .listen('ChamadaMedico', atendimento => {
                    let chamarPainel = `Paciente: ${atendimento.paciente.nome}, dirija-se para ${atendimento.sala.descricao}`

                    this.atendimento = {
                        nome: atendimento.paciente.nome,
                        sala: atendimento.sala.descricao
                    }

                    if(this.ultimaSenhaChamada){

                        let senhaExistente = this.senhasChamadas.find( senha => {
                            if(senha.id == this.ultimaSenhaChamada.id){
                                return senha;
                            }
                        })

                        if(!senhaExistente){
                            /*
                            Caso já exista uma senha chama e o array tenha 4 elementos
                             */
                            if(this.ultimaSenhaChamada && this.senhasChamadas.length == 4){
                                this.senhasChamadas.splice(3,1)
                            }

                            this.senhasChamadas.unshift(this.ultimaSenhaChamada)
                        }

                        console.log(senhaExistente)
                    }

                    var utterance = new SpeechSynthesisUtterance(chamarPainel)
                    utterance.rate = 0.75
                    window.speechSynthesis.speak(utterance);

                    this.loadSenhasChamadas()
                })
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
        color: #fff;
        font-size: 3rem;
    }

    .subtitulo-card{
        color: #fff;
        font-size: 2rem;
    }

    .separador{
        position: relative;
        top: 80%;
        width:100%;
    }
</style>
