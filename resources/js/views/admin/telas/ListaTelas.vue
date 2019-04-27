<template>
    <div>
        <v-container grid-list-sm class="px-0 py-0">
            <v-layout wrap justify-end>
                <v-flex sm12 md5>
                    <v-toolbar-title class="headline text-uppercase mr-4">
                        <span>Telas </span>
                    </v-toolbar-title>
                </v-flex>
                <v-flex sm12 md3>
                    <v-btn @click="novaTela" color="primary darken-3" class="mb-1">Novo</v-btn>
                </v-flex>
                <v-flex sm12 md3>
                    <!--<InputSearch :param="busca"></InputSearch>-->
                    <v-text-field
                            v-model="busca"
                            append-icon="search"
                            label="Pesquisar"
                            single-line
                            hide-details
                    ></v-text-field>
                </v-flex>
            </v-layout>
        </v-container>
        <v-data-table
                :headers="cabecalho"
                :items="telas"
                :load="load"
                :search="busca"
                :rows-per-page-items="[10,25,50]"
                class="elevation-1"
                :disable-initial-sort="true"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.descricao }}</td>
                <td>{{ props.item.grupo_tela.descricao }}</td>
                <td>
                    <v-icon v-if="props.item.ativo" title="Tela ativa">done</v-icon>
                    <v-icon v-else title="Tela inativa">clear</v-icon>
                </td>
                <td>
                    <v-icon title="Editar tela"
                            class="mr-5"
                            @click="editarTela(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon title="Excluir tela"
                            @click="excluirTela(props.item.id)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data(){
            return{
                cabecalho:[
                    {
                        text: 'Telas',
                        align: 'left',
                        value: 'descricao'
                    },
                    {text:'Grupo',value:'grupo_tela.descricao'},
                    {text:'Ativo',value:'ativo'},
                    {text:'Ações', align:'justify'}
                ],
                load: true,
                busca: '',
            }
        },
        computed:{
            ...mapGetters({
                telas: 'getTelas'
            })
        },
        methods:{
            ...mapActions({
                setTela: 'setTela'
            }),
            novaTela(){
                this.setTela({})
                this.$router.push({name:'admin.telas.nova-tela'})
            },
            editarTela(tela){
                this.setTela(tela)
                this.$router.push({
                    name:'admin.telas.editar-tela',
                    params: {
                        idTela:tela.id
                    }
                })
            },
            excluirTela(tela){

            }
        },
        watch:{
            senhas(novoValor){
                if(Array.isArray(novoValor)){
                    this.load = false
                }
            }
        },
        created(){
            this.$store.dispatch('loadTelas')
        }
    }
</script>

<style scoped>

</style>