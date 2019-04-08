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
                :items="senhas"
                :load="load"
                :search="busca"
                :rows-per-page-items="[10,25,50]"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.tipo_senha.prefixo }} {{ props.item.numero }}</td>
                <td>{{ props.item.tipo_senha.descricao }}</td>
                <!--<td>{{ props.item.tipo_senha.prefixo }}</td>-->
                <td><div :class="props.item.tipo_senha.cor" class="cor-tipo"></div></td>
                <td>
                    <v-icon v-if="props.item.ativo" title="Senha ativo">done</v-icon>
                    <v-icon v-else title="Senha inativo">clear</v-icon>
                </td>
            </template>
        </v-data-table>
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
                    {text:'Cor',value:'cor'},
                    {text:'Ativo',value:'ativo'},
                ],
                load: true,
                busca: ''
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
        },
        created(){
            this.loadSenhas()
        },
        mounted(){
            console.log('montou')
            Echo.channel('senha-gerada')
                .listen('SenhaGerada', senha => {
                    console.log('senha gerada')
                    this.senhas.push(senha)
                })
        }
    }
</script>

<style scoped>

</style>