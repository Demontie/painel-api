<template>
    <div>
        <v-container grid-list-sm class="px-0 py-0">
            <v-layout wrap justify-end>
                <v-flex sm12 md5>
                    <v-toolbar-title class="headline text-uppercase mr-4">
                        <span>Tipos de senhas </span>
                    </v-toolbar-title>
                </v-flex>
                <v-flex sm12 md3>
                    <v-btn @click="novoTipoSenha" color="primary darken-3" class="mb-1">Novo</v-btn>
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
                :items="tipoSenhas"
                :load="load"
                :search="busca"
                :rows-per-page-items="[10,25,50]"
                class="elevation-1"
                :disable-initial-sort="true"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.descricao }}</td>
                <td>{{ props.item.prefixo }}</td>
                <td><div :class="props.item.cor" class="cor-tipo"></div></td>
                <td>{{ props.item.ordem }}</td>
                <td>
                    <v-icon v-if="props.item.ativo" title="Tipo ativo">done</v-icon>
                    <v-icon v-else title="Tipo inativo">clear</v-icon>
                </td>
                <td>
                    <v-icon title="Editar tipo de senha"
                            class="mr-5"
                            @click="editarTipoSenha(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon title="Excluir tipo de senha"
                            @click="excluirTipoSenha(props.item.id)"
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
    import InputSearch from './../../../components/admin/views/InputSearch'

    export default {
        components:{
            InputSearch
        },
        data(){
            return{
                cabecalho:[
                    {
                        text: 'Tipos de senha',
                        align: 'left',
                        value: 'descricao'
                    },
                    {text:'Prefixo',value:'prefixo'},
                    {text:'Cor',value:'cor'},
                    {text:'Ordem',value:'ordem'},
                    {text:'Ativo',value:'ativo'},
                    {text:'Ações', align:'justify'}
                ],
                load: true,
                busca: '',
            }
        },
        computed:{
            ...mapGetters({
                tipoSenhas: 'getTipoSenhas'
            })
        },
        methods:{
            ...mapActions({
                setTipoSenha:'setTipoSenha'
            }),
            novoTipoSenha(){
                this.setTipoSenha({})
                this.$router.push({name:'admin.tipo-senhas.novo'})
            },
            editarTipoSenha(tipoSenha){
                this.setTipoSenha(tipoSenha)
                this.$router.push({
                    name:'admin.tipo-senhas.editar',
                    params: {
                        idTipoSenha:tipoSenha.id
                    }
                })
            },
            excluirTipoSenha(){

            }
        },
        watch:{
            tipoSenhas(novoValor){
                if(Array.isArray(novoValor)){
                    this.load = false
                }
            }
        },
        created(){
            this.$store.dispatch('loadTipoSenhas')
        }
    }
</script>

<style>
    .cor-tipo{
        width: 2rem;
        height: 2rem;
        border-radius: 30px;
    }
</style>