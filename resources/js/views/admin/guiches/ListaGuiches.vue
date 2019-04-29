<template>
    <div>
        <v-container grid-list-sm class="px-0 py-0">
            <v-layout wrap justify-end>
                <v-flex sm12 md5>
                    <v-toolbar-title class="headline text-uppercase mr-4">
                        <span>Guiches </span>
                    </v-toolbar-title>
                </v-flex>
                <v-flex sm12 md3>
                    <v-btn @click="novaGuiche" color="primary darken-3" class="mb-1">Novo</v-btn>
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
                :items="guiches"
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
                    <v-icon v-if="props.item.ativo" title="Guiche ativa">done</v-icon>
                    <v-icon v-else title="Guiche inativa">clear</v-icon>
                </td>
                <td>
                    <v-icon title="Editar guiche"
                            class="mr-5"
                            @click="editarGuiche(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon title="Excluir guiche"
                            @click="excluirGuiche(props.item)"
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
                        text: 'Guiches',
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
                guiches: 'getGuiches',
            })
        },
        methods:{
            ...mapActions({
                setGuiche: 'setGuiche',
                deleteGuiche: 'deleteGuiche'
            }),
            novaGuiche(){
                this.setGuiche({})
                this.$router.push({name:'admin.guiches.novo-guiche'})
            },
            editarGuiche(guiche){
                this.setGuiche(guiche)
                this.$router.push({
                    name:'admin.guiches.editar-guiche',
                    params: {
                        idGuiche:guiche.id
                    }
                })
            },
            async excluirGuiche(guiche){
                let res = await this.$confirm('Tem certeza que deseja excluir esse registro?',{
                    title:'Atenção',
                    icon:'warning',
                    color:'warning'
                })

                if(res){
                    try{
                        const request = await this.deleteGuiche(guiche)
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
            this.$store.dispatch('loadGuiches')
        }
    }
</script>

<style scoped>

</style>