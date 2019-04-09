<template>
    <div>
        <v-container grid-list-sm class="px-0 py-0">
            <v-layout wrap justify-end>
                <v-flex sm12 md5>
                    <v-toolbar-title class="headline text-uppercase mr-4">
                        <span>Senhas </span>
                    </v-toolbar-title>
                </v-flex>
                <v-flex sm12 md3>
                    <!--<InputSearch :param="busca"></InputSearch>-->
                    <v-text-field
                            class="mr-5"
                            v-model="busca"
                            append-icon="search"
                            label="Pesquisar"
                            single-line
                            hide-details
                    ></v-text-field>
                </v-flex>
                <v-flex sm12 md3>
                    <v-btn block color="primary darken-3">Chamar</v-btn>
                </v-flex>
            </v-layout>
        </v-container>
        <v-flex sm12>
            <v-data-table
                    :headers="cabecalho"
                    :items="senhas"
                    :load="load"
                    :search="busca"
                    :rows-per-page-items="[10,25,50]"
                    class="elevation-1"
            >
                <template slot="items" slot-scope="props">
                    <tr @dblclick="selecionarLinha($event, props.item)" :class="{'primary lighten-3': senhaSelecionada.id == props.item.id}">
                        <td>{{ props.item.tipo_senha.prefixo }} {{ props.item.numero }}</td>
                        <td>{{ props.item.tipo_senha.descricao }}</td>
                        <td><div :class="props.item.tipo_senha.cor" class="cor-tipo"></div></td>
                        <td v-show="props.item.selecionado">
                            <v-btn block color="primary darken-3">Chamar senha {{ props.item.tipo_senha.prefixo }} {{ props.item.numero }}</v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-flex>
    </div>
</template>

<script>
    import { mapGetters,mapActions } from 'vuex'

    export default {
        data(){
            return{
                cabecalho:[
                    {
                        text: 'Senha',
                        align: 'left',
                        value: 'tipo_senha.prefixo' + 'numero'
                    },
                    {text:'Descrição',value:'descricao'},
                    {text:'Cor',value:'cor'}
                ],
                load: true,
                busca: '',
                senhaSelecionada:{
                    selecionado:false
                }
            }
        },
        computed:{
            ...mapGetters({
                senhas:'getSenhas'
            }),
            senha:{
                get(){
                    return this.$store.getters.getSenha
                },
                set(value){
                    this.$store.dispatch('setSenha',value)
                }
            }
        },
        methods:{
            ...mapActions({
                loadSenhas: 'loadSenhas',
            }),
            selecionarLinha(e, linhaSelecionada){

                if(linhaSelecionada.selecionado){
                    linhaSelecionada.selecionado = false
                    e.target.parentElement.classList.remove('primary','lighten-3')
                    this.senhaSelecionada = {}
                }
                else {
                    linhaSelecionada.selecionado = true
                    this.senhaSelecionada = linhaSelecionada
                }
                // linhaSelecionada.selecionado = true
                // this.senhaSelecionada = linhaSelecionada
            }
        },
        watch:{
          senhaSelecionada:{
              handler: function(novoValor,valorAntigo){
                  valorAntigo.selecionado = false
                  novoValor.selecionado = true
              },
              deep:true
          }
        },
        created(){
            this.loadSenhas()
        },
        mounted(){
            Echo.channel('senha-gerada')
                .listen('SenhaGerada', senha => {
                    console.log('senha gerada')
                    this.senhas.push(senha)
                })
        }
    }
</script>

<style scoped>
    .linha-selecionada{
        background-color: #616161;
        color: #fff;
    }
</style>