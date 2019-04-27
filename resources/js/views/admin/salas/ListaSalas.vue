<template>
    <div>
        <v-container grid-list-sm class="px-0 py-0">
            <v-layout wrap justify-end>
                <v-flex sm12 md5>
                    <v-toolbar-title class="headline text-uppercase mr-4">
                        <span>Salas </span>
                    </v-toolbar-title>
                </v-flex>
                <v-flex sm12 md3>
                    <v-btn @click="novaSala" color="primary darken-3" class="mb-1">Novo</v-btn>
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
                :items="salas"
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
                    <v-icon v-if="props.item.ativo" title="Sala ativa">done</v-icon>
                    <v-icon v-else title="Sala inativa">clear</v-icon>
                </td>
                <td>
                    <v-icon title="Editar sala"
                            class="mr-5"
                            @click="editarSala(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon title="Excluir sala"
                            @click="excluirSala(props.item)"
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
                        text: 'Salas',
                        align: 'left',
                        value: 'descricao'
                    },
                    {text:'Telas',value:'grupo_tela.descricao'},
                    {text:'Ativo',value:'ativo'},
                    {text:'Ações', align:'justify'}
                ],
                load: true,
                busca: '',
            }
        },
        computed:{
            ...mapGetters({
                salas: 'getSalas'
            })
        },
        methods:{
            ...mapActions({
                setSala: 'setSala',
                deleteSala: 'deleteSala'
            }),
            novaSala(){
                this.setSala({})
                this.$router.push({name:'admin.salas.nova-sala'})
            },
            editarSala(sala){
                this.setSala(sala)
                this.$router.push({
                    name:'admin.salas.editar-sala',
                    params: {
                        idSala:sala.id
                    }
                })
            },
            async excluirSala(sala){
                let res = await this.$confirm('Tem certeza que deseja excluir esse registro?',{
                    title:'Atenção',
                    icon:'warning',
                    color:'warning'
                })

                if(res){
                    try{
                        const request = await this.deleteSala(sala)
                    }catch (e){
                        console.log(e)
                    }
                }
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
            this.$store.dispatch('loadSalas')
        }
    }
</script>

<style scoped>

</style>